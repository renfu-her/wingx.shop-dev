<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable=[
        'order_no',
        'member_id',
        'coupon_id',
        'ship_id',
        'payment',
        'name',
        'mobile',
        'email',
        'address',
        'discount',
        'total',
        'remark',
        'invoice',
        'invoice_title',
        'invoice_tax_id',
        'ship_no',
        'ship_remark',
        'ship_status',
        'ship_date',
        'ship_price',
        'ship_discount',
        'status',
        'county',
        'district',
        'zipcode',
        'accept_terms',
        'username',
        'type',
        'company_name',
        'company_uid',
        'company_address',
        'amount',
        'tax',
        'manual_status',
        'cvs_store_id',
        'logistics_status'
    ];
}
