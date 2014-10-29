<?php

namespace App\Model\Entity;

use App\AbstractChar;
use App\Model\EquipCollection;
use App\Model\StatCollection;

/**
 * Class Char
 */
class Char extends AbstractChar
{
    private $name;
    /** @var EquipCollection  */
    private $equipment;
    private $stats = array();
    private $talents = array();
    private $professions = array();
    private $slotOrder = array(1, 2, 3, 15, 5, 4, 19, 9, 10, 6, 7, 8, 11, 12, 13, 14, 16, 17, 18);

    public function __construct($name)
    {
        $this->name = $name;
        $this->equipment = new EquipCollection();
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
     * @TODO move this to equipCollection
     * @return StatCollection
     */
    public function getEquipmentStats()
    {
        $tmp = new StatCollection();
        foreach ($this->equipment->getItems() as $item) {
            $tmp->merge($item->getStatCollection());
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
        foreach ($this->equipment->getItems() as $item) {
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
    public function getMaxHp()
    {
        return $this->getStats()->getStat(Stat::HEALTH)->getValue();
    }

    /**
     * @TODO racial bonuses
     * @TODO handle bars mana and so on
     * @return StatCollection
     */
    public function getStats()
    {
        $stats = new StatCollection();

        //add base stats
        #if ($baseStats = $this->getClassBaseStats()) {
        $stats->merge($this->getClassLevelStats());

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
     * @return float
     */
    public function getAvgItemLevel()
    {
        return $this->equipment->getAvgItemLevel();
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
        $stats->add(new Stat(Stat::STRENGTH, $row['str']));
        $stats->add(new Stat(Stat::AGILITY, $row['agi']));
        $stats->add(new Stat(Stat::STAMINA, $row['sta']));
        $stats->add(new Stat(Stat::INTELLECT, $row['inte']));
        $stats->add(new Stat(Stat::SPIRIT, $row['spi']));

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
        $stats->add(new Stat(Stat::MANA, $row['basemana']));
        $stats->add(new Stat(Stat::HEALTH, $row['basehp']));
        return $tmp;
    }

    /**
     * @return EquipCollection
     */
    public function getEquipmentCollection()
    {
        return $this->equipment;
    }

    /**
     * this function needs to be called last, because all calculations scale with talents, enchants, etc.
     * @TODO handle this with auras
     */
    private function deriveStats($stats)
    {
        // Armor from Agility
        $stats[Stat::ARMOR] += $stats[Stat::AGILITY] * 2;
        // Health from Stamina
        $stats[Stat::HEALTH] += 20 + (max($stats[Stat::STAMINA] - 20, 0)) * 10;
        // Mana from Intellect
        $stats[Stat::MANA] += 20 + (max($stats[Stat::INTELLECT] - 20, 0)) * 15;
        return $stats;
    }

    public function getItems()
    {
         return $this->equipment;
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

    /**
     * @TODO
     * @param $slot
     * @return null
     */
    public function getItem($slot)
    {
        return $this->equipment->getItemBySlotId($slot);
        #$this->equipment[$slot];
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
