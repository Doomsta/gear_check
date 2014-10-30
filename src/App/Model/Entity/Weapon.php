<?php

namespace App\Model\Entity;


class Weapon extends Item
{
    private $minDmg = 0;
    private $maxDmg = 0;
    private $delay = 0;

    /**
     * @return int
     */
    public function getMinDmg()
    {
        return $this->minDmg;
    }

    /**
     * @param int $minDmg
     */
    public function setMinDmg($minDmg)
    {
        $this->minDmg = $minDmg;
    }

    /**
     * @return int
     */
    public function getMaxDmg()
    {
        return $this->maxDmg;
    }

    /**
     * @param int $maxDmg
     */
    public function setMaxDmg($maxDmg)
    {
        $this->maxDmg = $maxDmg;
    }

    /**
     * @return int
     */
    public function getDelay()
    {
        return $this->delay;
    }

    /**
     * @param int $delay
     */
    public function setDelay($delay)
    {
        $this->delay = $delay;
    }

    public function getDps()
    {
        return number_format(round(((($this->getMinDmg() + $this->getMaxDmg()) / 2) / ($this->getDelay() / 1000)), 1), 1);
    }
} 