@extends('frontend.layouts.master')

@section('content')
    <!-- Category Top Banner -->
    <div class="py-6 bg-img-cover bg-dark bg-overlay-gradient-dark position-relative overflow-hidden mb-4 bg-pos-center-center"
        style="background-image: url(./assets/images/banners/banner-1.jpg);">
        <div class="container position-relative z-index-20" data-aos="fade-right" data-aos-delay="300">
            <div class="col-12 col-md-6">
                <p class="lead text-white mb-0">

                </p>
            </div>
        </div>
    </div>
    <section class="mt-5 ">
        <section class="replica" id="replica">
            <div class="container-fluid">
                <div class="row gy-5">
                    <div class="col-12 text-center">
                        <button class="btn btn-primary" onclick="location.href='/order/list'">訂單列表</button>
                        <button class="btn btn-primary" onclick="location.href='/profile'">個人資料</button>

                    </div>
                    <div class="col-md-12">
                        <div class="text-center">
                            <h4>訂單列表</h4>
                            <h6 style="color: red">如果使用信用卡結帳，請確認狀態是否“完成付款“狀態，謝謝！</h6>
                        </div>
                        @foreach ($orders as $key => $value)
                            <div class="container container-2 hr-line">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <span style="font-weight: 600">訂單編號：{{ $value->order_no }}</span>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <span style="font-weight: 600">電子發票：{{ $value->invoice_no ?? '尚未開立' }}</span>
                                        </div>
                                    </div>
                                    @if ($value->company_name)
                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <span>公司抬頭：{{ $value->company_name }}</span>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <span>統一編號：{{ $value->company_uid }}</span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <span>公司地址：{{ $value->company_address }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <span>訂單成立：{{ $value->created_at }}</span>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            @if (!empty($value->cvs_store_id))
                                                <span>付款方式：貨到付款 <a
                                                        href="{{ route('order.data.status', $value->pay_logistics_id) }}"
                                                        target="_blink">貨態查詢</a>
                                                </span>
                                                <span>
                                                    @if (!empty($value->cvs_store_id))
                                                        @if ($value->logistics_status == 300)
                                                            <a href="{{ route('order.cancelOrder', $value->pay_logistics_id) }}"
                                                                target="_blink">取消貨品</a>
                                                        @endif
                                                    @endif
                                                </span>
                                            @else
                                                <span>付款方式：{{ $value->payment_name }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-md-3" style="font-weight: 600">
                                            運費：NT ${{ $value->ship_price }} <br>
                                        </div>
                                        <div class="col-12 col-md-3" style="font-weight: 600">
                                            金額：NT ${{ $value->total }} <br>

                                        </div>
                                        <div class="col-12 col-md-3" style="font-weight: 600">
                                            實付金額：NT ${{ $value->ttl_price }} <br>

                                        </div>
                                        <div class="col-12 col-md-3" style="font-weight: 600">
                                            @if (!empty($value->cvs_store_id))
                                                @if ($value->logistics_status == 0)
                                                    <span class="text-icon" style="color: gray">尚未收到物流資料</span>
                                                @elseif($value->logistics_status == 300)
                                                    <span class="text-icon" style="color: darkgreen">訂單處理中(已收到訂單資料)</span>
                                                @elseif ($value->logistics_status == 2030 || $value->logistics_status == 3024)
                                                    <span class="text-icon" style="color: darkgreen">商品已送至物流中心</span>
                                                @elseif($value->logistics_status == 2063 || $value->logistics_status == 2073 || $value->logistics_status == 3018)
                                                    <span class="text-icon" style="color: green">商品已送達門市</span>
                                                @elseif($value->logistics_status == 2067 || $value->logistics_status == 3022)
                                                    <span class="text-icon" style="color: blue">消費者成功取件</span>
                                                @elseif($value->logistics_status == 2074 || $value->logistics_status == 3020)
                                                    <span class="text-icon" style="color: red">消費者七天未取件</span>
                                                @else
                                                    <span class="text-icon"
                                                        style="color: red">{{ $value->logistics_message }}</span>
                                                @endif
                                                @if ($value->status == 3)
                                                    <span class="text-icon" style="color: #aaa">取消訂單</span>
                                                @endif
                                            @else
                                                @if ($value->status == 0 || $value->status == 9)
                                                    <span class="text-icon" style="color: darkgreen">待付款</span>
                                                @elseif($value->status == 1)
                                                    <span class="text-icon" style="color: blue">完成付款</span>
                                                @elseif($value->status == 2)
                                                    <span class="text-icon" style="color: red">付款失敗</span>
                                                @elseif($value->status == 3)
                                                    <span class="text-icon" style="color: #aaa">取消訂單</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12" style="font-weight: 600">
                                    運送地址：{{ $value->zipcode }}
                                    {{ $value->county }}{{ $value->district }}{{ $value->address }}
                                </div>

                                @foreach ($value['order_detail'] as $dkey => $drow)
                                    <div class="row" style="align-items: center; justify-content: center;">
                                        <div class="col-6 col-md-3">
                                            <img src="{{ $drow->image_url }}" style="width: 120px" loading="lazy">
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <span>{{ $drow->name }}</span>
                                            @if (!empty($drow->items))
                                                <br>
                                                <span>{!! $drow->items !!}</span>
                                            @endif
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <span>數量：{{ $drow->qty }}</span>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <span>單價：NT ${{ $drow->price }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection

@section('css')
    <style>
        .hr-line {
            border-bottom: 2px double #e0e0e0;
            /* border-style: double; */
        }

        .container-2 {
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .nt {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .nt .image img {
            width: 120px;
            margin-right: 23px;
            font-size: 15px;
            color: #7f808a;
        }


        .container header {
            border-bottom: 1px dotted #bdbdbd;
        }

        .container header,
        .container .nt {
            padding: 20px 20px 15px 20px !important;
        }

        .container .text span {
            font-size: 15px;
            color: #7f808a;
            display: inline-block !important;
        }

        @media (max-width: 770px) {
            .container .text span {
                display: block !important;
            }
        }
    </style>
@endsection

@section('js')
@endsection
