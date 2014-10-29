<?php

namespace App\Model;

use App\Model\Entity\Gem;
use App\Model\Entity\Stat;

class GemCollection
{
    /**
     * @var Gem[]
     */
    private $gems = array();
    private $slotColors = array();
    /** @var Stat */
    private $bonus;

    public function __construct()
    {
        $this->bonus = new Stat(0, 0);
    }

    public function addGemSlot($color)
    {
        $this->slotColors[] = $color;
    }

    public function addGem(Gem $gem)
    {
        $this->gems[] = $gem;
        return true;
    }

    public function setGem(Gem $gem, $slot)
    {
        if (isset($this->slotColors[$slot])) {
            return false;
        }
        $this->gems[$slot] = $gem;
        return true;
    }

    public function setBonus(Stat $bonus)
    {
        $this->bonus = $bonus;
    }

    /**
     * @return Gem[]
     */
    public function getGems()
    {

        return array_values($this->gems);
    }

    /**
     * @return bool
     */
    public function isSocketBonusActive()
    {
        foreach ($this->slotColors as $key => $slotColor) {
            if(!isset( $this->gems[$key])) {
                continue;
            }
            $c = $this->gems[$key]->getColor();
            switch ($slotColor) {
                case Gem::RED:
                    if ($c  != Gem::RED && $c  != Gem::ORANGE && $c  != Gem::VIOLET) {
                        return false;
                    }
                    break;
                case Gem::YELLOW:
                    if ($c  != Gem::YELLOW && $c  != Gem::ORANGE && $c  != Gem::GREEN) {
                        return false;
                    }
                    break;
                case Gem::BLUE: // socket is blue
                    if ($c  !== Gem::BLUE && $c  != Gem::GREEN && $c  != Gem::VIOLET){
                        return false;
                    }
                    break;
            }
        }
        return true;
    }

    /**
     * @return Stat
     */
    public function getSocketBonus()
    {
        return $this->bonus;
    }

    /**
     * @return StatCollection
     */
    public function getStats()
    {
        $result = new StatCollection();
        foreach ($this->gems as $gem) {
            $result->merge($gem->getStats());
        }
        if ($this->isSocketBonusActive()) {
            $result->add($this->getSocketBonus());
        }
        return $result;
    }
}
