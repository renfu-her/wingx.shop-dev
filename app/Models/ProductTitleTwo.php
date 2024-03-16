<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTitleTwo extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'title_one_id',
        'name'
    ];
}
