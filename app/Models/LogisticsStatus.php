<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogisticsStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'message'
    ];

    // 定義反向關聯
    public function orders()
    {
        return $this->hasMany(Order::class, 'logistics_status', 'code');
    }
}
