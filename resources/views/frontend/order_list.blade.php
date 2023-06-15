@extends('frontend.layouts.master')

@section('content')
    <section class="mt-5 container ">
        <section class="replica" id="replica">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h5>訂單列表</h5>
                        </div>
                        @foreach ($orders as $key => $row)
                            <div class="container container-2">
                                <header class="d-flex justify-content-between align-items-center">
                                    <div class="row">
                                        <div class="col-6 col-md-12 text">
                                            <span>訂單編號：{{ $row->order_no }}</span>
                                        </div>
                                        <div class="col-10">
                                            <div class="col-6 col-md-12 text">
                                                <span>訂單成立：{{ $row->created_at }}</span>
                                                <span>付款方式：{{ $row->payment_name }}</span>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="col-6 col-md-12 text">
                                                <span
                                                    style="margin-right: @if (trim($row->pay_time) == '') 205px @else 60px @endif">付款時間：{{ $row->pay_time }}</span>
                                                <span>
                                                    金額：NT ${{ $row->total }} <br>
                                                    運費：NT ${{ $row->ship_price }} <br>
                                                    實付金額：NT ${{ $row->ttl_price }}
                                                    @if ($row->status == 0 || $row->status == 9)
                                                        <span class="text-icon">待付款</span>
                                                    @elseif($row->status == 1)
                                                        <span class="text-icon">
                                                            <i class="bx bx-checkbox-checked"></i>完成付款</span>
                                                    @elseif($row->status == 2)
                                                        <span class="text-icon">付款失敗</span>
                                                    @elseif($row->status == 3)
                                                        <span class="text-icon">取消訂單</span>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="check col-2 col-md-2">
                                        @if ($row->status == 0 || $row->status == 9)
                                            <span class="text-icon">待付款</span>
                                        @elseif($row->status == 1)
                                            <i class='bx bx-checkbox-checked'></i><span>完成付款</span>
                                        @elseif($row->status == 2)
                                            <span class="text-icon">付款失敗</span>
                                        @elseif($row->status == 3)
                                            <span class="text-icon">取消訂單</span>
                                        @endif
                                    </div>
                                </header>

                                @foreach ($row['order_detail'] as $dkey => $drow)
                                    <div class="nt">
                                        <div class="image d-flex align-items-center justify-content-between">
                                            <img src="{{ $drow->image_url }}" loading="lazy">
                                            <span>{{ $drow->title }}</span>
                                        </div>
                                        <div class="num">數量: {{ $drow->qty }}</div>
                                        <div class="num">NT ${{ $drow->price }}</div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="hr-line"></div>
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
            border-bottom: 1px solid #e0e0e0;
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
