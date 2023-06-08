<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMix extends Model
{
    use HasFactory;

    protected $table = 'product_mixes';

    protected $fillable = [
        'product_id',
        'product_mix1',
        'product_mix2',
        'price',
        'quantity',
        'description',
        'status',
    ];
}
