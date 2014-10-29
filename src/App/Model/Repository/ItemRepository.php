<?php

namespace App\Model\Repository;

use App\Model\Entity\Item;
use App\Model\Entity\Stat;
use App\Model\StatCollection;
use Doctrine\DBAL\Connection;
use Symfony\Component\Config\Definition\Exception\Exception;

class ItemRepository
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    private $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn;
    }

    /**
     * @param $id
     * @return Item
     */
    public function getById($id)
    {
        $queryBuilder = $this->conn->createQueryBuilder();
        $queryBuilder
            ->select('i.*')
            ->from('item_template', 'i')
            ->where($queryBuilder->expr()->eq('i.entry', ':entry'));
        $queryBuilder->setParameters(array(':entry' => $id));
        $statement = $queryBuilder->execute();
        $data = $statement->fetch();

        $item = new Item($id);
        $item->setClass($data['class']);
        $item->setLevel($data['ItemLevel']);
        $item->setName($data['name']);
        $item->setRarity($data['Quality']);
        $item->setFlags($data['Flags']);
        $item->setRequiredLevel($data['RequiredLevel']);
        $item->setDescription($data['description']);
        $item->setArmorDamageModifier($data['ArmorDamageModifier']);
        for($i = 1; $i < 11; $i++) {
            if($data['stat_type'.$i] === 0) {
                continue;
            }
            $item->addStat(new Stat($data['stat_type'.$i], $data['stat_value'.$i]));
        }
        $item->addStat(new Stat(Stat::ARMOR, $data['armor']));
        for($i = 1; $i < 4; $i++) {
            if($data['socketColor_'.$i] === 0) {
                continue;
            }
            $item->getGemCollection()->addGemSlot($data['socketColor_'.$i]);
        }

        $item->getGemCollection()->addSocketBonus($this->getSocketBonus($data['socketBonus']));
        return $item;
    }

    protected function getSocketBonus($id)
    {
        $queryBuilder = $this->conn->createQueryBuilder();
        $queryBuilder
            ->select('i.*')
            ->from('socket_bonus', 'i')
            ->where($queryBuilder->expr()->eq('i.id', ':id'));
        $queryBuilder->setParameters(array(':id' => $id));
        $statement = $queryBuilder->execute();
        $data = $statement->fetch();
        return new Stat($data['stat_type1'], $data['stat_value1']);
    }
} 