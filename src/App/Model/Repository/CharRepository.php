<?php

namespace App\Model\Repository;


use App\Model\Entity\Char;
use App\Model\Entity\Stat;
use App\Model\StatCollection;
use Doctrine\DBAL\Connection;
use Doomsta\CastleApi\CastleApi;

class CharRepository
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    private $conn;

    public function __construct(Connection $conn)
    {
        $this->castleArmory = new CastleApi();
        $this->itemRepository = new ItemRepository($conn);
        $this->gemRepository = new GemRepository($conn);
        $this->enchantRepository = new EnchantRepository($conn);

        $this->conn = $conn;
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
            if($id = $armoryItem->getEnchantSpellId()) {
                $item->addEnchant($this->enchantRepository->getSpellEnchant($id));
            }
            if($id =  $armoryItem->getEnchantItemId()) {
                $item->addEnchant($this->enchantRepository->getItemEnchant($id));
            }
            foreach($armoryItem->getGemIds() as $gemId) {
                $item->getGemCollection()->addGem($this->gemRepository->getById($gemId));
            }
            $char->addItem($slot, $item);
        }

        $queryBuilder = $this->conn->createQueryBuilder();
        $queryBuilder
            ->select('s.*')
            ->from('player_levelstats', 's')
            ->where($queryBuilder->expr()->eq('s.class', ':class'))
            ->andWhere($queryBuilder->expr()->eq('s.level', ':level'));
        $queryBuilder->setParameters(array(':class' => $char->getClassId(), ':level' => $char->getLevel()));
        $row = $queryBuilder->execute()->fetch();
        $stats = new StatCollection();
        $stats->add(new Stat(Stat::STRENGTH, $row['str']));
        $stats->add(new Stat(Stat::AGILITY, $row['agi']));
        $stats->add(new Stat(Stat::STAMINA, $row['sta']));
        $stats->add(new Stat(Stat::INTELLECT, $row['inte']));
        $stats->add(new Stat(Stat::SPIRIT, $row['spi']));
        $char->setClassLevelStats($stats);
        return $stats;



        return $char;
    }
} 