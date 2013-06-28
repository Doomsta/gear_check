<?php
$rootpath = './';
include ($rootpath.'common.php');
require_once($rootpath.'lib/castleImport.class.php');
require_once($rootpath.'lib/char.class.php');
$cn = 'Doomsta';
if (isset($_GET['cn']))
	$cn = $_GET['cn'];
    
$char = new char($cn, true);
$char->loadItems();

$tooltips = new tooltips($tpl);
$char->addItemTooltips($tooltips);

$tpl->assign_vars('eqstats', $char->getEquipmentStats());
$tpl->assign_vars('items', $char->getItems());
$tpl->assign_vars('char', $char->getCharArray());
$tpl->assign_vars('gems', $char->getSockts());

$tpl->set_vars(array(
			'page_title'		=> 'Envy Gear-Check',
			'author'		    => 'author',
			'nav_active'		=> 'TEST',
			'sub_nav_active'	=> 'TEST',
			'subHeadBig'		=> 'TEST-TEST',
			'subHeadSmall'	=> 'WoW-Castle PvE 3.3.5',
			'description'		=> 'Armory-basierter Gearcheck für WoW-Castle.de (blizzlike, pve, 3.3.5)',
			'template_file'		=> 'test.tpl',
			));
$tpl->display();
?>
