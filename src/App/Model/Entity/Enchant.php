<?php

namespace App\Model\Entity;

use App\Model\StatCollection;

class Enchant
{
    /** @var  StatCollection */
    private $statCollection;
    /** @var int */
    private $id;
    /** @var string */
    private $label;

    public function __construct($id, $label)
    {
        $this->id = $id;
        $this->label = $label;
        $this->statCollection = new StatCollection();
    }

    /**
     * @param $stat
     */
    public function addStat($stat)
    {
        $this->statCollection->add($stat);
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
    public function getLabel()
    {
        return $this->label;
    }

    public function getStatCollection()
    {
        return $this->statCollection;
    }

} 