<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderShip extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'ship_id',
        'price',
        'status'
    ];
}
