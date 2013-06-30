<?php
function get_item_stats($id)
{
	$query = 'SELECT `stat_type1`, `stat_value1`, `stat_type2`, `stat_value2`, `stat_type3`, `stat_value3`,  
				`stat_type4`, `stat_value4`, `stat_type5`, `stat_value5`,  
				`stat_type6`, `stat_value6`, `stat_type7`, `stat_value7`,  
				`stat_type8`, `stat_value8` 
			FROM `item_template` 
			WHERE `entry` = \''.$id.'\'';
	$result = mysql_query($query);
	$tmp = mysql_fetch_array($result);
	$data = array();
	for($i=1;$i<9;$i++)
	{
		if($tmp['stat_value'.$i] == 0)
			break;
		$data[$tmp['stat_type'.$i]] = $tmp['stat_value'.$i];
	}
    ksort($data);
	return $data;
}

function add_item_gems($item)
{
	$query = 'SELECT `socketColor_1`, `socketColor_2`, `socketColor_3`, `socketBonus`
				FROM `item_template` 
				WHERE `entry` = \''.$item['id'].'\'';
	$result = mysql_query($query);
	$data = mysql_fetch_array($result);
	for($i=0; $i<3; $i++)
		if(!$data['socketColor_'.($i+1)] == 0)
			$item['gems'][$i]['socketColor'] = $data['socketColor_'.($i+1)];
	$item['socketBonus'] = $data['socketBonus'];
	return($item); 
}

function get_gems_stats($id)
{
    $query = "SELECT `name`, `stat_type1`, `stat_value1`, `stat_type2`, `stat_value2` FROM test.socket_stats2 WHERE id = \"$id\"";
    $result = mysql_query($query);
	$data = mysql_fetch_array($result);
    for($i=0;$i<5;$i++)
        unset($data[$i]);
    return $data;
}
function get_item_gems($id)
{
	$query = 'SELECT `socketColor_1`, `socketColor_2`, `socketColor_3`, `socketBonus`
			FROM `item_template` 
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
