<?php

namespace App\Model\Repository;


use App\Model\Entity\Char;
use Doctrine\DBAL\Connection;
use Doomsta\CastleApi\CastleApi;

class CharRepository
{
    public function __construct(Connection $conn)
    {
        $this->castleArmory = new CastleApi();
        $this->itemRepository = new ItemRepository($conn);
        $this->gemRepository = new GemRepository($conn);
        $this->enchantRepository = new EnchantRepository($conn);

    }

    public function getChar($name)
    {
        $armoryChar = $this->castleArmory->getCharFromArmory($name);
        $char = new Char($name);
        $char->setPrefix($armoryChar->getPrefix());
        $char->setSuffix($armoryChar->getSuffix());
        $char->setClassId($armoryChar->getClassId());
        $char->setRaceId($armoryChar->getRaceId());
        $char->setGenderId($armoryChar->getGender());
        $char->setGuildName($armoryChar->getGuildName());
        $char->setLevel($armoryChar->getLevel());
        $char->setAchievementPoints($armoryChar->getAvPoints());
        foreach($armoryChar->getProfessions() as $profession) {
            $char->addProfession($profession->getId(), $profession->getLevel());
        }
        foreach($armoryChar->getItems() as $slot => $armoryItem) {
            $item = $this->itemRepository->getById($armoryItem->getId());
            foreach($armoryItem->getGemIds() as $gemId) {
                $item->getGemCollection()->addGem($this->gemRepository->getById($gemId));
            }
            $char->addItem($slot, $item);
        }
        return $char;
    }
} 