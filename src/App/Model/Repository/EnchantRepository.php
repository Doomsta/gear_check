<?php

namespace App\Model\Repository;


use App\Model\Entity\Enchant;
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
        return new Enchant();
    }

    /**
     * @return Enchant
     */
    public function getSpellEnchant()
    {
        return new Enchant();
    }
} 