<?php
class tooltips
{
    private $tooltip_js = '$(\'a\').tooltip({placement: \'bottom\'}).tooltip();';
    
    function __construct($tpl, $js=true) 
    {
        if($js=true)
            $tpl->add_script($this->tooltip_js);
    }
    
    //TODO sets, gems
    function get_item_tooltip($item)
    {
        $tmp ='<table><tr><td><b class=\'q4\'>'.$item['name'].'</b><br /><span style=\'color: #ffd100\'>Item Level '.$item['level'].'</span><br />';
        $tmp .='Binds when picked up'; //TODO
        $tmp .='<table width=\'100%\'><tr>';
        $tmp .='<td>Two-Hand</td><th>Staff</th>'; //TODO
        $tmp .='</tr></table><table width=\'100%\'>'; //TODO
        if(isset($item['weaponDmg']))
            $tmp .='<tr><td><span>207 - 312 Damage</span></td><th>Speed 3.20</th></tr>(81.1 damage per second)<br />'; //TODO
        $tmp .='</table>';
        foreach($item['stats'] as $key => $value)
            $tmp .= '<span  class=\'q2\'>+'.$value.' '.$key.'</span><br />';   
        $tmp .= '<br />';
        foreach($item['gems'] as $key => $gem)
        {
            if(!isset($gem['color']))
                break;
            switch ($gem['color']) {
                case 1: //meta
                    $tmp .='<a class=\'socket-meta q0\'>Meta Socket</a>';
                break;                
                case 2: //red
                    $tmp .='<a class=\'socket-red q0\'>Red Socket</a>';
                break;                
                case 4: //yellow
                    $tmp .='<a class=\'socket-yellow q0\'>Yellow Socket</a>';
                break;                
                case 8: //blue
                    $tmp .='<a class=\'socket-blue q0\'>Blue Socket</a>';
                break;
            }
            $tmp .= '<br />';
        }
        if($item['gems']['socketBonus'] != 0)
            $tmp .= '<span class=\'q0\'>Socket Bonus: +'.$item['gems']['socketBonus'].'</span><br /><br />'; //TODO
       // $tmp .= 'Durability 120 / 120';//TODO
        $tmp .='       </td>
            </tr>
        </table>';
        return($tmp);
    }

}
?>