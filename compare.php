<?php
$rootpath = './';
include ($rootpath.'common.php');
require_once($rootpath.'lib/castleImport.class.php');
require_once($rootpath.'lib/char.class.php');
$cn[1] = (isset($_GET['cn1']))? $_GET['cn1'] :  'Doomsta';
$cn[2] = (isset($_GET['cn2']))? $_GET['cn2'] : 'Jay';

foreach($cn as $i => $char)
{
    $test[$i] = new char($char, true);
    $test[$i]->loadItems();
    
    $tmp[$i]['char'] = $test[$i]->getCharArray();
    $tmp[$i]['eqstats'] = $test[$i]->getEquipmentStats();
    $tmp[$i]['gems'] = $test[$i]->getSockts();
    $tmp[$i]['items'] = $test[$i]->getItems();
}    
$tpl->assign_vars('_stat_name', $_stat_name);
$tpl->assign_vars('char1', $tmp[1]);
$tpl->assign_vars('char2', $tmp[2]);


$tpl->set_vars(array(
			'page_title'		=> 'Envy Gear-Check',
			'author'		    => 'author',
			'nav_active'		=> 'TEST',
			'sub_nav_active'	=> 'TEST',
			'subHeadBig'		=> 'TEST-TEST',
			'subHeadSmall'	=> 'WoW-Castle PvE 3.3.5',
			'description'		=> 'Armory-basierter Gearcheck für WoW-Castle.de (blizzlike, pve, 3.3.5)',
			'template_file'		=> 'compare.tpl',
			));
$tpl->display();
?>
