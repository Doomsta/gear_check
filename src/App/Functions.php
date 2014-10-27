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
            WHERE `entry` = ' . $itemId . '';
        $result = mysql_query($query);
        if (mysql_num_rows($result) == 0) {
            return false; // item not found
        }
        $row = mysql_fetch_assoc($result);
        $data = array("min" => $row['dmg_min1'],
            "max" => $row['dmg_max1'],
            "delay" => $row['delay'],
            "dps" =>
                number_format(round(((($row['dmg_min1'] + $row['dmg_max1']) / 2) / ($row['delay'] / 1000)), 1), 1)
        );
        return $data;
    }

    /**
     * @deprecated will be moved in in Enchant repo
     * @param $id
     * @param $type
     * @return array|bool
     */
    public static function get_enchant_stats($id, $type)
    {
        $query = 'SELECT `stat1_type`, `stat1_value`, `stat2_type`, `stat2_value`,
        `stat3_type`, `stat3_value`, `stat4_type`, `stat4_value`,
        `stat5_type`, `stat5_value`
        FROM `' . MYSQL_DATABASE . '`.`enchant`
        WHERE `' . $type . '` = ' . $id . '';
        $result = mysql_query($query) or die(mysql_error());
        if (mysql_num_rows($result) == 0) {
            return false;
        }
        $data = mysql_fetch_assoc($result);
        return $data;
    }
}
