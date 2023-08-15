<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceLottery extends Model
{
    use HasFactory;

    protected $table = 'invoice_lotteries';

    protected $fillable = [
        'year',
        'month',
        'special_bonus',
        'special_award',
        'jackpot'
    ];
}
