<?php

namespace App;

use App\Model\Entity\Item;
use App\Model\Entity\Stat;
use App\Model\Entity\Weapon;

class TooltipBuilder
{
    public function getItemTooltip(Item $item /*, Char $char*/)
    {

        $string = '<div>';
        $string .= '<table width=\'450\'><tr><td><b class=\'q' . $item->getRarity() . '\'>' . $item->getName() . '</b><br />';
        if ($item->isHero()) {
            $string .= '<span class=\'q2\'>Heroisch</span><br />';
        }
        $string .= '<span style=\'color: #ffffff\'>Beim Aufheben gebunden</span>';
        $string .= '<table width=\'100%\'><tr style=\'color: #ffffff;\'>';

        $string .= '<td>' . 'InventoryType' . $item->getInventoryType() . '</td><td style=\'text-align:right;\'>' . $item->getClass() . '</td>';
        $string .= '</tr></table><table width=\'100%\'>';

        $string .= $this->buildWeaponPart($item);
        $string .= '</table>';

        $string .= $this->buildArmorPart($item);
        $string .= $this->buildPrimStatsPart($item);
        // Durability (TODO)
        $string .= $this->buildEnchantPart($item);
        $string .= $this->buildGemPart($item);
        $string .= $this->buildGemBonusPart($item);
        $string .= $this->buildRequiredLevelPart($item);
        $string .= $this->buildItemLevelPart($item);
        $string .= $this->buildItemEffectPart($item);
        $string .= ' </td></tr></table></div>';
        $string .= $this->buildDescriptionPart($item);
        $string .= $this->buildSetPart($item /*, $char*/);

        return $string . '';
    }

    private function buildItemLevelPart(Item $item)
    {
        $string = '<span style=\'color: #ffffff\'>Gegenstandsstufe ' . $item->getLevel() . '</span><br />';
        foreach ($item->getStatCollection(true)->getSekStats() as $stat) {
            if ($stat->getType() == Stat::MANA_REGENERATION) {
                $string .= '<span class=\'q2\'>Anlegen: Stellt alle 5 Sek. ' . $stat->getValue() . ' Mana wieder her</span><br />';
            } elseif ($stat->getType() == Stat::HEALTH_REGEN) {
                $string .= '<span class=\'q2\'>Anlegen: Stellt alle 5 Sek. ' . $stat->getValue() . ' Gesundheit wieder her</span><br />';
            } else {
                $string .= '<span class=\'q2\'>Anlegen: Erh&ouml;ht ' . $stat->getName() . ' um ' . $stat->getValue() . '</span><br />';
            }
        }
        return $string;
    }

    private function buildRequiredLevelPart(Item $item)
    {
        $string = '';
        if ($item->getRequiredLevel()) {
            $string .= '<span style=\'color: #ffffff\'>Ben&ouml;tigt Level ' . $item->getRequiredLevel() . '</span><br />';
        }
        return $string;
    }

    private function buildGemBonusPart(Item $item)
    {
        $string = '';
        if ($item->hasSocketBonus()) {
            $bonus = $item->getGemCollection()->getSocketBonus();
            $q = $item->getGemCollection()->isSocketBonusActive() ? 2 : 0;
            $string .= '<span class=\'q' . $q . '\'>Sockelbonus: +' . $bonus->getValue() . ' ' . $bonus->getName() . '</span><br />';
        }
        return $string;
    }

    private function buildGemPart(Item $item)
    {
        $string = '';
        foreach ($item->getGemCollection()->getGems() as $gem) {
            if ($gem->getId() == 49110) // Nightmare Tear
                $string .= '<img src=\'http://www.linuxlounge.net/~martin/wowimages/?item=' . $gem->getId() . '\' height=\'16\' width=\'16\'>&nbsp;+10 alle Werte';
            elseif ($gem->getId() == 42702) // Enchanted Tear
                $string .= '<img src=\'http://www.linuxlounge.net/~martin/wowimages/?item=' . $gem->getId() . '\' height=\'16\' width=\'16\'>&nbsp;+6 alle Werte';
            else {
                $string .= '<img src=\'http://www.linuxlounge.net/~martin/wowimages/?item=' . $gem->getId() . '\' height=\'16\' width=\'16\'>';
                foreach ($gem->getStats()->getStats() as $stat) {
                    $string .= " +" . $stat->getValue() . " " . $stat->getName();
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

        return $string;
    }

    private function buildEnchantPart(Item $item)
    {
        $string = '';
        foreach ($item->getEnchants() as $enchant) {
            $string .= '<span class="q2">' . $enchant->getLabel() . '</span><br />';
        }
        return $string;
    }

    private function buildArmorPart(Item $item)
    {
        $string = '';
        if ($item->getStatCollection()->getStat(Stat::ARMOR, true)->getValue()) {
            $q = $item->getArmorDamageModifier() ? 2 : 1;
            $string .= '<span class=\'q' . $q . '\'>' . $item->getStatCollection()->getStat(Stat::ARMOR)->getValue() . ' Armor</span><br />';
        }
        return $string;
    }

    private function buildPrimStatsPart(Item $item)
    {
        $string = '';
        foreach ($item->getStatCollection()->getPrimStats() as $stat) {
            $string .= '<span class=\'q1\'>+' . $stat->getValue() . ' ' . $stat->getName() . '</span><br />';
        }
        return $string;
    }

    private function buildWeaponPart(Item $item)
    {
        $string = '';
        if ($item instanceof Weapon) // melee or ranged weapon
        {
                $string .= '<tr><td>'.$item->getMinDmg().' - '.$item->getMaxDmg().' Schaden</td><td style=\'text-align:right;\'>Tempo '.number_format($item->getDelay() / 1000, 2).'</td></tr>';
                $string .= '<tr><td>('.$item->getDps().' Schaden pro Sekunde)</td></tr>';
        }
        return $string;

    }

    private function buildItemEffectPart(Item $item)
    {
        $string = '';
        //foreach($item->getEffects() as $effect) {
        //  if($effect->isVisible()) {
        //      if($effect->isUseAble()) {
        //          $string .= '<span class=\'q2\'>Benutzen: '.$effect->getDescription().' ('.$effect->getCooldown().' '.$effect->getCooldownLabel.' Abklingzeit)</span><br />';
        //      } else {
        //          $string .= '<span class=\'q2\'>Anlegen: '.$effect->getDescription().'</span><br />';
        //      }
        //  }
        //}
        return $string;
    }

    private function buildDescriptionPart(Item $item)
    {
        $string = '';
        if ($item->getDescription()) {
            $string .= '<span class=\'q\'>&quot;' . $item->getDescription() . '&quot;</span>';
        }
        return $string;
    }

    private function buildSetPart(Item $item)
    {

        $string = '';
        if(!$item->isSetItem()) {
            return $string;
        }
        $string .= '<span>'.count($item->getSet()->getEquipedSetItems()).'/'.$item->getSet()->getSetSize().'</span><br />';
        foreach($item->getSet()->getEquipedSetItems() as $item) {
            $string .= $item->getName().'<br />';
        }
        return $string;
    }
} 