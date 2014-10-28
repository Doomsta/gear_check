<?php

namespace App\Model\Repository;


use App\Model\Entity\Enchant;
use App\Model\Entity\Stat;
use Doctrine\DBAL\Connection;

class EnchantRepository
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
     * @return Enchant
     */
    public function getItemEnchant($id)
    {
        $queryBuilder = $this->conn->createQueryBuilder();
        $queryBuilder
            ->select('e.*')
            ->from('enchant', 'e')
            ->where($queryBuilder->expr()->eq('e.item', ':id'));
        $queryBuilder->setParameters(array(':id' => $id));
        $statement = $queryBuilder->execute();
        $data = $statement->fetch();

        $enchant = new Enchant($id, $data['label']);
        for($i = 1; $i < 6; $i++) {
            $enchant->addStat(new Stat($data['stat'.$i.'_type'], $data['stat'.$i.'_value']));
        }
        return $enchant;
    }

    /**
     * @param $id
     * @return Enchant
     */
    public function getSpellEnchant($id)
    {
        $queryBuilder = $this->conn->createQueryBuilder();
        $queryBuilder
            ->select('e.*')
            ->from('enchant', 'e')
            ->where($queryBuilder->expr()->eq('e.spell', ':id'));
        $queryBuilder->setParameters(array(':id' => $id));
        $statement = $queryBuilder->execute();
        $data = $statement->fetch();

        $enchant = new Enchant($id, $data['label']);
        for($i = 1; $i < 6; $i++) {
            $enchant->addStat(new Stat($data['stat'.$i.'_type'], $data['stat'.$i.'_value']));
        }
        return $enchant;
    }
} 