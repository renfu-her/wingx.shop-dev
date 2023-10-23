<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'category_id',
        'name',
        'price',
        'price_max',
        'price_min',
        'description',
        'image',
        'status',
        'is_free_ship',
        'store_number'
    ];
}
