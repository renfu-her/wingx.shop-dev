<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CvsStoreDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'store_name',
        'telephone',
        'address',
    ];
}
