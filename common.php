<?php

$perf_start[0] = microtime();

setlocale(LC_ALL, "de_DE.UTF-8");
date_default_timezone_set('Europe/Berlin');
session_start();

$rootpath = './';
require_once($rootpath.'lib/tpl.class.php');
require_once($rootpath.'lib/defines.php');
require_once($rootpath.'lib/functions.php');
require_once($rootpath.'lib/tooltips.class.php');
require_once($rootpath.'lib/cache.class.php');
require_once($rootpath.'config.php'); 
$tpl = new tpl('base_page.tpl');
$cache = new cache();
$tpl->assign_vars("BOOTSRAPPATH", $rootpath.'bootstrap/');
$tpl->assign_vars("PROJEKTNAME", PROJEKTNAME);
$tpl->assign_vars("PERF_START_0", $perf_start[0]);
$tpl->add_css_file($rootpath."css/common.css");
$nav_links = array(
	0 => array(
		'name'	=> 'Home',
		'url'	=> './index.php'
	),
);
$tpl->add_nav_links($nav_links);
$tpl->set_defaultIcon('./img/icon.png');

# MySQL Connection
mysql_connect($mysql_host, $mysql_user, $mysql_pass);
unset($mysql_pass); # lose the password right here, we don't need it anymore afterwards

?>
