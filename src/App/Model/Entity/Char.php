<?php

namespace App\Model\Entity;

use App\AbstractChar;
use App\Functions;
use App\Model\StatCollection;
use App\Provider;
use App\SocketInterface;
use App\StatInterface;

/**
 * Class Char
 */
class Char extends AbstractChar
{
    private $name;
    /** @var Item[]  */
    private $equipment = array();
    private $stats = array();
    private $talents = array();
    private $professions = array();
    private $slotOrder = array(1, 2, 3, 15, 5, 4, 19, 9, 10, 6, 7, 8, 11, 12, 13, 14, 16, 17, 18);
    /**
     * @var array
     * @deprecated use Stat:: instead .. coming soon
     */
    private static $statName = array(
        -1 => 'R&uuml;stung', // custom
        0 => 'Mana',
        1 => 'Leben',
        // 2 => probably faulty/missing socket bonus (like 2952, +4 crit)
        3 => 'Beweglichkeit',
        4 => 'St&auml;rke',
        5 => 'Intelligenz',
        6 => 'Willenskraft',
        7 => 'Ausdauer',
        12 => 'Verteidigungswertung',
        13 => 'Ausweichwertung',
        14 => 'Parierwertung',
        15 => 'Blockwertung',
        20 => 'Kritische Distanztrefferwertung',
        31 => 'Trefferwertung',
        32 => 'kritische Trefferwertung',
        35 => 'Abh&auml;rtungswertung',
        36 => 'Tempowertung',
        37 => 'Waffenkunde',
        38 => 'Angriffskraft',
        42 => '',
        43 => 'Mana alle 5 Sek.',
        45 => 'Zaubermacht',
        44 => 'Rüstungsdurchschlagwertung',
        46 => 'Leben alle 5 Sek.',
        47 => 'Zauberdurchschlag',
        48 => 'Blockwert eures Schildes'
    );

    public function __construct($name)
    {
        $this->name = $name;
        $this->initArrays();
    }

    /**
     * @deprecated
     */
    protected function initArrays()
    {
        foreach ($this::$statName as $value) {
            $this->stats[$value] = 0;
        }
    }

    public function addItemTooltips(&$tooltip)
    {
        $itemList = array();
        foreach ($this->slotOrder as $i) {
            $itemList[$i] = $this->equipment[$i]['id'];
        }
        foreach ($this->slotOrder as $i) {
            $this->equipment[$i]['tooltip'] = $tooltip->get_item_tooltip($this->equipment[$i], $itemList);
        }
    }

    public function getTalents()
    {
        return $this->talents;
    }

    public function getActiveTalent()
    {
        return $this->talents['active'];
    }

    /**
     * @return StatCollection
     */
    public function getEquipmentStats()
    {
        $tmp = new StatCollection();
        foreach ($this->equipment as $item) {
            $tmp->merge($item->getStats());
        }
        return $tmp;
    }

    /**
     * @TODO return ja fancy collection class or a flat array
     * @return array
     */
    public function getSockets()
    {
        $tmp = array();
        foreach ($this->equipment as $item) {
            foreach ($item->getGemCollection()->getGems() as $gem) {

                if (isset( $tmp[$gem->getId()] )) {
                    $tmp[$gem->getId()]['count']++;
                } else {
                    $tmp[$gem->getId()] = $gem->toArray();
                    $tmp[$gem->getId()]['count'] = 1;
                }
            }
        }
        return $tmp;
    }

    /**
     * @TODO
     * @return int
     */
    public function getMaxHp() {
        return $this->getStats()->getStat(StatInterface::ITEM_MOD_HEALTH)->getValue();
    }

    /**
     * @TODO fix
     */
    public function getEnchants()
    {
        $tmp = array();
        #foreach ($this->equipment as $item) {
        #    if (isset($item['permanentEnchantItemId']) && $item['permanentEnchantItemId'] > 0) {
        #        $stats = Functions::get_enchant_stats($item['permanentEnchantItemId'], 'item');
        #    } elseif (isset($item['permanentEnchantSpellId']) && $item['permanentEnchantSpellId'] > 0) {
        #        $stats = Functions::get_enchant_stats($item['permanentEnchantSpellId'], 'spell');
        #    } else {
        #        $stats = false;
        #    }
        #    if ($stats) {
        #        $tmp[] = $stats;
        #    }
        #}
        return $tmp;
    }

    /**
     * @TODO racial bonuses
     * @TODO socket boni
     * @TODO handle bars mana and so on
     * @TODO use StatCollection
     * @return StatCollection
     */
    public function getStats()
    {
        $stats = new StatCollection();

        //add base stats
        #if ($baseStats = $this->getClassBaseStats()) {
        $stats->merge($this->getClassLevelStats());
        #    foreach ($baseStats as $statId => $statValue) {
        #        $stats[$statId] += $statValue;
        #    }
        #}
        //add class stats
        #if ($classStats = $this->getClassLevelStats()) {
        #    foreach ($classStats as $statId => $statValue) {
        #        $stats[$statId] += $statValue;
        #    }
        #}
        $stats->merge($this->getEquipmentStats());
        //add socket boni
        //add enchants
        #$enchants = $this->getEnchants();
        #foreach ($enchants as $enchant) {
        #    for ($i = 1; $i <= 5; $i++) {
        #        $stats[$enchant['stat' . $i . '_type']] += $enchant['stat' . $i . '_value'];
        #    }
        #}
        // final calculations
        #$stats = $this->deriveStats($stats);


        #$stats[0] = 10000; #TODO the 1000 is just a placeholder
        return $stats;
    }

    /**
     * @TODO move this into a ItemCollection/Container/Handler or so on
     * @return float|int|mixed
     */
    public function getAvgItemLevel()
    {
        $tmp = 0;
        foreach ($this->equipment as $slot => $item) {
            if ($slot == 4 or $slot == 19) {
                continue;
            }
            $tmp += $item->getLevel();
        }
        if (isset($this->equipment[16]) and isset($this->equipment[17])) {
            $tmp = round(($tmp / 17), 1);
        } else {
            $tmp = round(($tmp / 16), 1);
        }
        return $tmp;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'name' => $this->getName(),
            'suffix' => $this->getSuffix(),
            'prefix' => $this->getPrefix(),
            'raceId' => $this->getRaceId(),
            'classId' => $this->getClassId(),
            'genderId' => $this->getGenderId(),
            'level' => $this->getLevel(),
            'guild' => $this->getGuildName()
        );

    }

    /**
     * @TODO remove sql stuff
     * @return StatCollection
     */
    public function getClassLevelStats()
    {
        if (($this->getClassId() === false)) {
            return false;
        }
        if ($this->getLevel() == 0) {
            return array();
        }
        $query = 'SELECT `str`, `agi`, `sta`, `inte`, `spi` 
            FROM `' . MYSQL_DATABASE_TDB . '`.`player_levelstats`
            WHERE `race` = ' . $this->getRaceId() . ' AND `class` = ' . $this->getClassId() . ' AND level = ' . $this->getLevel() . '';
        $result = mysql_query($query);

        $row = mysql_fetch_assoc($result);
        $stats = new StatCollection();
        $stats->add(new Stat(StatInterface::ITEM_MOD_STRENGTH, $row['str']));
        $stats->add(new Stat(StatInterface::ITEM_MOD_AGILITY, $row['agi']));
        $stats->add(new Stat(StatInterface::ITEM_MOD_STAMINA, $row['sta']));
        $stats->add(new Stat(StatInterface::ITEM_MOD_INTELLECT, $row['inte']));
        $stats->add(new Stat(StatInterface::ITEM_MOD_SPIRIT, $row['spi']));

        return $stats;
    }

    /**
     * @TODO remove sql stuff
     * @return array|bool
     */
    public function getClassBaseStats()
    {
        if (!isset($this->race)) {
            return false;
        }
        $query = 'SELECT `basehp`, `basemana`
            FROM `' . MYSQL_DATABASE_TDB . '`.`player_classlevelstats`
            WHERE `class` = ' . $this->getClassId() . ' AND `level` = ' . $this->getLevel() . '';
        $result = mysql_query($query);
        $tmp = array();
        $row = mysql_fetch_assoc($result);

        $stats = new StatCollection();
        $stats->add(new Stat(StatInterface::ITEM_MOD_MANA, $row['basemana']));
        $stats->add(new Stat(StatInterface::ITEM_MOD_HEALTH, $row['basehp']));
        return $tmp;
    }

    // this function needs to be called last, because all calculations scale with talents, enchants, etc.
    private function deriveStats($stats)
    {
        // Armor from Agility
        $stats[StatInterface::ITEM_MOD_ARMOR] += $stats[StatInterface::ITEM_MOD_AGILITY] * 2;
        // Health from Stamina
        $stats[StatInterface::ITEM_MOD_HEALTH] += 20 + (max($stats[StatInterface::ITEM_MOD_STAMINA] - 20, 0)) * 10;
        // Mana from Intellect
        $stats[StatInterface::ITEM_MOD_MANA] += 20 + (max($stats[StatInterface::ITEM_MOD_INTELLECT] - 20, 0)) * 15;
        return $stats;
    }

    public function getItems()
    {
         return array_values($this->equipment);
    }

    public function getProfessions()
    {
        return $this->professions;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @deprecated
     * @return string
     */
    public function getGuild()
    {
        return $this->getGuildName();
    }

    /**
     * @deprecated
     * @return int
     */
    public function getRace()
    {
        return $this->getRaceId();
    }

    /**
     * @deprecated
     * @return mixed
     */
    public function getClass()
    {
        return $this->getClassId();
    }

    public function getItem($slot)
    {
        return $this->equipment[$slot];
    }

    /**
     * @deprecated
     * @param $items
     * @return mixed
     */
    public function checkGemBonus($items) // TODO: Gem bonuses are not provider-specific, move to character
    {
        $gems = array();
        foreach ($items as $item)
            if (isset($item['gems']))
                foreach ($item['gems'] as $gem)
                    if (isset($gem['id']))
                        $gems[$gem['id']] = true;

        if (count($gems) == 0)
            return $items;

        $query = "SELECT `id`, `name`, `color` FROM `".MYSQL_DATABASE."`.`socket_stats` WHERE id IN (".implode(",", array_keys($gems)).")";
        unset($gems);
        $result = mysql_query($query);

        $color = array();
        while ($row = mysql_fetch_assoc($result))
            $color[$row['id']] = $row['color'];
        foreach ($items as $slot => $item)
        {
            if (!isset($item['gems']))
                continue;
            foreach ($item['gems'] as $gemslot => $gem)
            {
                if (isset($gem['id']) AND !isset($color[$gem['id']]))
                {
                    continue;
                }
                if (!isset($gem['id']))
                {
                    $items[$slot]['socketBonusActive'] = false;
                    break; // break, because activation can't happen anymore
                }

                // evaluate gem for sockets
                $c = $color[$gem['id']];
                $items[$slot]['gems'][$gemslot]['gemColor'] = $c;

                $result = false;
                if ($c == SocketInterface::Prismatic) // gem is prismatic, fits everywhere
                    $result = true;
                else {
                    if (!isset($gem['socketColor'])) break;
                    switch ($gem['socketColor']) {
                        case SocketInterface::Red:
                            if ($c == SocketInterface::Red || $c == SocketInterface::Orange || $c == SocketInterface::Violet)
                                $result = true;
                            break;
                        case SocketInterface::Yellow:
                            if ($c == SocketInterface::Yellow || $c == SocketInterface::Orange || $c == SocketInterface::Green)
                                $result = true;
                            break;
                        case SocketInterface::Blue:
                            if ($c == SocketInterface::Blue || $c == SocketInterface::Green || $c == SocketInterface::Violet)
                                $result = true;
                            break;
                        case SocketInterface::Meta:
                        case SocketInterface::Prismatic:
                            $result = true;
                            break;
                    }
                }

                if (!isset($items[$slot]['gems']['socketBonusActive']))
                {
                    $items[$slot]['socketBonusActive'] = $result;
                    $items[$slot]['gems'][$gemslot]['matching'] = $result;

                }
                else
                    $items[$slot]['socketBonusActive'] &= $result;

                if (!$result)
                    break;
            }
        }
        return $items;
    }

    /**
     * @deprecated
     * @param $items
     * @return mixed
     */
    public function lookupGemBonuses($items) // TODO: Gem bonuses are not provider-specific, move to character
    {
        $boni = array();
        foreach ($items as $item)
            if (isset($item['socketBonus']))
                $boni[$item['socketBonus']] = true;

        if (count($boni) == 0) // no bonuses, no lookup
            return $items;

        $query = "SELECT  `id`, `stat_type1`, `stat_value1` FROM `". MYSQL_DATABASE ."`.`socket_bonus` WHERE id IN (".implode(",", array_keys($boni)).")";
        $result = mysql_query($query);
        $boni = array();
        while ($row = mysql_fetch_assoc($result))
            $boni[$row['id']] = array('stat_type1' => $row['stat_type1'], 'stat_value1' => $row['stat_value1']);
        foreach ($items as $i => $item)
        {
            if ($items[$i]['socketBonus'] == 0)
                continue;
            if (isset($items[$i]['socketBonus']))
            {
                if (!isset($boni[$item['socketBonus']]))
                {
                    continue;
                }
                $items[$i]['socketBonus'] = array(
                    'stat_type1' => $boni[$item['socketBonus']]['stat_type1'],
                    'stat_value1' => $boni[$item['socketBonus']]['stat_value1']
                );
            }
        }
        return $items;
    }

    /**
     * @TODO implement ItemCollection
     * @param $slot
     * @param $item
     */
    public function addItem($slot, $item)
    {
        $this->equipment[$slot] = $item;
    }

    /**
     * @TODO add ProfessionClass and ProfessionCollection
     * @param $id
     * @param $level
     */
    public function addProfession($id, $level)
    {
        $this->professions[$id] = $level;
    }
}
