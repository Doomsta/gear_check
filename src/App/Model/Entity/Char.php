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
    private $talents = array();
    private $professions = array();
    private $levelStats;

    public function __construct($name)
    {
        $this->name = $name;
        $this->equipment = new EquipCollection();
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
        $stats->merge($this->getClassLevelStats());
        $stats->merge($this->getEquipmentStats());
        return $stats;
    }

    /**
     * @return float
     */
    public function getAvgItemLevel()
    {
        return $this->equipment->getAvgItemLevel();
    }

    public function setClassLevelStats(StatCollection $stats)
    {
        $this->levelStats = $stats;
    }

    /**
     * @return StatCollection
     */
    public function getClassLevelStats()
    {
        return $this->levelStats;
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
