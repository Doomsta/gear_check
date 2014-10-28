<?php

namespace App;

/**
 * Class Functions
 * @package App
 * @deprecated
 */

class Functions
{

    /**
     * @deprecated
     * @TODO implement this into ItemRepo may a new ItemClass
     * @param $itemId
     * @return array|bool
     */
    public static function get_weapon_properties($itemId)
    {
        $query = 'SELECT `dmg_min1`, `dmg_max1`, `delay`
            FROM `' . MYSQL_DATABASE_TDB . '`.`item_template`
            WHERE `entry` = ' . $itemId;
        $result = mysql_query($query);
        if (mysql_num_rows($result) == 0) {
            return false;
        }
        $row = mysql_fetch_assoc($result);
        $data = array(
            "min" => $row['dmg_min1'],
            "max" => $row['dmg_max1'],
            "delay" => $row['delay'],
            "dps" => number_format(round(((($row['dmg_min1'] + $row['dmg_max1']) / 2) / ($row['delay'] / 1000)), 1), 1)
        );
        return $data;
    }
}
