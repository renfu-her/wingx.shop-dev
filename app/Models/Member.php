<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nick_name',
        'email',
        'password',
        'email_verify',
        'mobile',
        'status',
        'county',
        'district',
        'zipcode',
        'address',
        'line_id',
        'facebook_id',
    ];
}
