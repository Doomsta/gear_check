<?php

namespace App;


use App\Model\Entity\Char;
use App\Model\Entity\Item;
use App\Model\Entity\Stat;

class TooltipBuilder
{
    public function getItemTooltip(Item $item/*, Char $char*/)
    {

        $string = '<div>';
        $string .= '<table width=\'450\'><tr><td><b class=\'q'.$item->getRarity().'\'>'.$item->getName().'</b><br />';
        if ($item->isHero()) {
            $string .= '<span class=\'q2\'>Heroisch</span><br />';
        }
        $string .='<span style=\'color: #ffffff\'>Beim Aufheben gebunden</span>';
        $string .='<table width=\'100%\'><tr style=\'color: #ffffff;\'>';

        $string .='<td>'.'InventoryType'.$item->getInventoryType().'</td><td style=\'text-align:right;\'>'.$item->getClass().'</td>';
        $string .='</tr></table><table width=\'100%\'>';
        // Weapon Damage
        #if ($item_tpl['class'] == 2) // melee or ranged weapon
        #{
        #    $prop = get_weapon_properties($item_tpl['entry']); // TODO: Integrate this directly into the item
        #    if ($prop)
        #    {
        #        $tmp .= '<tr><td>'.$prop['min'].' - '.$prop['max'].' Schaden</td><td style=\'text-align:right;\'>Tempo '.number_format($prop['delay'] / 1000, 2).'</td></tr>';
        #        $tmp .= '<tr><td>('.$prop['dps'].' Schaden pro Sekunde)</td></tr>';
        #    }
        #}
        $string .='</table>';
        if ($item->getStatCollection()->getStat([Stat::ARMOR], true)->getValue() > 0)
        {
            $q = $item->getArmorDamageModifier()? 2:1;

                $string .= '<span class=\'q'.$q.'\'>'.$item->getStatCollection()->getStat([Stat::ARMOR])->getValue().' Armor</span><br />';
        }
        foreach ($item->getStatCollection()->getPrimStats() as $stat)
        {
            $string .= '<span class=\'q1\'>+'.$stat->getValue().' '.$stat->getName().'</span><br />';
        }
        foreach($item->getEnchants() as $enchant) {
            $string .= '<span class="q2">'.$enchant->getLabel().'</span><br />';
        }

        foreach($item->getGemCollection()->getGems() as $gem)
        {
            if ($gem->getId() == 49110) // Nightmare Tear
                $string .= '<img src=\'http://www.linuxlounge.net/~martin/wowimages/?item='.$gem->getId().'\' height=\'16\' width=\'16\'>&nbsp;+10 alle Werte';
            elseif ($gem->getId() == 42702) // Enchanted Tear
                $string .= '<img src=\'http://www.linuxlounge.net/~martin/wowimages/?item='.$gem->getId().'\' height=\'16\' width=\'16\'>&nbsp;+6 alle Werte';
            else
            {
                $string .='<img src=\'http://www.linuxlounge.net/~martin/wowimages/?item='.$gem->getId().'\' height=\'16\' width=\'16\'>';
                foreach($gem->getStats()->getStats() as $stat) {
                    $string .= " +".$stat->getValue()." ".$stat->getName();
                }
            }
            $string .= '<br/>';
        }
        #    else
        #        switch ($gem['socketColor']) {
        #            case 1: //meta
        #                $tmp .='<a class=\'socket-meta q0\'>Meta Sockel</a>';
        #                break;
        #            case 2: //red
        #                $tmp .='<a class=\'socket-red q0\'>Roter Sockel</a>';
        #                break;
        #            case 4: //yellow
        #                $tmp .='<a class=\'socket-yellow q0\'>Gelber Sockel</a>';
        #                break;
        #            case 8: //blue
        #                $tmp .='<a class=\'socket-blue q0\'>Blauer Sockel</a>';
        #                break;
        #            default: //prismatic
        #                $tmp .='<a class=\'socket-pristmatic q0\'>Prismatischer Sockel</a>';
        #                break;
        #        }
        #    $tmp .= '<br />';
        #}


        if($item->hasSocketBonus())
        {
            $bonus = $item->getGemCollection()->getSocketBonus();
            if ($item->getGemCollection()->isSocketBonusActive()) {
                $string .= '<span class=\'q2\'>Sockelbonus: +'.$bonus->getValue().' '.$bonus->getName().'</span><br />';
            } else {
                $string .= '<span class=\'q0\'>Sockelbonus: +'.$bonus->getValue().' '.$bonus->getName().'</span><br />';
                #$string .= '<span class=\'q0\'>Sockelbonus: +'.$item['socketBonus']['stat_value1'].' '.$_stat_name[$item['socketBonus']['stat_type1']].'</span><br />';
            }
        }

// Durability (TODO)
// Not sure if armory hands out the proper data
// Level Requirement
        if ($item->getRequiredLevel()) {
            $string .= '<span style=\'color: #ffffff\'>Ben&ouml;tigt Level '.$item->getRequiredLevel().'</span><br />';
        }

// Item Level
        $string .= '<span style=\'color: #ffffff\'>Gegenstandsstufe '.$item->getLevel().'</span><br />';
        foreach($item->getStatCollection(true)->getSekStats() as $stat) {
            if ($stat->getType() == Stat::MANA_REGENERATION) {
                $string .= '<span class=\'q2\'>Anlegen: Stellt alle 5 Sek. ' . $stat->getValue() . ' Mana wieder her</span><br />';
            } elseif ($stat->getType() == Stat::HEALTH_REGEN) {
                $string .= '<span class=\'q2\'>Anlegen: Stellt alle 5 Sek. ' . $stat->getValue() . ' Gesundheit wieder her</span><br />';
            } else {
                $string .= '<span class=\'q2\'>Anlegen: Erh&ouml;ht '.$stat->getName().' um '.$stat->getValue().'</span><br />';
            }
        }

// Item Effects (Use, Proc)
// TODO:
// - Move Spell Tooltips to DB

                #if (strlen($_spell_desc[$item_tpl['spellid_'.$i]]) > 0) // length is important because of invisible spells like visual effects
                #    if ($item_tpl['spelltrigger_'.$i] == 0)
                #    {
                #        $cooldown = $item_tpl['spellcooldown_'.$i] / 1000;
                #        $cooldown_label = "Sek.";
                #        if ($cooldown > 60)
                #        {
                #            $cooldown /= 60;
                #            $cooldown_label = "Min.";
                #        }
                #        $tmp .= '<span class=\'q2\'>Benutzen: '.$_spell_desc[$item_tpl['spellid_'.$i]].' ('.$cooldown.' '.$cooldown_label.' Abklingzeit)</span><br />';
                #    }
                #    else
                #        $tmp .= '<span class=\'q2\'>Anlegen: '.$_spell_desc[$item_tpl['spellid_'.$i]].'</span><br />';

        $string .=' </td></tr></table></div>';

// Description
        if ($item->getDescription())
            $string .= '<span class=\'q\'>&quot;'.$item->getDescription().'&quot;</span>';
        return $string.'';
// Item Set
// TODO:
// - Fetch set names, bonuses and activation data
        if ($item_tpl['itemset'] > 0)
        {
            $tmp .= "<br />";
            $set = array();
            $settmp = null;
            $query = "SELECT `InventoryType`, `entry`, `name` FROM `".MYSQL_DATABASE_TDB."`.`item_template` WHERE `itemset` = ".$item_tpl['itemset']."";
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
                    $settmp .= '<span class=\'q6\'>'.$set[$slot][$item].'</span><br />';
                }
                else
                {
                    $smallest = -1; // invalid
                    if (!isset($set[$slot]))
                        continue;
                    foreach ($set[$slot] as $itemid => $name)
                        if ($itemid < $smallest || $smallest == -1)
                            $smallest = $itemid;
                    $settmp .= '<span class=\'q0\'>'.$set[$slot][$smallest].'</span><br />'; // This is not always accurate, the basic gladiator set for example has no adjective prefixed at all, we will print savage here though
                }
            $tmp .= '<span class=\'q1\'>'.$count.'/'.count($set).'</span><br />';
            $tmp .= $settmp;
        }
        return $tmp;
    }
} 