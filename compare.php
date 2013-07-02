<?php
$rootpath = './';
include ($rootpath.'common.php');
require_once($rootpath.'lib/castleImport.class.php');
require_once($rootpath.'lib/char.class.php');

define('MAX_CHARS', '16');

for($i=0;$i<MAX_CHARS;$i++)
{
    if(!isset($_GET['cn'.$i]))
        continue;
    $cn[$i] = $_GET['cn'.$i];
    $chars[$i] = new char($cn[$i], true);
    
    $tmp[$i]['char'] = $chars[$i]->getCharArray();
    $data['name'][$i] = $tmp[$i]['char']['name']; 
    
    $tmp[$i]['stats'] = $chars[$i]->getStats();
    foreach($tmp[$i]['stats']  as $j => $value)
        $data['stats'][$j][$i]['absolute']  = $value;
        
    $tmp[$i]['gems'] = $chars[$i]->getSockts();
    foreach($tmp[$i]['gems']  as $j => $gem)
    {
        if(!isset($data['gem'][$j]))
        {
            $data['gem'][$j]['name'] = $gem['name'];
            $data['gem'][$j]['color'] = $gem['color'];
        }
        $data['gem'][$j]['count'][$i]['absolute']  = $gem['count'];
    }
    
    $tmp[$i]['items'] = $chars[$i]->getItems();
    foreach($tmp[$i]['stats']  as $statid => $statvalue)
        $data['stat'][$statid][$i]['absolute']  = $statvalue;
    $data['trinkets'][$i] = $chars[$i]->getItems(array(1 => 13, 2 => 14));   
}
//fill array with zeros
//stats
foreach($data['stats'] as $statid => $stat)
{
    for($char=0;$char<count($cn);$char++)
        if(!isset($data['stats'][$statid][$char]))
            $data['stats'][$statid][$char]['absolute']  = 0;
    ksort($data['stats'][$statid]);
}
ksort($data['stats']);
//gems
foreach($data['gem'] as $gemid => $gem)
{
    for($char=0;$char<count($cn);$char++)
        if(!isset($gem['count'][$char]))
            $data['gem'][$gemid]['count'][$char]['absolute'] = 0;
    ksort($data['gem'][$gemid]['count']);
}
//add relativ values
foreach($data['stats'] as $statid => $stat)
{
    $max = 1;
    $avg = 0;
    foreach($stat as $char)
    {
        if($max < $char['absolute'])
            $max = $char['absolute'];
       $avg += $char['absolute'];
    }
    $data['stats'][$statid]['avg'] = $avg;
    $data['stats'][$statid]['max'] = $max;
    foreach($stat as $charid => $char)
        $data['stats'][$statid][$charid]['relativ'] = round(($char['absolute']/$max),3)*100;
    
}
//print_R($data);
$tpl->assign_vars('_stat_name', $_stat_name);
$tpl->assign_vars('count', count($cn));
$tpl->assign_vars('data', $data);


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
