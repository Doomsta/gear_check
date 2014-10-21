<?php

$perf_start[0] = microtime();

setlocale(LC_ALL, "de_DE.UTF-8");
date_default_timezone_set('Europe/Berlin');
session_start();

$rootPath = './';
require_once($rootPath . 'src/GearCheck/Tpl.php');
require_once($rootPath . 'src/GearCheck/defines.php');
require_once($rootPath . 'src/GearCheck/functions.php');
require_once($rootPath . 'src/GearCheck/Tooltip.php');
require_once($rootPath . 'src/GearCheck/Cache.php');
require_once($rootPath.'config.php');
$tpl = new Tpl('base_page.tpl');
$cache = new Cache();
$tpl->assign_vars("BOOTSRAPPATH", $rootPath.'bootstrap/');
$tpl->assign_vars("PROJEKTNAME", PROJEKTNAME);
$tpl->assign_vars("PERF_START_0", $perf_start[0]);
$tpl->add_css_file($rootPath."css/common.css");
$nav_links = array(
    0 => array(
        'name'    => 'Home',
        'url'    => './index.php'
    ),
    1 => array(
        'name'    => 'Profile',
        'url'    => './profile.php'
    ),
    2  => array(
         'name'    => 'Compare',
         'url'    => './compare.php'
    ),
);
$tpl->add_nav_links($nav_links);
$tpl->set_defaultIcon('./img/icon.png');

# MySQL Connection
mysql_connect($mysql_host, $mysql_user, $mysql_pass);
unset($mysql_pass); # lose the password right here, we don't need it anymore afterwards
