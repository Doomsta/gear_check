<?php

namespace App\Model;

use App\Model\Entity\Gem;
use Exception;

class GemCollection
{
    /**
     * @var Gem[]
     */
    private $gems = array();
    private $slotColors = array();

    public function __construct()
    {

    }

    public function addGemSlot($color)
    {
        $this->slotColors[] = $color;
    }

    public function addGem(Gem $gem)
    {
        if (count($this->gems) < count($this->slotColors)) {
            return false;
        }
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

    public function setBonus($id)
    {
        //TODO
    }

    public function getGems() {
        return array_values($this->gems);
    }

    public function getStats($bonus = true) //TODO
    {
        $result = new StatCollection();
        foreach ($this->gems as $gem) {
            $result->merge($gem->getStats());
        }
        return $result;
    }
} 