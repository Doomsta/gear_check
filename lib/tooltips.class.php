<?php
class tooltips
{
    private $tooltip_js = '$(\'a\').tooltip().tooltip();';

    function __construct($tpl, $js=true) 
    {
        if($js == true)
            $tpl->add_script($this->tooltip_js);
    }

    function get_item_tooltip($item)
    {
        global $_item_class, $_inventory_type, $_stat_name, $_spell_desc;

        if(!isset($item['id']))
            return;
        $tpl = $this->get_item_template($item['id']); // TODO: Interpret item_template and integrate it into 

        // Item Name
        // TODO: Quality
        $tmp = '<div><table width=\'450\'><tr><td><b class=\'q4\'>'.$item['name'].'</b><br />';

        // Heroic?
        if ($tpl['Flags'] & 8)
            $tmp .= '<span class=\'q2\'>Heroisch</span><br />';

        // TODO: Item Binding
        $tmp .='<span style=\'color: #ffffff\'>Beim Aufheben gebunden</span>';

        $tmp .='<table width=\'100%\'><tr style=\'color: #ffffff;\'>';

        // Item Classification
        $item_class = $_item_class[$tpl['class']][$tpl['subclass']];
        $inventory_type = $_inventory_type[$tpl['InventoryType']];

        $tmp .='<td>'.$inventory_type.'</td><td style=\'text-align:right;\'>'.$item_class[1].'</td>'; //TODO

        $tmp .='</tr></table><table width=\'100%\'>';

        // Weapon Damage
        if ($tpl['class'] == 2) // melee or ranged weapon
        {
            $prop = get_weapon_properties($tpl['entry']); // TODO: Integrate this directly into the item
            if ($prop)
            {
                $tmp .= '<tr><td>'.$prop['min'].' - '.$prop['max'].' Schaden</td><td style=\'text-align:right;\'>Tempo '.number_format($prop['delay'] / 1000, 2).'</td></tr>';
                $tmp .= '<tr><td>('.$prop['dps'].' Schaden pro Sekunde)</td></tr>';
            }
        }
        $tmp .='</table>';

        // Armor
        if (isset($item['stats'][ItemStats::ITEM_MOD_ARMOR]) && $item['stats'][ItemStats::ITEM_MOD_ARMOR] > 0)
            $tmp .= '<span class=\'q1\'>'.$item['stats'][ItemStats::ITEM_MOD_ARMOR].' '.$_stat_name[ItemStats::ITEM_MOD_ARMOR].'</span><br />';

        // White Stats (Base Stats)
        foreach ($item['stats'] as $key => $value)
        {
            if ($key < ItemStats::ITEM_MOD_AGILITY OR $key > ItemStats::ITEM_MOD_STAMINA)
                continue;
            $tmp .= '<span class=\'q1\'>+'.$value.' '.$_stat_name[$key].'</span><br />';
        }

        // Gems
        foreach($item['gems'] as $gem)
        {
            if(!isset($gem['socketColor']))
                break;
            if(isset($gem['id']))
            {
                $query  = "SELECT `stat_type1`, `stat_value1`, `stat_type2`, `stat_value2` 
                    FROM `".MYSQL_DATABASE."`.`socket_stats` 
                    WHERE `id` = ".$gem['id'];
                $result = mysql_query($query);
                $row = mysql_fetch_assoc($result);

                // first property
                $str = " +".$row['stat_value1']." ".$_stat_name[$row['stat_type1']];

                // second property
                if ($row['stat_type2'] != 0)
                    $str .= " und +".$row['stat_value2']." ".$_stat_name[$row['stat_type2']]."";

                $tmp .='<img src=\'http://www.linuxlounge.net/~martin/wowimages/?item='.$gem['id'].'\' height=\'16\' width=\'16\'>'.$str.'';
            }
            else
                switch ($gem['socketColor']) {
                    case 1: //meta
                        $tmp .='<a class=\'socket-meta q0\'>Meta Socket</a>';
                        break;
                    case 2: //red
                        $tmp .='<a class=\'socket-red q0\'>Red Socket</a>';
                        break;
                    case 4: //yellow
                        $tmp .='<a class=\'socket-yellow q0\'>Yellow Socket</a>';
                        break;
                    case 8: //blue
                        $tmp .='<a class=\'socket-blue q0\'>Blue Socket</a>';
                        break;
                }
            $tmp .= '<br />';
        }

        // Socket Bonus
        if($item['socketBonus'] != 0)
        {
            if (isset($item['socketBonusActive']) AND $item['socketBonusActive'])
                $tmp .= '<span class=\'q2\'>Socket Bonus: +'.$item['socketBonus']['stat_value1'].' '.$_stat_name[$item['socketBonus']['stat_type1']].'</span><br />';
            else
                $tmp .= '<span class=\'q0\'>Socket Bonus: +'.$item['socketBonus']['stat_value1'].' '.$_stat_name[$item['socketBonus']['stat_type1']].'</span><br />';
        }

        // Durability (TODO)
        // Not sure if armory hands out the proper data

        // Level Requirement
        if ($tpl['RequiredLevel'] > 1)
            $tmp .= '<span style=\'color: #ffffff\'>Ben&ouml;tigt Level '.$tpl['RequiredLevel'].'</span><br />';

        // Item Level
        $tmp .= '<span style=\'color: #ffffff\'>Gegenstandsstufe '.$item['level'].'</span><br />';        

        // Green Stats (Secondary Stats)
        foreach($item['stats'] as $key => $value)
        {
            if ($key <= ItemStats::ITEM_MOD_STAMINA)
                continue;
            if ($key == ItemStats::ITEM_MOD_MANA_REGENERATION)
                $tmp .= '<span class=\'q2\'>Anlege: Stellt alle 5 Sek. '.$value.' Mana wieder her</span><br />';
                if ($key == ItemStats::ITEM_MOD_HEALTH_REGEN)
                    $tmp .= '<span class=\'q2\'>Anlege: Stellt alle 5 Sek. '.$value.' Gesundheit wieder her</span><br />';
            else
                $tmp .= '<span  class=\'q2\'>Anlegen: Erh&ouml;ht '.$_stat_name[$key].' um '.$value.'</span><br />';   
        }

        // Item Effects (Use, Proc)
        // TODO: 
        // - Move Spell Tooltips to DB
        // - Check for spellid2 through spellid9
        if ($tpl['spellid_1'] > 0)
        {
            if (!isset($_spell_desc[$tpl['spellid_1']]))
                echo "Missing Spell Description ".$tpl['spellid_1']."<br />";
            else
                $tmp .= '<span class=\'q2\'>Anlegen: '.$_spell_desc[$tpl['spellid_1']].'</span><br />';
        }

        $tmp .='       </td>
            </tr>
            </table></div>';

        // Item Set
        // TODO:
        // - Fetch set names, bonuses and activation data
        // - Awareness of other worn items (for set bonus activation)
        if ($tpl['itemset'] > 0)
        {
            // set info
            $query = "SELECT `name` FROM `".MYSQL_DATABASE_TDB."`.`item_set_names` WHERE `entry` = ".$tpl['entry']."";
            $result = mysql_query($query);
            $row = mysql_fetch_assoc($result);
            
            $tmp .= "Set: ".$row['name']." (".$tpl['itemset'].")";
        }
        
        return $tmp;
    }

    function get_item_template($item_id)
    {
        $query = "SELECT * FROM `".MYSQL_DATABASE_TDB."`.`item_template`  WHERE `entry` = ".$item_id."";

        $result = mysql_query($query) or die(mysql_error());
        if (mysql_num_rows($result) == 0)
            return false;

        return mysql_fetch_assoc($result);
    }
}
?>
