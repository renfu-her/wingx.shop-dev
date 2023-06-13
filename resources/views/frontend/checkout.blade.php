@extends('frontend.layouts.master')

@section('content')
    <section class="mt-5 container ">
        <!-- Page Content Goes Here -->

        <h1 class="mb-4 display-5 fw-bold text-center">結帳</h1>
        <p class="text-center mx-auto">請填寫以下資訊
        </p>

        <div class="row g-md-8 mt-4">
            <!-- Checkout Panel Left -->
            <div class="col-12 col-lg-6 col-xl-7">
                <!-- Checkout Panel Contact -->
                <div class="checkout-panel">
                    <h5 class="title-checkout">選擇送貨方式</h5>
                    <div class="row">

                        <!-- Email-->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email" class="form-label">送貨方式</label>
                                <select name="" id="" class="form-select">
                                    <option value="1">中華郵政</option>
                                    <option value="2">宅配</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="checkout-panel">
                    <h5 class="title-checkout">填寫個人資訊</h5>
                    <div class="row">

                        <!-- Email-->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="{{ Session::get('member_email') }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- First Name-->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="firstName" class="form-label">你的姓名</label>
                                <input type="text" class="form-control" id="name" placeholder="" value="" >
                            </div>
                        </div>

                        <!-- Address-->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="address" class="form-label">地址</label>
                                <input type="text" class="form-control" id="address">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Checkout Panel Left -->

            <!-- Checkout Panel Summary -->
            <div class="col-12 col-lg-6 col-xl-5">
                <div class="bg-light p-4 sticky-md-top top-5">
                    <div class="border-bottom pb-3">
                        <!-- Cart Item-->
                        @foreach($cart as $key => $value)
                        <div class="d-none d-md-flex justify-content-between align-items-start py-2">
                            <div class="d-flex flex-grow-1 justify-content-start align-items-start">
                                <div class="position-relative f-w-20 border p-2 me-4">
                                    <span class="checkout-item-qty">{{ $value['qty'] }}</span>
                                    <img src="{{ $value['prod_image'] }}" alt=""
                                        class="rounded img-fluid">
                                </div>
                                <div>
                                    <p class="mb-1 fs-6 fw-bolder">{{ $value['prod_name'] }}</p>
                                </div>
                            </div>
                            <div class="flex-shrink-0 fw-bolder">
                                <span>$ {{ $value['prod_price'] }}</span>
                            </div>
                        </div>
                        @endforeach

                        <!-- / Cart Item-->
                    </div>
                    <div class="py-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <p class="m-0 fw-bolder fs-6">Subtotal</p>
                            <p class="m-0 fs-6 fw-bolder">$422.99</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center ">
                            <p class="m-0 fw-bolder fs-6">Shipping</p>
                            <p class="m-0 fs-6 fw-bolder">$8.95</p>
                        </div>
                    </div>
                    <div class="py-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="m-0 fw-bold fs-5">Grand Total</p>
                                <span class="text-muted small">Inc $45.89 sales tax</span>
                            </div>
                            <p class="m-0 fs-5 fw-bold">$422.99</p>
                        </div>
                    </div>
                    <div class="py-3 border-bottom">
                        <div class="input-group mb-0">
                            <input type="text" class="form-control" placeholder="Enter your coupon code">
                            <button class="btn btn-dark btn-sm px-4">Apply</button>
                        </div>
                    </div>
                    <!-- Accept Terms Checkbox-->
                    <div class="form-group form-check my-4">
                        <input type="checkbox" class="form-check-input" id="accept-terms" checked>
                        <label class="form-check-label fw-bolder" for="accept-terms">I agree to Alpine's <a
                                href="#">terms & conditions</a></label>
                    </div>
                    <a href="#" class="btn btn-dark w-100" role="button">Complete Order</a>
                </div>
            </div>
            <!-- /Checkout Panel Summary -->
        </div>

        <!-- /Page Content -->
    </section>
@endsection

@section('css')
@endsection

@section('js')
@endsection
