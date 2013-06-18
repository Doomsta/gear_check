<?php
$rootpath = './';
include ($rootpath.'common.php');
require_once($rootpath.'lib/castleImport.class.php');

$castle = new castleImport();
$cn = 'Doomsta';
$chardata = $castle->getChar($cn);
foreach($chardata['items'] as $i => $value)
{
	$chardata['items'][$i]['stats'] = get_item_stats($chardata['items'][$i]['id']);
	$chardata['items'][$i] = add_item_gems($chardata['items'][$i]);
}

ob_start();
print_r($chardata); //to do 
$debug = ob_get_contents();
ob_end_clean();

$tpl->assign_vars("DEBUG", "<pre>".$debug."</pre>");

$tpl->set_vars(array(
			'page_title'		=> 'PvP@Castle Home',
			'author'			=> 'author',
			'nav_active'		=> 'Home',
			'sub_nav_active'	=> 'Home',
			'subHeadBig'		=> 'PvP@Castle Home',
			'subHeadSmall'		=> 'PvP@Castle Home',
			'description'		=> 'PvP@Castle',
			'template_file'		=> 'index.tpl',
			));
$tpl->display();
?>
