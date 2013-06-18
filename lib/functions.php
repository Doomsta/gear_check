<?php
function get_item_stats($id)
{
	include('defines.php'); // >.<
	$query = 'SELECT `StatsCount`, `stat_type1`, `stat_value1`, `stat_type2`, `stat_value2`, `stat_type3`, `stat_value3`,  
				`stat_type4`, `stat_value4`, `stat_type5`, `stat_value5`,  
				`stat_type6`, `stat_value6`, `stat_type7`, `stat_value7`,  
				`stat_type8`, `stat_value8` 
			FROM `world`.`item_template` 
			WHERE `entry` = \''.$id.'\'';
	$result = mysql_query($query);
	$data = mysql_fetch_array($result);
	for($i=0;$i<count($data);$i++)
		unset($data[$i]);
	for($i=1;$i<9;$i++) 
	{
		if($data['stat_type'.$i] == 0)
		{
			unset($data['stat_type'.$i]);
			unset($data['stat_value'.$i]);
		}
		else
			$data['stat_type'.$i] = $_stat_typ[$data['stat_type'.$i]];
	}
	
	return($data);
}
function get_item_gems($id)
{
	$query = 'SELECT `socketColor_1`, `socketColor_2`, `socketColor_3`, `socketBonus`
			FROM `world`.`item_template` 
			WHERE `entry` = \''.$id.'\'';
	$result = mysql_query($query);
	$data = mysql_fetch_array($result);
	for($i=0;$i<count($data);$i++)
		unset($data[$i]);
	for($i=1;$i<4;$i++)
		if($data['socketColor_'.$i] == 0)
			unset($data['socketColor_'.$i]);
	return $data;
}
?>