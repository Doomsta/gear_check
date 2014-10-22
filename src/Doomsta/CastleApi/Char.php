<?php

namespace Doomsta\CastleApi;

use SimpleXMLElement;

class Char
{
    /** @var SimpleXMLElement */
    private $xml;

    /**
     * @param SimpleXMLElement $xml
     */
    public function __construct(SimpleXMLElement $xml)
    {
        $this->xml = $xml;
        #TODO THRO EXCEPTION on invalid stuff
    }

    public function getName()
    {
        return (string)$this->xml->characterInfo->character['name'];
    }

    public function getPrefix()
    {
        return (string)$this->xml->characterInfo->character['prefix'];
    }

    public function getSuffix()
    {
        return (string)$this->xml->characterInfo->character['suffix'];
    }

    public function getGuildName()
    {
        return (string)$this->xml->characterInfo->character['guildName'];
    }

    public function getLevel()
    {
        return (int)$this->xml->characterInfo->character['level'];
    }

    public function getClassId()
    {
        return (int)$this->xml->characterInfo->character['classId'];
    }

    public function getClass()
    {
        return (string)$this->xml->characterInfo->character['class'];
    }

    public function getRaceId()
    {
        return (int)$this->xml->characterInfo->character['raceId'];
    }

    public function getRace()
    {
        return (string)$this->xml->characterInfo->character['race'];
    }

    public function getAvPoints()
    {
        return (int)$this->xml->characterInfo->character['points'];
    }

    public function getGender()
    {
        return (int)$this->xml->characterInfo->character['genderId'];
    }

    /**
     * @return Item[]
     */
    public function getItems()
    {
        $items = array();
        foreach ($this->xml->characterInfo->characterTab->items->item as $item) {
            $items[((int)$item['slot'])+1] = new Item($item);
        }
        return $items;
    }

}