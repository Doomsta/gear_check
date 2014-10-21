<?php
$rootPath = './';
include ($rootPath.'common.php');
require_once($rootPath.'src/GEarCheck/providers/'.PROVIDER.'.provider.php');
require_once($rootPath . 'src/GearCheck/Char.php');

if (isset($_GET['cn']))
{
    $cn = $_GET['cn'];
    
	$char = new char($cn, true);
	if ($char->load())
	{
		$tooltips = new Tooltip($tpl);
		$char->addItemTooltips($tooltips);
	
		$tpl->assign_vars('avg', $char->getAvgItemLevel());
		$tpl->assign_vars('stats', $char->getStats());
		$tpl->assign_vars('items', $char->getItems());
		$tpl->assign_vars('char', $char->getCharArray());
		$tpl->assign_vars('gems', $char->getSockets());
		$tpl->assign_vars('professions', $char->getprofessions());
		$tpl->assign_vars('_stat_name', $_stat_name);
		$tpl->assign_vars('_skill_name', $_skill_name);
		$tpl->assign_vars('_race_name', $_race_name);
		$tpl->assign_vars('_class_name', $_class_name);
	}
}
$tpl->setLeftTemplate("content_left.tpl");
$tpl->set_vars(array(
    'page_title'        => 'Envy Gear-Check',
    'author'            => 'author',
    'nav_active'        => 'TEST',
    'sub_nav_active'    => 'TEST',
    'subHeadBig'        => 'TEST-TEST',
    'subHeadSmall'    => 'WoW-Castle PvE 3.3.5',
    'description'        => 'Armory-basierter Gearcheck für WoW-Castle.de (blizzlike, pve, 3.3.5)',
    'template_file'        => 'profile.tpl',
));
$tpl->display();

