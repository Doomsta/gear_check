<?php
class tooltips
{
    private $tooltip_js = '$(\'a\').tooltip().tooltip();';

    function __construct($tpl, $js=true) 
    {
        if($js == true)
            $tpl->add_script($this->tooltip_js);
    }

    function get_item_tooltip($item, $itemlist = null)
    {
        global $_item_class, $_inventory_type, $_stat_name, $_spell_desc;

        if(!isset($item['id']))
            return;
        $tpl = $this->get_item_template($item['id']); // TODO: Interpret item_template and integrate it into 

        // Item Name
        $tmp = '<div><table width=\'450\'><tr><td><b class=\'q'.$tpl['Quality'].'\'>'.$item['name'].'</b><br />';

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
                if ($gem['id'] == 49110) // Nightmare Tear
                {
                     $tmp .= '<img src=\'http://www.linuxlounge.net/~martin/wowimages/?item='.$gem['id'].'\' height=\'16\' width=\'16\'>&nbsp;+10 alle Werte';
                }
                else
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
            }
            else
                switch ($gem['socketColor']) {
                    case 1: //meta
                        $tmp .='<a class=\'socket-meta q0\'>Meta Sockel</a>';
                        break;
                    case 2: //red
                        $tmp .='<a class=\'socket-red q0\'>Roter Sockel</a>';
                        break;
                    case 4: //yellow
                        $tmp .='<a class=\'socket-yellow q0\'>Gelber Sockel</a>';
                        break;
                    case 8: //blue
                        $tmp .='<a class=\'socket-blue q0\'>Blauer Sockel</a>';
                        break;
                    default: //prismatic
                        $tmp .='<a class=\'socket-pristmatic q0\'>Prismatischer Sockel</a>';
                        break;
                }
            $tmp .= '<br />';
        }

        // Socket Bonus
        if($item['socketBonus'] != 0)
        {
            if (isset($item['socketBonusActive']) AND $item['socketBonusActive'])
                $tmp .= '<span class=\'q2\'>Sockelbonus: +'.$item['socketBonus']['stat_value1'].' '.$_stat_name[$item['socketBonus']['stat_type1']].'</span><br />';
            else
                $tmp .= '<span class=\'q0\'>Sockelbonus: +'.$item['socketBonus']['stat_value1'].' '.$_stat_name[$item['socketBonus']['stat_type1']].'</span><br />';
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
                $tmp .= '<span class=\'q2\'>Anlegen: Stellt alle 5 Sek. '.$value.' Mana wieder her</span><br />';
                if ($key == ItemStats::ITEM_MOD_HEALTH_REGEN)
                    $tmp .= '<span class=\'q2\'>Anlegen: Stellt alle 5 Sek. '.$value.' Gesundheit wieder her</span><br />';
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
            elseif (strlen($_spell_desc[$tpl['spellid_1']]) > 0) // length is important because of invisible spells like visual effects
                if ($tpl['spelltrigger_1'] == 0)
                    $tmp .= '<span class=\'q2\'>Benutzen: '.$_spell_desc[$tpl['spellid_1']].'</span><br />';
                else
                    $tmp .= '<span class=\'q2\'>Anlegen: '.$_spell_desc[$tpl['spellid_1']].'</span><br />';

        }

        $tmp .='       </td>
            </tr>
            </table></div>';

        // Description
        if (strlen($tpl['description']) > 0)
            $tmp .= '<span class=\'q\'>&quot;'.$tpl['description'].'&quot;</span>';

        // Item Set
        // TODO:
        // - Fetch set names, bonuses and activation data
        // - Awareness of other worn items (for set bonus activation)
        if ($tpl['itemset'] > 0)
        {
            $set = array();
            $settmp = null;
            
            $query = "SELECT `InventoryType`, `entry`, `name` FROM `".MYSQL_DATABASE_TDB."`.`item_template`  WHERE `itemset` = ".$tpl['itemset']."";
            $result = mysql_query($query);
            while($row = mysql_fetch_array($result))
            {
                if($row['InventoryType'] == 20)
                    $set[5][$row['entry']] = $row['name'];
                else
                    $set[$row['InventoryType']][$row['entry']] = $row['name'];
            }
            ksort($set);
            ksort($itemlist);
            $count = 0;
            foreach ($itemlist as $slot => $item)
                if (isset($set[$slot][$item]))
                {
                    $count++;
                   // echo '<br>'.$set[$slot][$item];
                   $settmp .= '<span class=\'q2\'>'.$set[$slot][$item].'</span><br />';
                }
                else
                {
                    $smallest = -1; // invalid
                       if (!isset($set[$slot]))  
                            continue;
                    foreach ($set[$slot] as $itemid => $name)
                        if ($itemid < $smallest || $smallest == -1)
                        {
                             $smallest = $itemid;
                            $settmp .= '<span class=\'q1\'>'.$name.'</span><br />';
                        }
                }
                $tmp .= '<span class=\'q1\'>'.$count.'/'.count($set).'</span><br />';
                $tmp .= $settmp;
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
