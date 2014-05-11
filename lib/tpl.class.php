<?php
/** @deprecated */
class tpl
{
    private $smarty;
    private $tpl_file;
    private $nav_links = array();
    private $sub_nav_links = array();
    private $js_files = "";
    private $css_files = "";
    private $css_code;
    private $script = "";
    private $icon;
    private $errors;
    private $base_template;
    private $left_inner_template;
    
    public function __construct($base_template)
    {
        require('smarty/Smarty.class.php');
        $this->smarty = new Smarty;
        
        $this->base_template = $base_template;
    }
    public function setBaseTemplate($template)
    {
        $this->base_template =  $template;
    }
    public function setLeftTemplate($template)
    {
        $this->left_inner_template =  $template;
    }
    public function add_js_file($path)
    {
        $this->js_files .= '<script src="'.$path.'"></script>'."\n";
    }

    public function add_css_file($path)
    {
        $this->css_files .= '<link href="'.$path.'" rel="stylesheet">'."\n";
    }

    public function print_error($msg, $head = 'Oh snap! There is an error!', $doLog = true)
    {
        $hash = md5($msg."-".$head);
        if (isset($this->errors[$hash]))
            return;
        $this->errors[$hash] = array('head' => $head, 'text' => $msg);
        if ($doLog) {
            $this->doLog($msg);
        }
    }

    public function add_nav_links($array)
    {
        // get current active page to determine whether to show submenu
        $path_parts = pathinfo($_SERVER['PHP_SELF']);
        
        foreach ($array as $data) {
            $this->nav_links[] = array(
                'name'    => $data['name'],
                'url'    => $data['url'],
                'class'    => "none"
            );
            
            if (!isset($data['sub'])) {
                continue;
            }

            // determine if submenu is needed
            $show_submenu = false;
            foreach ($data['sub'] as $sdata) {
                $tmp = pathinfo($sdata['url']);
                if ($tmp['basename'] == $path_parts['basename']) {
                    $show_submenu = true;
                }
            }
            if (!$show_submenu) {
                continue;
            }
            
            foreach ($data['sub'] as $subdata) {
                $tmp = array(
                    'name'  => $subdata['name'],
                    'url'   => $subdata['url'],
                    'class' => "none"
                );
                
                if (isset($subdata['icon'])) {
                    $tmp['icon'] = $subdata['icon'];
                }
                $this->sub_nav_links[] = $tmp;
            }
        }
    }
    
    private function set_active($name, $array)
    {    
        for ($i=0; $i<count($array); $i++) {
            if ($array[$i]['name'] == $name) {
                $array[$i]['class'] = 'active';
            } else {
                $array[$i]['class'] = '';
            }
        }
        return $array;
    }

    public function assign_vars($name, $value)
    {
        $this->smarty->assign($name, $value);
    }

    public function add_script($value)
    {
        $this->script .= "<script>".$value."</script>\n";
    }

    public function set_defaultIcon($icon)
    {
        $this->icon = $icon;
    }

    public function set_vars($array)
    {
        $this->smarty->assign("PAGE_TITLE", $array['page_title']);
        $this->smarty->assign("DESCRIPTION", $array['description']);
        $this->smarty->assign("AUTHOR", $array['author']);
        if (!empty($this->icon)) {
            $this->smarty->assign("ICON", $this->icon);
        } else {
            $this->smarty->assign("ICON", $array['icon']);
        }
        $this->smarty->assign("SUBHEADBIG", $array['subHeadBig']);
        $this->smarty->assign("SUBHEADSMALL", $array['subHeadSmall']);
        $this->tpl_file = $array['template_file'];
        $this->smarty->assign("NAV_LINKS", $this->set_active($array['nav_active'], $this->nav_links));
        $this->smarty->assign("SUB_NAV_LINKS", $this->set_active($array['sub_nav_active'], $this->sub_nav_links));
    }

    public function display()
    {
        $this->smarty->assign("ERROR_MSG", $this->errors);
        $this->smarty->assign("JS_FILES", $this->js_files);
        $this->smarty->assign("TEMPLATEFILE", $this->tpl_file);
        $this->smarty->assign("CSS_FILES", $this->css_files);
        $this->smarty->assign("CSS_CODE", ""); //todo
        $this->smarty->assign("SCRIPT", $this->script);
        $this->smarty->assign("LEFT_INNER_TEMPLATE", $this->left_inner_template);
        $this->smarty->display($this->base_template);
    }
    
    private function doLog($text)
    {

        $filename = "./logfile.log";
        $fh = fopen($filename, "a") or die("Could not open log file.");
        fwrite($fh, "[".date("d-m-Y, H:i")."] - ".$text."\n") or die("Could not write file!");
        fclose($fh);
    }
}

