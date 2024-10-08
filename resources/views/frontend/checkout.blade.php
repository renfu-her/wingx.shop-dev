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
    <section class="mt-5 container ">
        <!-- Page Content Goes Here -->

        <h1 class="mb-4 display-5 fw-bold text-center">結帳</h1>
        <p class="text-center mx-auto">請填寫以下資訊</p>

        <form action="/order/store" method="post" id="form_post">
            @csrf
            <div class="row g-md-8 mt-4">
                <!-- Checkout Panel Left -->

                <div class="col-12 col-lg-6 col-xl-7">
                    <!-- Checkout Panel Contact -->
                    @if (count($ships) > 0)
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
                                                <option value="{{ $ship['id'] }}">{{ $ship['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="checkout-panel cart-map" style="display: none">
                        <div class="row">
                            <!-- Email-->
                            <div class="col-12">
                                <div class="form-group">
                                    <a type="botton" id="cartMap" value="" class="btn btn-primary">取件門市</a>
                                </div>
                            </div>
                            <div class="col-12" id="storeDisplay" style="display: none">
                                <div class="form-group">
                                    <label id="CVSStoreID" class="form-label"></label> <br>
                                    <label id="CVSStoreName" class="form-label"></label> <br>
                                    <label id="CVSAddress" class="form-label"></label> <br>
                                    <label id="CVSTelephone" class="form-label"></label> <br>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="checkout-panel">
                        <h5 class="title-checkout">選擇發票類型</h5>
                        <div class="row">

                            <!-- Email-->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="type" class="form-label">電子發票類型</label>
                                    <select name="type" id="type" class="form-select">
                                        <option value="">請選擇</option>
                                        <option value="1">二連式發票(個人)</option>
                                        <option value="2">三聯式發票(公司行號)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="checkout-panel company-form" style="display: none">
                        <h5 class="title-checkout">三聯式發票(公司行號)</h5>
                        <div class="row">

                            <!-- Email-->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="type" class="form-label">公司行號抬頭 <span
                                            style="color: red">*</span></label>
                                    <input type="text" name="company_name" id="company_name" class="form-control">
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="type" class="form-label">統一發票 <span style="color: red">*</span></label>
                                    <input type="text" name="company_uid" id="company_uid" class="form-control"
                                        maxlength="8" oninput="validateUIDInput(this)">
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <div class="form-group">
                                    <label for="type" class="form-label">公司地址 <span style="color: red">*</span></label>
                                    <input type="text" name="company_address" id="company_address" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="checkout-panel">
                        <h5 class="title-checkout">留存方式</h5>
                        <div class="row">

                            <!-- Email-->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="carrier_type" class="form-label">留存方式</label>
                                    <select name="carrier_type" id="carrier_type" class="form-select">
                                        <option value="">請選擇</option>
                                        <option value="1">綠界電子發票載具</option>
                                        <option value="3">手機條碼載具</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="checkout-panel carrier-form" style="display: none">
                        <h5 class="title-checkout">載具編號</h5>
                        <div class="row">
                            <!-- Email-->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="type" class="form-label">載具編號 <span
                                            style="color: red">*</span></label>
                                    <input type="text" name="carrier_num" id="carrier_num" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="checkout-panel">
                        <div class="row">
                            <div class="col-12" id="carrier-description">
                                <div class="alert alert-info" role="alert">
                                    <p>根據財政部令「電子發票實施作業要點」，在 WingX 官網消費後不另行寄送紙本發票。</p>
                                    <p>依統一發票使用辦法規定：個人發票一經開立，即無法更改或改開公司戶發票。須開立統編請選擇三聯式發票(公司行號)，請務必確認選用之電子發票載具類型是否正確。</p>
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
                                    <label for="email" class="form-label">Email
                                        <span><span style="color: red;">*</span> (請一定要填寫，方便我們通知您購物狀況)</span></label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $member->email }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-12">
                            <div class="form-group">
                                <label for="username" class="form-label">你的姓名</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder=""
                                    value="{{ $member->username }}">
                            </div>
                        </div>

                        <div class="col-sm-12 col-12">
                            <div class="form-group">
                                <label for="mobile" class="form-label">手機號碼</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder=""
                                    value="{{ $member->mobile }}">
                            </div>
                        </div>

                        {{-- <div class="col-sm-12 col-12"> --}}
                        <div class="form-group">
                            <div class="twzipcode">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <select class="form-select" name="county" id="county"
                                            data-role="county"></select>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <select class="form-select" name="district" id="district"
                                            data-role="district"></select>
                                    </div>
                                </div>
                                <input type="hidden" id="zipcode" name="zipcode" data-role="zipcode" />
                            </div>
                        </div>
                        {{-- </div> --}}

                        <div class="col-12">
                            <div class="form-group">
                                <label for="address" class="form-label">地址</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ $member->address }}">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="address" class="form-label">備註</label>
                                <textarea class="form-control" rows="5" id="remark" name="remark"></textarea>
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
                                            <img src="{{ $value['prod_image'] }}" alt=""
                                                class="rounded img-fluid">
                                        </div>
                                        <div>
                                            <p class="mb-1 fs-6 fw-bolder">{{ $value['prod_name'] }}</p>
                                            @if (!empty($value['items']))
                                                <p class="mb-1 fs-6 fw-bolder">{!! $value['items'] !!}</p>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="flex-shrink-0 fw-bolder">
                                        <span>$ {{ number_format($value['sub_total']) }}</span>
                                    </div>
                                </div>
                            @endforeach

                            <!-- / Cart Item-->
                        </div>
                        <div class="py-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <p class="m-0 fw-bolder fs-6">總金額</p>
                                <p class="m-0 fs-6 fw-bolder total_price">$ {{ number_format($total) }}</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center ship_item"
                                style="display: none !important">
                                <p class="m-0 fw-bolder fs-6">運送費用</p>
                                <p class="m-0 fs-6 fw-bolder ship_price"></p>
                            </div>
                        </div>
                        <!-- Accept Terms Checkbox-->
                        <div class="form-group form-check my-4">
                            <input type="checkbox" class="form-check-input" id="accept_terms" name="accept_terms"
                                checked>
                            <label class="form-check-label fw-bolder" for="accept-terms">我同意 WinGx 的 <a
                                    href="#">付款條件</a></label>
                        </div>
                        <input type="hidden" name="ship_price">
                        <input type="hidden" name="total">
                        <input type="hidden" name="LogisticsSubType">
                        <input type="hidden" name="CVSStoreID">
                        <input type="hidden" name="CVSStoreName">
                        <input type="hidden" name="CVSAddress">
                        <input type="hidden" name="CVSTelephone">
                        <input type="hidden" name="CVSOutSide">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
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
    <script src="{{ asset('frontend/js/twzipcode.min.js') }}"></script>
    <script>
        $(function() {

            $.post("https://demo.dev-laravel.co/api/map/remove/{{ auth()->guard('member')->user()->id }}");

            const twzipcode = new TWzipcode();

            let ships = 0;
            @if (count($ships) > 0)
                ships = {{ count($ships) }};
            @endif

            twzipcode.set({{ $member->zipcode }})


            // 載具類型
            $('#carrier_type').on('change', function() {
                let carrier_type = $(this).val();
                if (carrier_type > 1) {
                    $('.carrier-form').show();
                } else {
                    $('.carrier-form').hide();
                }
            })

            // 載具編號檢查
            // $('#carrier_num').on('change', function() {
            //     let carrier_num = $(this).val();
            //     if (carrier_type === 3 && carrier_num.length === 8) {
            //         $.get('/order/checkCarrierNum', {
            //             barCode: carrier_num
            //         }, function(res) {
            //             console.log(res);
            //         })
            //     }
            // })


            if (ships > 0) {
                $('#ship_id').change(function() {
                    let ship_id = $(this).val();
                    $.post('/api/ship/price', {
                        ship_id: ship_id
                    }, function(res) {
                        $('.ship_item').show();
                        $('.ship_price').text('$ ' + res);
                    })
                })
            } else {
                let ship_price = '$ 0';
                $('.ship_item').css('display', 'block');
                $('input[name=ship_price]').val(0);
                $('.ship_price').text('$ 0');
            }

            $('#form_post').on('submit', function(e) {
                e.preventDefault();
                let carrier_type = $('#carrier_type').val();
                let carrier_num = $('#carrier_num').val();

                if (carrier_type == '3') {
                    $.get('/order/checkCarrierNum', {
                        barCode: carrier_num
                    }, function(res) {
                        if (res.IsExist === 'N' && res.RtnCode === 1) {

                            submitForm();
                        } else {
                            alert('載具號碼驗證失敗，請檢查後重試');
                        }
                    });
                } else {
                    // 如果不需要API验证,直接提交表单
                    submitForm();
                }

            })

            const submitForm = () => {
                let name = $('#name').val();
                let address = $('#address').val();
                let county = $('#county').val();
                let district = $('#district').val();
                let zipcode = $('#zipcode').val();
                let email = $('#email').val();
                let total = $('.total_price').text().replace('$ ', '');
                let remark = $('#remark').val();
                let mobile = $('#mobile').val();
                let type = $('#type').val();
                let company_name = $('#company_name').val();
                let company_uid = $('#company_uid').val();
                let company_address = $('#company_address').val();

                $('input[name=total]').val(total);

                let error_msg = []

                if (ships > 0) {
                    let ship_id = $('#ship_id').val();
                    let ship_price = $('.ship_price').text().replace('$ ', '');
                    $('input[name=ship_price]').val(ship_price);

                    if (ship_id == '') {
                        error_msg.push('請選擇運送方式');
                    }
                }

                if (type == '') {
                    error_msg.push('請填寫電子發票類別');
                } else {
                    if (type == '2') {
                        if (company_name == '') {
                            error_msg.push('請填寫公司抬頭');
                        }
                        if (company_uid == '') {
                            error_msg.push('請填寫統一編號');
                        }
                        if (company_address == '') {
                            error_msg.push('請填寫公司地址');
                        }
                    }
                }

                if (email == '') {
                    error_msg.push('請填寫電子郵件');
                }

                if (name == '') {
                    error_msg.push('請填寫姓名');
                }

                if (county == '') {
                    error_msg.push('請選擇縣市');
                }

                if (district == '') {
                    error_msg.push('請選擇區域');
                }

                if (address == '') {
                    error_msg.push('請填寫地址');
                }

                if ($('#accept_terms').prop('checked') == false) {
                    error_msg.push('請勾選同意付款條件');
                }

                if (carrier_type > 1) {
                    if (carrier_num == '') {
                        error_msg.push('請填寫載具號碼');
                    }
                }


                if (error_msg.length > 0) {
                    alert(error_msg.join('\n'));
                } else {

                    $('#form_post')[0].submit();
                }
            }

            $('#type').on('change', function() {
                let type = $(this).val();

                if (type == '2') {
                    $('.company-form').show();
                } else {
                    $('.company-form').hide();
                }
            })

            // 電子地圖
            $('#cartMap').on('click', function() {
                window.open($(this).attr('value'), '_blank')
            })

            $('#ship_id').on('change', function() {
                let shipId = $(this).val();
                if (shipId == 1) {
                    shipName = 'FAMIC2C'
                }
                if (shipId == 2) {
                    shipName = 'UNIMARTC2C'
                }

                $('#storeDisplay').hide();
                $('input[name=LogisticsSubType]').val('');
                $('input[name=CVSStoreID]').val('');
                $('input[name=CVSStoreName]').val('');
                $('input[name=CVSAddress]').val('');
                $('input[name=CVSTelephone]').val('');
                $('input[name=CVSOutSide]').val('');

                if (shipId < 3 && !isNaN(shipId)) {
                    let appUrl = "{{ config('config.APP_ENV') }}"
                    if (appUrl == 'local') {
                        merchantID = "{{ config('config.EXPRESS_MERCHANT_ID_DEV') }}"
                        url = "https://logistics-stage.ecpay.com.tw/Express/map";
                    } else {
                        merchantID = "{{ config('config.EXPRESS_MERCHANT_ID') }}"
                        url = "https://logistics.ecpay.com.tw/Express/map"
                    }

                    $('#cartMap').attr('value',
                        url + "?MerchantID=" + merchantID +
                        "&LogisticsType=CVS&LogisticsSubType=" +
                        shipName +
                        "&IsCollection=Y&ServerReplyURL=https://demo.dev-laravel.co/api/map/rewrite?memberId={{ auth()->guard('member')->user()->id }}"
                    )
                    $('.cart-map').show()
                } else {
                    $('.cart-map').hide()
                }
            })

        })

        function validateUIDInput(input) {
            // 移除非數字字符
            input.value = input.value.replace(/[^0-9]/g, '');

            // 檢查長度是否為 8 位數
            if (input.value.length !== 8) {
                input.setCustomValidity('請輸入 8 位數字');
            } else {
                input.setCustomValidity('');
            }
        }

        //MARK: returnedData, json to array
        // window.addEventListener('message', function(event) {

        //     if (event.data.message != undefined) {
        //         console.log(event.data.message);
        //         // let msg = JSON.parse(event.data.message);

        //         const msg = event.data.message;

        //         $('input[name=LogisticsSubType]').val(msg.LogisticsSubType);
        //         $('input[name=CVSStoreID]').val(msg.CVSStoreID);
        //         $('input[name=CVSStoreName]').val(msg.CVSStoreName);
        //         $('input[name=CVSAddress]').val(msg.CVSAddress);
        //         $('input[name=CVSTelephone]').val(msg.CVSTelephone);
        //         $('input[name=CVSOutSide]').val(msg.CVSOutSide);

        //         $('#storeDisplay').show();
        //         $('#CVSStoreID').html('代號：' + msg.CVSStoreID);
        //         $('#CVSStoreName').html('名稱：' + msg.CVSStoreName);
        //         $('#CVSAddress').html('地址：' + msg.CVSAddress);
        //         $('#CVSTelephone').html('電話：' + msg.CVSTelephone);
        //     }
        // });



        let intervalId = setInterval(function() {
            $.post('https://demo.dev-laravel.co/api/map/logistics', {
                memberId: "{{ auth()->guard('member')->user()->id }}"
            }, function(res) {
                console.log(res.status);
                if (res.status == 'success') {
                    const msg = res.data;

                    $('input[name=LogisticsSubType]').val(msg.logistics_sub_type);
                    $('input[name=CVSStoreID]').val(msg.cvs_store_id);
                    $('input[name=CVSStoreName]').val(msg.cvs_store_name);
                    $('input[name=CVSAddress]').val(msg.cvs_address);
                    $('input[name=CVSTelephone]').val(msg.cvs_telephone);
                    $('input[name=CVSOutSide]').val(msg.cvs_out_side);

                    $('#CVSStoreID').html('代號：' + msg.cvs_store_id);
                    $('#CVSStoreName').html('名稱：' + msg.cvs_store_name);
                    $('#CVSAddress').html('地址：' + msg.cvs_address);
                    $('#CVSTelephone').html('電話：' + msg.cvs_telephone);
                    $('#storeDisplay').show();

                    // 停止定時器
                    clearInterval(intervalId);
                }
            });
        }, 1000);
    </script>
@endsection
