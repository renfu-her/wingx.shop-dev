<?php

namespace App\Services;

use App\Models\Ship;

/**
 * Class BaseService
 * @package App\Services
 */
class BaseService
{

    // get ship all
    public function getShipAll()
    {
        $ships = Ship::all();
        return $ships;
    }
    
}
