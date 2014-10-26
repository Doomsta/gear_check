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

    public function getGemIds()
    {
        $result = array();
        for($i = 0;; $i++) {
            if(isset(  $this->xml['gem'.$i.'Id'])) {
                $result[] = (int) $this->xml['gem'.$i.'Id'];
            } else {
                break;
            }
        }
        return $result;
    }
} 