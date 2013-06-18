<?php
include ('common.php');


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