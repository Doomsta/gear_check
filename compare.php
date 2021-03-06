<?php
$rootpath = './';
include ($rootpath.'common.php');
require_once($rootpath.'lib/providers/'.PROVIDER.'.provider.php');
require_once($rootpath.'lib/char.class.php');
$char_loaded = 0;
define('MAX_CHARS', '16');

if(isset($_GET['cns']))
{
    $cns = explode(" ",$_GET['cns']);
	for($i=0;$i<count($cns);$i++)
	{
	    //handle cache
	    if( $cache->getCachedTime($cns[$i]) < 60 AND $cache->getCachedTime($cns[$i]) != false)
	        $chars[$i] = $cache->load($cns[$i]);
	    else
	    {
	        $chars[$i] = new char($cns[$i], true);
	        $cache->store($cns[$i],$chars[$i]); 
	    }
	    
	    if(!$chars[$i]->load())
	    	continue;
	    else
	    	$char_loaded++;
	    $data['avgItemLevel'][$i] = $chars[$i]->getAvgItemLevel();
	    $data['talent'][$i] = $chars[$i]->getActiveTalent();
	    
        $tmp[$i]['char'] = $chars[$i]->getCharArray();
        $data['name'][$i] = $tmp[$i]['char']['name']; 
        $data['classId'][$i] = $tmp[$i]['char']['classId']; 
        
        $tmp[$i]['stats'] = $chars[$i]->getStats();
	    foreach($tmp[$i]['stats']  as $j => $value)
	    $data['stats'][$j][$i]['absolute']  = $value;
	    
	    $tmp[$i]['gems'] = $chars[$i]->getSockets();
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
	    
	    foreach ($_skill_name as $id => $name)
	    {
	        $tmp = $chars[$i]->getProfessions();
	        if (isset($tmp[$id]))
	            $data['professions'][$id][$i] = $tmp[$id];
	        else
	             $data['professions'][$id][$i] = false;
	    }
	}
	
	if($char_loaded != 0)
	{
		//clean up professions
		foreach ($_skill_name as $profession_id => $profession)
		{ 
		    $tmp = 0;
		    foreach ($data['professions'][$profession_id] as $char_id => $char_profession)
		        if(isset($char_profession['max']) AND $char_profession['val'] > 385)
		            $tmp++;
		    if($tmp == 0)
		        unset($data['professions'][$profession_id]);
		}
		//fill array with zeros
		//stats
		foreach($data['stats'] as $statid => $stat)
		{
		    for($char=0;$char<count($cns);$char++)
		        if(!isset($data['stats'][$statid][$char]))
		            $data['stats'][$statid][$char]['absolute']  = 0;
		    ksort($data['stats'][$statid]);
		}
		ksort($data['stats']);
		//gems
		foreach($data['gem'] as $gemid => $gem)
		{
		    for($char=0; $char<count($cns); $char++)
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
		$tpl->assign_vars('_stat_name', $_stat_name);
		$tpl->assign_vars('_skill_name', $_skill_name);
		$tpl->assign_vars('count', count($cns));
		$tpl->assign_vars('data', $data);
	}	//for($i=0;$i<count($cn);$i++)
}	//if(isset($_GET['cns']))
    
$tpl->setLeftTemplate("content_left.tpl");
$tpl->set_vars(array(
    'page_title'        => 'Envy Gear-Check',
    'author'            => 'author',
    'nav_active'        => 'TEST',
    'sub_nav_active'    => 'TEST',
    'subHeadBig'        => 'TEST-TEST',
    'subHeadSmall'    => 'WoW-Castle PvE 3.3.5',
    'description'        => 'Armory-basierter Gearcheck für WoW-Castle.de (blizzlike, pve, 3.3.5)',
    'template_file'        => 'compare.tpl',
));
$tpl->display();
?>
