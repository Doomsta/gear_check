<?php

namespace Doomsta\CastleApi;


use SimpleXMLElement;

class Item
{
    /**
     * @var \SimpleXMLElement
     */
    private $xml;

    public function __construct(SimpleXMLElement $xml)
    {
        $this->xml = $xml;
    }

    public function getId()
    {
        return (int)$this->xml['id'];
    }

    public function getName()
    {
        return (string)$this->xml['name'];
    }

    public function getLevel()
    {
        return (int)$this->xml['level'];
    }
} 