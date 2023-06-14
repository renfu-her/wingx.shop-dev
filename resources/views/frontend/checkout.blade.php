@extends('frontend.layouts.master')

@section('content')
    <section class="mt-5 container ">
        <!-- Page Content Goes Here -->

        <h1 class="mb-4 display-5 fw-bold text-center">結帳</h1>
        <p class="text-center mx-auto">請填寫以下資訊
        </p>

        <form action="/cart" method="post" id="form_post">
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
                                    <select name="ship_id" id="ship_id" class="form-select">
                                        <option value="">請選擇</option>
                                        @foreach ($ships as $ship)
                                            <option value="{{ $ship->id }}">{{ $ship->name }}</option>
                                        @endforeach
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
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ Session::get('member_email') }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-12">
                            <div class="form-group">
                                <label for="firstName" class="form-label">你的姓名</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{ $member->name }}">
                            </div>
                        </div>

                        <div class="city-selector-set">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <!-- 縣市選單 -->
                                        <select class="county form-select"></select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <!-- 區域選單 -->
                                        <select class="district form-select"></select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input class="zipcode form-select" type="text" size="3" readonly
                                            placeholder="郵遞區號">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="address" class="form-label">地址</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="address" class="form-label">備註</label>
                                <textarea  class="form-control" rows="5" id="remark" name="remark"></textarea>
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
                            @foreach ($cart as $key => $value)
                                <div class="d-none d-md-flex justify-content-between align-items-start py-2">
                                    <div class="d-flex flex-grow-1 justify-content-start align-items-start">
                                        <div class="position-relative f-w-20 border p-2 me-4">
                                            <span class="checkout-item-qty">{{ $value['qty'] }}</span>
                                            <img src="{{ $value['prod_image'] }}" alt="" class="rounded img-fluid">
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
                                <p class="m-0 fw-bolder fs-6">總金額</p>
                                <p class="m-0 fs-6 fw-bolder total_price">$ {{ $total }}</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center ship_item" style="display: none !important">
                                <p class="m-0 fw-bolder fs-6">運送費用</p>
                                <p class="m-0 fs-6 fw-bolder ship_price"></p>
                            </div>
                        </div>
                        <!-- Accept Terms Checkbox-->
                        <div class="form-group form-check my-4">
                            <input type="checkbox" class="form-check-input" id="accept-terms" checked>
                            <label class="form-check-label fw-bolder" for="accept-terms">我同意 WinGx 的 <a href="#">付款條件</a></label>
                        </div>
                        <button type="submit" class="btn btn-dark w-100" role="button">結 帳</button>
                    </div>
                </div>
                <!-- /Checkout Panel Summary -->
            </div>
        </form>

        <!-- /Page Content -->
    </section>
@endsection

@section('css')
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/tw-city-selector@2.1.1/dist/tw-city-selector.min.js"></script>
    <script>
        $(function() {
            new TwCitySelector({
                el: '.city-selector-set',
                elCounty: '.county', // 在 el 裡查找 element
                elDistrict: '.district', // 在 el 裡查找 element
                elZipcode: '.zipcode' // 在 el 裡查找 element
            });

            $('#ship_id').change(function() {
                let ship_id = $(this).val();
                $.post('/api/ship/price', {
                    ship_id: ship_id
                }, function(res) {
                    $('.ship_item').show();
                    $('.ship_price').text('$ ' + res);
                })
            })

            $('#form_post').on('submit', function(){
                let ship_id = $('#ship_id').val();
                let name = $('#name').val();
                let address = $('#address').val();
                let county = $('.county').val();
                let district = $('.district').val();
                let zipcode = $('.zipcode').val();
                let email = $('#email').val();
                let total = $('.total_price').text().replace('$ ', '');
                let remark = $('#remark').val();

                let error_msg = []


                if(email == ''){
                    error_msg.push('請填寫電子郵件');
                }

                if(name == ''){
                    error_msg.push('請填寫姓名');
                }

                if(county == ''){
                    error_msg.push('請選擇縣市');
                }

                if(district == ''){
                    error_msg.push('請選擇區域');
                }

                if(address == ''){
                    error_msg.push('請填寫地址');
                }

                if(ship_id == ''){
                    error_msg.push('請選擇運送方式');
                }

                if($('#accept-terms').prop('checked') == false){
                    error_msg.push('請勾選同意付款條件');
                }

                if(error_msg.length > 0){
                    alert(error_msg.join('\n'));
                    return false;
                } else {
                    $.post('/api/order/store', {
                        ship_id: ship_id,
                        name: name,
                        county: county,
                        district: district,
                        address: address,
                        zipcode: zipcode,
                        email: email,
                        total: total,
                        remark: remark
                    }, function(res) {
                        if(res.status == 'ok'){
                            alert('訂單已送出');
                            location.href = '/order';
                        }
                    })
                }


                return false;
            })

        })
    </script>
@endsection
