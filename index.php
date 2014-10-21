<?php
$rootPath = './';
include ($rootPath.'common.php');
require_once($rootPath.'src/GearCheck/providers/'.PROVIDER.'.provider.php');
require_once($rootPath . 'src/GearCheck/Char.php');

$tpl->setLeftTemplate("content_left.tpl");
$tpl->set_vars(array(
    'page_title'        => 'Envy Gear-Check',
    'author'            => 'author',
    'nav_active'        => 'TEST',
    'sub_nav_active'    => 'TEST',
    'subHeadBig'        => 'TEST-TEST',
    'subHeadSmall'    => 'WoW-Castle PvE 3.3.5',
    'description'        => 'Armory-basierter Gearcheck für WoW-Castle.de (blizzlike, pve, 3.3.5)',
    'template_file'        => 'index.tpl',
));
$tpl->display();

