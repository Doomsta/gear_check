<?php

namespace App\Model\Repository;

use App\Model\Entity\Gem;

class GemRepository
{
    public function __construct()
    {

    }

    public function getById($id)
    {
        return new Gem();
    }
} 