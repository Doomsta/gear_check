<?php

namespace App\Model\Entity;

use App\Model\StatCollection;

class Gem
{

    const PRISMATIC = 0;
    const META = 1;
    const RED = 2;
    const ORANGE = 3;
    const YELLOW = 4;
    const GREEN = 6;
    const BLUE = 8;
    const VIOLET = 9;

    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $rarity;
    /**
     * @var string
     */
    private $color;

    private $statCollection;

    /**
     * @param int $id
     * @param string $color
     * @param Stat[] $stats
     * @param int $rarity
     */
    public function __construct($id, $color, array $stats = array(), $rarity)
    {

        $this->id = $id;
        $this->rarity = $rarity;
        $this->color = $color;
        $this->statCollection = new StatCollection();

        foreach ($stats as $stat) {
            $this->statCollection->add($stat);
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    public function getColorName()
    {
        return "TODO";
    }

    /**
     * @return int
     */
    public function getRarity()
    {
        return $this->rarity;
    }

    public function getStats()
    {
        return $this->statCollection;
    }

    public function toArray()
    {
        $tmp = array();
        $tmp['color'] = $this->getColor();
        $tmp['colorName'] = $this->getColorName();
        $tmp['id'] = $this->getId();
        $tmp['rarity'] = $this->getRarity();
        $tmp['stats'] = $this->statCollection->toArray();
        return $tmp;
    }
}