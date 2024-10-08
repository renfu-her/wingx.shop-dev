<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
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
        'logistics_status',
        'carrier_type',
        'carrier_num',
    ];

    // 自定義關聯方法
    public function logisticsStatus(): BelongsTo
    {
        return $this->belongsTo(LogisticsStatus::class, 'logistics_status', 'code');
    }

    // 添加一個屬性來獲取 logistics_status 的 message
    public function getLogisticsMessageAttribute(): ?string
    {
        return $this->logisticsStatus ? $this->logisticsStatus->message : null;
    }
}
