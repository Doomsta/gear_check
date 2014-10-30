<?php

namespace App\Model\Repository;

use App\Model\Entity\Item;
use App\Model\Entity\ItemSet;
use App\Model\Entity\Stat;
use App\Model\Entity\Weapon;
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

        if($data['class'] == 2) {
            $item = new Weapon($id);
            $item->setMinDmg($data['dmg_min1']);
            $item->setMaxDmg($data['dmg_max1']);
            $item->setDelay($data['delay']);
        } else {
            $item = new Item($id);
        }
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
        $item->setSet($this->getItemSet($data['itemset']));
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

    protected function getItemSet($id)
    {
        $set = new ItemSet($id);
        if($id == 0) {
            return $set;
        }
        $queryBuilder = $this->conn->createQueryBuilder();
        $queryBuilder
            ->select('itemSet.*')
            ->from('itemset_info', 'itemSet')
            ->where($queryBuilder->expr()->eq('itemSet.id', ':id'));
        $queryBuilder->setParameters(array(':id' => $id));
        ($queryBuilder->getSQL());
        $statement = $queryBuilder->execute();
        $data = $statement->fetch();
        $set->setName($data['name_en_gb']);

        $queryBuilder = $this->conn->createQueryBuilder();
        $queryBuilder
            ->select('item.entry')
            ->from('item_template', 'item')
            ->where($queryBuilder->expr()->eq('item.itemset', ':id'));
        $queryBuilder->setParameters(array(':id' => $id));
        $statement = $queryBuilder->execute();
        foreach($statement->fetchAll() as $row) {
            $set->addItem($row['entry']);
        }




        return $set;

    }
} 