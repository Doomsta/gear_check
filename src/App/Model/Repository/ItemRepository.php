<?php

namespace App\Model\Repository;

use App\Model\Entity\Item;

class ItemRepository
{
    public function __construct()
    {

    }

    public function getById()
    {
        return new Item();
    }
} 