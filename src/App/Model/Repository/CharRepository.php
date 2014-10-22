<?php

namespace App\Model\Repository;


use App\Model\Entity\Char;
use Doomsta\CastleApi\CastleApi;

class CharRepository
{
    public function __construct()
    {
        $this->castleArmory = new CastleApi();
        $this->itemRepository = new ItemRepository();
    }

    public function getChar($name)
    {
        $armoryChar = $this->castleArmory->getCharFromArmory($name);
        $char = new Char($name);
        $char->load();
        $char->setPrefix($armoryChar->getPrefix());
        $char->setSuffix($armoryChar->getSuffix());
        $char->setClassId($armoryChar->getClassId());
        $char->setRaceId($armoryChar->getRaceId());
        $char->setGenderId($armoryChar->getGender());
        $char->setGuildName($armoryChar->getGuildName());
        $char->setLevel($armoryChar->getLevel());
        $char->setAchievementPoints($armoryChar->getAvPoints());
        return $char;
    }
} 