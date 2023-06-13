<?php

namespace App\Services;

use App\Services\BaseService;

use App\Models\Order;
use App\Models\OrderDetail;

/**
 * Class OrderService
 * @package App\Services
 */
class OrderService extends BaseService
{

    // 訂單列表
    public function orderListByMember($memberId){

        $orders = Order::where('member_id', $memberId)->get();

        return $orders;

    }
}
