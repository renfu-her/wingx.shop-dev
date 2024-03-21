<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductShip extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'ship_id',
        'price',
        'status'
    ];

    public function ship()
    {
        return $this->belongsTo(Ship::class, 'ship_id');
    }
}
