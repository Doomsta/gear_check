<?php

namespace App\Model\Repository;

use App\Model\Entity\Gem;
use App\Model\Entity\Stat;
use Doctrine\DBAL\Connection;

class GemRepository
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    private $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn;
    }

    public function getById($id)
    {
        $queryBuilder = $this->conn->createQueryBuilder();
        $queryBuilder
            ->select('gem.*')
            ->from('socket_stats', 'gem')
            ->where($queryBuilder->expr()->eq('gem.id', ':id'));
        $queryBuilder->setParameters(array(':id' => $id));
        $statement = $queryBuilder->execute();
        $data = $statement->fetch();
        $stats = array();
        for($i = 1; $i <= 2; $i++) {
            if( $data['stat_type'.$i] !== 0 ) {
                $stats[] = new Stat($data['stat_type'.$i], $data['stat_value'.$i]);
            } else {
                continue;
            }
        }
        $gem = new Gem($id, $data['color'], $stats, $data['rarity']);
        #$gem->s
        return $gem;
    }
} 