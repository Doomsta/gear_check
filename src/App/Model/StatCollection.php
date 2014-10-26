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
            $this->add($stat);
        }
    }

    public function getStats()
    {
        return $this->stats;
    }

    public function toArray()
    {
        $result = array();
        foreach ($this->stats as $stat) {
            $result[$stat->getType()] = $stat->toArray();
        }
        return $result;
    }
}
