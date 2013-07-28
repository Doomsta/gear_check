<?php
$rootpath = './';
include ($rootpath.'common.php');
require_once($rootpath.'lib/providers/'.PROVIDER.'.provider.php');
require_once($rootpath.'lib/char.class.php');

if (isset($_GET['cn']))
{
    $cn = $_GET['cn'];
    $char = new char($cn, true);
    if($char->load())
    {
        $tpl->assign_vars('stats', $char->getStats());
        $tpl->assign_vars('items', $char->getItems());
        $tpl->assign_vars('char', $char->getCharArray());
        $tpl->assign_vars('talents', $char->getTalents());
        $tpl->assign_vars('professions', $char->getprofessions());

    }
}

header ("Content-Type:text/xml");
$tpl->setBaseTemplate('api.tpl');
$tpl->display();
?>