<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable=[
        'order_id',
        'product_id',
        'name',
        'price',
        'qty',
        'sub_total',
        'data_base',
        'items'
    ];
}
