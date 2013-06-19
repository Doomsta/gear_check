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
$chardata = $castle->HandleArmoryQuirks($chardata);

$tpl->assign_vars("char", $chardata);

// export lookup-tables
$tpl->assign_vars("_race_name", $_race_name);
$tpl->assign_vars("_class_name", $_class_name);

$tpl->set_vars(array(
			'page_title'		=> 'Envy Gear-Check',
			'author'		=> 'author',
			'nav_active'		=> 'Home',
			'sub_nav_active'	=> 'Home',
			'subHeadBig'		=> 'Envy Gear-Check',
			'subHeadSmall'		=> 'WoW-Castle PvE 3.3.5',
			'description'		=> 'Armory-basierter Gearcheck für WoW-Castle.de (blizzlike, pve, 3.3.5)',
			'template_file'		=> 'character.tpl',
			));
$tpl->display();
?>
