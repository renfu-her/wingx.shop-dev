<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use HasFactory, Notifiable;

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

    protected $hidden = [
        'password',
    ];
}
