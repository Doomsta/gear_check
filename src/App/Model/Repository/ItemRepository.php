<?php

namespace App\Model\Repository;

use App\Model\Entity\Item;
use Doctrine\DBAL\Connection;

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
        return $item;
    }
} 