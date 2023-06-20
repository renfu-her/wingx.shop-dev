@extends('frontend.layouts.master')

@section('content')
    <section class="mt-5 container ">
        <section class="replica" id="replica">
            <div class="container">
                <div class="row gy-5">
                    <div class="col-12 text-center">
                        <button class="btn btn-primary" onclick="location.href='/order/list'">訂單列表</button>
                        <button class="btn btn-primary" onclick="location.href='/profile'">個人資料</button>

                    </div>
                    <div class="col-md-12">
                        <div class="text-center">
                            <h5>訂單列表</h5>
                        </div>
                        @foreach ($orders as $key => $value)
                            <div class="container container-2 hr-line">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <span style="font-weight: 600">訂單編號：{{ $value->order_no }}</span>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <span style="font-weight: 600">電子發票：{{ $value->invoice_no ?? '尚未付款' }}</span>
                                        </div>
                                    </div>
                                    @if($value->company_name)
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
                                            <span>付款方式：{{ $value->payment_name }}</span>
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
                                            @if ($value->status == 0 || $value->status == 9)
                                                <span class="text-icon" style="color: green">待付款</span>
                                            @elseif($value->status == 1)
                                                <span class="text-icon" style="color: blue">完成付款</span>
                                            @elseif($value->status == 2)
                                                <span class="text-icon" style="color: red">付款失敗</span>
                                            @elseif($value->status == 3)
                                                <span class="text-icon" style="color: #aaa">取消訂單</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12" style="font-weight: 600">
                                    運送地址：{{ $value->zipcode }} {{ $value->county }}{{ $value->district }}{{ $value->address }}
                                </div>

                                @foreach ($value['order_detail'] as $dkey => $drow)
                                    <div class="row" style="align-items: center; justify-content: center;">
                                        <div class="col-6 col-md-3">
                                            <img src="{{ $drow->image_url }}" style="height: 150px" loading="lazy">
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <span>{{ $drow->name }}</span>
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
