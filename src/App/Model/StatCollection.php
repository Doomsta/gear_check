<?php

namespace App\Model;

use App\Model\Entity\Stat;

class StatCollection
{
    /** @var Stat[]  */
    private $stats;

    public function __construct()
    {
        $this->stats = array();
    }

    public function add(Stat $stat)
    {
        $type = $stat->getType();
        if (!isset($this->stats[$type])) {
            $this->stats[$type] = $stat;
        } else {
            $this->stats[$type]->merge($stat);
        }
    }

    public function merge(StatCollection $statCollection)
    {
        foreach ($statCollection->getStats() as $stat) {
            $this->add(clone $stat);
        }
    }

    /**
     * @return Stat[]
     */
    public function getStats()
    {
        return array_values($this->stats);
    }

    public function getPrimStats()
    {
        $tmp = array();
        foreach($this->getStats() as $stat) {
            if($stat->getType() > 0 && $stat->getType() < 8) {
                $tmp[$stat->getType()] = $stat;
            }
        }
        return $tmp;
    }

    public function getSekStats()
    {
        $tmp = array();
        foreach($this->getStats() as $stat) {
            if($stat->getType() < 0 || $stat->getType() > 8) {
                $tmp[$stat->getType()] = $stat;
            }
        }
        return $tmp;
    }

    public function toArray()
    {
        $result = array();
        foreach ($this->stats as $stat) {
            $result[$stat->getType()] = $stat->toArray();
        }
        return $result;
    }

    public function getStat($id)
    {
        if(isset($this->stats[$id])) {
            return $this->stats[$id];
        }
        return new Stat($id, 0);
    }
}
