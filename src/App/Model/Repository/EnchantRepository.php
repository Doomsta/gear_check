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
     * @return Enchant
     */
    public function getItemEnchant()
    {
        #return new Enchant();
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
            ->from('e', 'enchant')
            ->where($queryBuilder->expr()->eq('e.id', ':id'));
        $queryBuilder->setParameters(array(':id' => $id));
        $statement = $queryBuilder->execute();
        $data = $statement->fetch();

        $enchant = new Enchant($id, $data['label']);
        for($i = 1; $i < 6; $i++) {
            $enchant->addStat(new Stat($data['stat'.$i.'type'], $data['stat'.$i.'value']));
        }
        return $enchant;
    }
} 