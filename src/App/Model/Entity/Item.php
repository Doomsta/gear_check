<?php


namespace App\Model\Entity;


use App\Model\GemCollection;
use App\Model\StatCollection;

class Item
{
    private $id;
    private $name;
    private $slot;
    private $class;
    private $rarity;
    private $icon;
    private $displayedId;
    private $inventoryType;
    private $level;
    private $flags;
    private $socketBonus;
    private $statCollection;
    private $gemCollection;
    private $enchants = array();

    public function __construct($id)
    {
        $this->id = $id;
        $this->gemCollection = new GemCollection();
        $this->statCollection = new StatCollection();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getDisplayedId()
    {
        return $this->displayedId;
    }

    /**
     * @param mixed $displayedId
     */
    public function setDisplayedId($displayedId)
    {
        $this->displayedId = $displayedId;
    }

    /**
     * @return int
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param int $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @return int
     */
    public function getInventoryType()
    {
        return $this->inventoryType;
    }

    /**
     * @param mixed $inventoryType
     */
    public function setInventoryType($inventoryType)
    {
        $this->inventoryType = $inventoryType;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * @param mixed $flags
     */
    public function setFlags($flags)
    {
        $this->flags = $flags;
    }

    public function addStat(Stat $stat)
    {
        $this->statCollection->add($stat);
    }

    public function addSocketBonus($id)
    {
        $this->socketBonus = $id;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return int
     */
    public function getRarity()
    {
        return $this->rarity;
    }

    /**
     * @param int $rarity
     */
    public function setRarity($rarity)
    {
        $this->rarity = $rarity;
    }

    /**
     * @deprecated move this to gearCollection
     * @return int
     */
    public function getSlot()
    {
        return $this->slot;
    }

    /**
     * @deprecated move this to gearCollection
     * @param mixed $slot
     */
    public function setSlot($slot)
    {
        $this->slot = $slot;
    }

    /**
     * @return StatCollection
     */
    public function getStatCollection()
    {
        $result = new StatCollection();
        $result->merge($this->statCollection);
        $result->merge($this->gemCollection->getStats());
        foreach ($this->getEnchants() as $enchant) {
            $result->merge($enchant->getStatCollection());
        }
        if($this->isSocketBonusActive()) {
            $result->add($this->getSocketBonus());
        }
        return $result;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function addEnchant(Enchant $enchant)
    {
        $this->enchants[] = $enchant;
    }

    /**
     * @return Enchant[]
     */
    public function getEnchants()
    {
        return $this->enchants;
    }

    /**
     * @return GemCollection
     */
    public function getGemCollection()
    {
       return $this->gemCollection;
    }

    public function isHero()
    {
        return (bool) ($this->getFlags() & 8);
    }

    public function toArray()
    {
        $result = array();

        $result['id'] = $this->getId();
        $result['name'] = $this->getName();
        $result['class'] = $this->getClass();
        $result['rarity'] = $this->getRarity();
        $result['flag'] = $this->getFlags();
        $result['icon'] = $this->getIcon();
        $result['level'] = $this->getLevel();
        $result['displayedId'] = $this->getDisplayedId();
        $result['stats'] = $this->statCollection->toArray();

        return $result;
    }

    /**
     * @TODO
     * @return bool
     */
    private function isSocketBonusActive()
    {
        return true;
    }

    /**
     * @return Stat
     */
    public function getSocketBonus()
    {
        return $this->socketBonus;
    }
}
