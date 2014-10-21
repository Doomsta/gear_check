<?php
class Tooltip
{
    private $tooltip_js = '$(\'a\').tooltip().tooltip();';

    public function __construct(&$tpl, $js = true)
    {
        if ($js == true) {
            $tpl->add_script($this->tooltip_js);
        }
    }

    // TODO: The complete structure of this method is ugly, swap out the different aspects to their own methods
    public function get_item_tooltip($item, $itemlist = null)
    {
        global $_item_class, $_inventory_type, $_stat_name, $_spell_desc;

        if (!isset($item['id'])) {
            return null;
        }
        $item_tpl = $this->get_item_template($item['id']); // TODO: Interpret item_template and integrate it into

        // Item Name
        $tmp = '<div><table width=\'450\'><tr><td><b class=\'q'.$item_tpl['Quality'].'\'>'.$item['name'].'</b><br />';

        // Heroic?
        if ($item_tpl['Flags'] & 8) {
            $tmp .= '<span class=\'q2\'>Heroisch</span><br />';
        }
        // TODO: Item Binding
        $tmp .='<span style=\'color: #ffffff\'>Beim Aufheben gebunden</span>';

        $tmp .='<table width=\'100%\'><tr style=\'color: #ffffff;\'>';

        // Item Classification
        $item_class = $_item_class[$item_tpl['class']][$item_tpl['subclass']];
        $inventory_type = $_inventory_type[$item_tpl['InventoryType']];

        $tmp .='<td>'.$inventory_type.'</td><td style=\'text-align:right;\'>'.$item_class[1].'</td>';

        $tmp .='</tr></table><table width=\'100%\'>';

        // Weapon Damage
        if ($item_tpl['class'] == 2) { // melee or ranged weapon

            $prop = get_weapon_properties($item_tpl['entry']); // TODO: Integrate this directly into the item
            if ($prop) {
                $tmp .= '<tr><td>'.$prop['min'].' - '.$prop['max'].' Schaden</td><td style=\'text-align:right;\'>Tempo '
                    .number_format($prop['delay'] / 1000, 2).'</td></tr>';
                $tmp .= '<tr><td>('.$prop['dps'].' Schaden pro Sekunde)</td></tr>';
            }
        }
        $tmp .='</table>';

        // Armor
        if (isset($item['stats'][ItemStats::ITEM_MOD_ARMOR]) && $item['stats'][ItemStats::ITEM_MOD_ARMOR] > 0) {
            if ($item_tpl['ArmorDamageModifier'] > 0) { // bonus armor has a green label
                $tmp .= '<span class=\'q2\'>' . $item['stats'][ItemStats::ITEM_MOD_ARMOR] . ' '
                    . $_stat_name[ItemStats::ITEM_MOD_ARMOR] . '</span><br />';
            } else {
                $tmp .= '<span class=\'q1\'>' . $item['stats'][ItemStats::ITEM_MOD_ARMOR] . ' '
                    . $_stat_name[ItemStats::ITEM_MOD_ARMOR] . '</span><br />';
            }
        }
        // White Stats (Base Stats)
        foreach ($item['stats'] as $key => $value) {
            if ($key < ItemStats::ITEM_MOD_AGILITY or $key > ItemStats::ITEM_MOD_STAMINA) {
                continue;
            }
            $tmp .= '<span class=\'q1\'>+'.$value.' '.$_stat_name[$key].'</span><br />';
        }

        // Enchants
        if (
            isset($item['permanentEnchantSpellId']) &&
            $item['permanentEnchantSpellId'] > 0 ||
                (isset($item['permanentEnchantItemId']) && $item['permanentEnchantItemId'] > 0)
        ) {
            if (isset($item['permanentEnchantSpellId']) && $item['permanentEnchantSpellId'] > 0) {
                $query = "SELECT `label` FROM `"
                    . MYSQL_DATABASE . "`.`enchant` WHERE `spell` = " . $item['permanentEnchantSpellId'] . "";
            } elseif (isset($item['permanentEnchantItemId']) && $item['permanentEnchantItemId'] > 0) {
                $query = "SELECT `label` FROM `" . MYSQL_DATABASE
                    . "`.`enchant` WHERE `item` = " . $item['permanentEnchantItemId'] . "";
            }
            #else break;
            $result = mysql_query($query);
            if (mysql_num_rows($result) == 0) {
                $tmp .= "<span class='q2'>Missing Label (".mysql_num_rows($result)." Results)</span><br />";
            } else {
                $row = mysql_fetch_assoc($result);
                $tmp .= "<span class='q2'>".$row['label']."</span><br />";
            }
        }

        // Gems
        foreach ($item['gems'] as $gem) {
            if (isset($gem['id'])) {
                if ($gem['id'] == 49110) { // Nightmare Tear
                    $tmp .= '<img src=\'http://www.linuxlounge.net/~martin/wowimages/?item=' . $gem['id']
                        . '\' height=\'16\' width=\'16\'>&nbsp;+10 alle Werte';
                } elseif ($gem['id'] == 42702) { // Enchanted Tear
                    $tmp .= '<img src=\'http://www.linuxlounge.net/~martin/wowimages/?item=' . $gem['id']
                        . '\' height=\'16\' width=\'16\'>&nbsp;+6 alle Werte';
                } else {
                    $query  = "SELECT `stat_type1`, `stat_value1`, `stat_type2`, `stat_value2`
                        FROM `".MYSQL_DATABASE."`.`socket_stats`
                        WHERE `id` = ".$gem['id'];
                    $result = mysql_query($query);
                    $row = mysql_fetch_assoc($result);
                    if (mysql_num_rows($result)==0) {
                        //error is already handled in provider static function checkGemBonus($items)
                    } else {
                        // first property
                        $str = " +".$row['stat_value1']." ".$_stat_name[$row['stat_type1']];

                        // second property
                        if ($row['stat_type2'] != 0) {
                            $str .= " und +" . $row['stat_value2'] . " " . $_stat_name[$row['stat_type2']] . "";
                        }
                        $tmp .='<img src=\'http://www.linuxlounge.net/~martin/wowimages/?item='.$gem['id']
                            .'\' height=\'16\' width=\'16\'>'.$str.'';
                    }
                }
            } else {
                switch ($gem['socketColor']) {
                    case 1: //meta
                        $tmp .= '<a class=\'socket-meta q0\'>Meta Sockel</a>';
                        break;
                    case 2: //red
                        $tmp .= '<a class=\'socket-red q0\'>Roter Sockel</a>';
                        break;
                    case 4: //yellow
                        $tmp .= '<a class=\'socket-yellow q0\'>Gelber Sockel</a>';
                        break;
                    case 8: //blue
                        $tmp .= '<a class=\'socket-blue q0\'>Blauer Sockel</a>';
                        break;
                    default: //prismatic
                        $tmp .= '<a class=\'socket-pristmatic q0\'>Prismatischer Sockel</a>';
                        break;
                }
            }
            $tmp .= '<br />';
        }

        // Socket Bonus
        if ($item['socketBonus']!= 0 and isset($item['socketBonus']['stat_value1'])) {
            if (isset($item['socketBonusActive']) and $item['socketBonusActive']) {
                $tmp .= '<span class=\'q2\'>Sockelbonus: +' . $item['socketBonus']['stat_value1']
                    . ' ' . $_stat_name[$item['socketBonus']['stat_type1']] . '</span><br />';
            } else {
                $tmp .= '<span class=\'q0\'>Sockelbonus: +' . $item['socketBonus']['stat_value1']
                    . ' ' . $_stat_name[$item['socketBonus']['stat_type1']] . '</span><br />';
            }
        }
        // Durability (TODO)
        // Not sure if armory hands out the proper data

        // Level Requirement
        if ($item_tpl['RequiredLevel'] > 1) {
            $tmp .= '<span style=\'color: #ffffff\'>Ben&ouml;tigt Level '.$item_tpl['RequiredLevel'].'</span><br />';
        }
        // Item Level
        $tmp .= '<span style=\'color: #ffffff\'>Gegenstandsstufe '.$item['level'].'</span><br />';

        // Green Stats (Secondary Stats)
        foreach ($item['stats'] as $key => $value) {
            if ($key <= ItemStats::ITEM_MOD_STAMINA) {
                continue;
            } elseif ($key == ItemStats::ITEM_MOD_MANA_REGENERATION) {
                $tmp .= '<span class=\'q2\'>Anlegen: Stellt alle 5 Sek. ' . $value . ' Mana wieder her</span><br />';
            } elseif ($key == ItemStats::ITEM_MOD_HEALTH_REGEN) {
                $tmp .= '<span class=\'q2\'>Anlegen: Stellt alle 5 Sek. '.$value.' Gesundheit wieder her</span><br />';
            } else {
                $tmp .= '<span  class=\'q2\'>Anlegen: Erh&ouml;ht '.$_stat_name[$key].' um '.$value.'</span><br />';
            }
        }

        // Item Effects (Use, Proc)
        // TODO:
        // - Move Spell Tooltips to DB
        for ($i = 1; $i <= 5; $i++) {
            if ($item_tpl['spellid_'.$i] > 0) {
                if (!isset($_spell_desc[$item_tpl['spellid_'.$i]])) {
                    //print error TODO
                    global $tpl;
                    $tpl->print_error(
                        'Missing Spell Description <a href="http://wotlk.openwow.com/spell='
                        .$item_tpl['spellid_'.$i].'">'.$item_tpl['spellid_'.$i].'</a>'
                    );
                } elseif (strlen($_spell_desc[$item_tpl['spellid_'.$i]]) > 0) {
                    // length is important because of invisible spells like visual effects
                    if ($item_tpl['spelltrigger_' . $i] == 0) {
                        $cooldown = $item_tpl['spellcooldown_' . $i] / 1000;
                        $cooldown_label = "Sek.";
                        if ($cooldown > 60) {
                            $cooldown /= 60;
                            $cooldown_label = "Min.";
                        }
                        $tmp .= '<span class=\'q2\'>Benutzen: ' . $_spell_desc[$item_tpl['spellid_' . $i]]
                            . ' (' . $cooldown . ' ' . $cooldown_label . ' Abklingzeit)</span><br />';
                    } else {
                        $tmp .= '<span class=\'q2\'>Anlegen: '.$_spell_desc[$item_tpl['spellid_'.$i]].'</span><br />';
                    }
                }
            }
        }

        $tmp .='</td>
            </tr>
            </table></div>';

        // Description
        if (strlen($item_tpl['description']) > 0) {
            $tmp .= '<span class=\'q\'>&quot;' . $item_tpl['description'] . '&quot;</span>';
        }
        // Item Set
        // TODO:
        // - Fetch set names, bonuses and activation data
        if ($item_tpl['itemset'] > 0) {
            $tmp .= "<br />";

            $set = array();
            $settmp = null;

            $query = "SELECT `InventoryType`, `entry`, `name` FROM `" . MYSQL_DATABASE_TDB
                . "`.`item_template`  WHERE `itemset` = " . $item_tpl['itemset'] . "";
            $result = mysql_query($query);
            while ($row = mysql_fetch_array($result)) {
                if ($row['InventoryType'] == 20) {
                    $set[5][$row['entry']] = $row['name'];
                } else {
                    $set[$row['InventoryType']][$row['entry']] = $row['name'];
                }
            }
            ksort($set);
            ksort($itemlist);
            $count = 0;
            foreach ($itemlist as $slot => $item) {
                if (isset($set[$slot][$item])) {
                    $count++;
                    // echo '<br>'.$set[$slot][$item];
                    $settmp .= '<span class=\'q6\'>' . $set[$slot][$item] . '</span><br />';
                } else {
                    $smallest = -1; // invalid
                    if (!isset($set[$slot])) {
                        continue;
                    }
                    foreach ($set[$slot] as $itemid => $name) {
                        if ($itemid < $smallest || $smallest == -1) {
                            $smallest = $itemid;
                        }
                    }
                    $settmp .= '<span class=\'q0\'>' . $set[$slot][$smallest].'</span><br />';
                        // This is not always accurate, the basic gladiator
                        // set for example has no adjective prefixed at all,
                        // we will print savage here though
                }

            }
            $tmp .= '<span class=\'q1\'>' . $count . '/' . count($set) . '</span><br />';
            $tmp .= $settmp;
        }
        return $tmp;
    }

    //TODO: Move away from tooltip, should be in char class, enhancing the item
    public function get_item_template($item_id)
    {
        $query = "SELECT * FROM `".MYSQL_DATABASE_TDB."`.`item_template`  WHERE `entry` = ".$item_id."";

        $result = mysql_query($query) or die(mysql_error());
        if (mysql_num_rows($result) == 0) {
            return false;
        }
        return mysql_fetch_assoc($result);
    }
}

