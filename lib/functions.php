<?php
function get_item_stats($id)
{
    $query = 'SELECT `armor`, `stat_type1`, `stat_value1`, `stat_type2`, `stat_value2`, `stat_type3`, `stat_value3`,  
        `stat_type4`, `stat_value4`, `stat_type5`, `stat_value5`, `stat_type6`, `stat_value6`,
                `stat_type7`, `stat_value7`, `stat_type8`, `stat_value8` 
        FROM `'. MYSQL_DATABASE_TDB .'`.`item_template` 
        WHERE `entry` = \''.$id.'\'';
    $result = mysql_query($query);
    $tmp = mysql_fetch_assoc($result);
    $data = array();
    for($i=1;$i<9;$i++)
    {
        if($tmp['stat_value'.$i] == 0)
            break;
        $data[$tmp['stat_type'.$i]] = $tmp['stat_value'.$i];
    }
    
    // armor value
    $data[ItemStats::ITEM_MOD_ARMOR] = $tmp['armor'];
    
    // sort & return
    ksort($data);
    return $data;
}

function get_weapon_properties($itemId)
{
        $query = 'SELECT `dmg_min1`, `dmg_max1`, `delay`
                FROM `'. MYSQL_DATABASE_TDB .'`.`item_template`
                WHERE `entry` = '.$itemId.'';
        $result = mysql_query($query);
        if (mysql_num_rows($result) == 0)
            return false; // item not found
        $row = mysql_fetch_assoc($result);
        $data = array("min" => $row['dmg_min1'],
                      "max" => $row['dmg_max1'],
                      "delay" => $row['delay'],
                      "dps" => number_format(round(((($row['dmg_min1'] + $row['dmg_max1']) / 2) / ($row['delay'] / 1000)), 1), 1)
                );
        return $data;        
}

function add_item_gems($item)
{
    $query = 'SELECT `socketColor_1`, `socketColor_2`, `socketColor_3`, `socketBonus`
        FROM  `'. MYSQL_DATABASE_TDB .'`.`item_template` 
        WHERE `entry` = \''.$item['id'].'\'';
    $result = mysql_query($query);
    $data = mysql_fetch_array($result);
    for($i=0; $i<3; $i++)
        if(!$data['socketColor_'.($i+1)] == 0)
            $item['gems'][$i]['socketColor'] = $data['socketColor_'.($i+1)];
    $item['socketBonus'] = $data['socketBonus'];
    return $item; 
}

function get_gems_stats($id)
{
    $query = 'SELECT `name`, `color`, `stat_type1`, `stat_value1`, `stat_type2`, `stat_value2`, `rarity`
        FROM `'.MYSQL_DATABASE .'`.`socket_stats`
        WHERE id = '.$id.'';
    $result = mysql_query($query);
    if(mysql_num_rows($result) == 1)
        $data = mysql_fetch_assoc($result);
    else
        $data['name'] = 'unknown';   
    return $data;
}
function get_item_gems($id)
{
    $query = 'SELECT `socketColor_1`, `socketColor_2`, `socketColor_3`, `socketBonus`
        FROM `'.MYSQL_DATABASE_TDB.'`.`item_template` 
        WHERE `entry` = '.$id.'';
    $result = mysql_query($query);
    $data = mysql_fetch_assoc($result);
    for($i=1;$i<4;$i++)
        if($data['socketColor_'.$i] == 0)
            unset($data['socketColor_'.$i]);
    return $data;
}

function get_enchant_stats($id, $type)
{
    $query = 'SELECT `stat1_type`, `stat1_value`, `stat2_type`, `stat2_value`,
        `stat3_type`, `stat3_value`, `stat4_type`, `stat4_value`,
        `stat5_type`, `stat5_value`
        FROM `'.MYSQL_DATABASE.'`.`enchant`
        WHERE `'.$type.'` = '.$id.'';
    $result = mysql_query($query) or die(mysql_error());
    if (mysql_num_rows($result) == 0)
        return false;
    $data = mysql_fetch_assoc($result);
    return $data;
}

function cmp($a, $b)
{
    return strcmp($a["color"], $b["color"]);
}

?>
