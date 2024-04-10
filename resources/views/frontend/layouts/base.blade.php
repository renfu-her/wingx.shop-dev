<!doctype html>
<html lang="en">

<!-- Head -->

<head>
    <!-- Page Meta Tags-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">

    <!-- Page Title -->
    <title>WingX 翼優寵物用品旗艦店</title>


    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/favicon.png') }}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/libs.bundle.css') }}" />

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/theme.bundle.css') }}" />

    <!-- Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('frontend/css/login-register.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css?t=' . time()) }}" />
    <!-- Fix for custom scrollbar if JS is disabled-->
    <noscript>
        <style>
            /**
          * Reinstate scrolling for non-JS clients
          */
            .simplebar-content-wrapper {
                overflow: auto;
            }
        </style>
    </noscript>


</head>

<body class="">

    @include('frontend.layouts.header')

    @yield('content')

    @include('frontend.layouts.footer')

    <!-- register, login form -->
    <div class="modal fade login" id="loginModal" style="display: none; z-index: 1000000000000000000 !important"
        aria-hidden="true">
        <div class="modal-dialog login animated modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 id="login_title" class="modal-title w-100">登入</h4>
                    <button type="button" class="close close-modal" data-bs-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="box">
                        <div class="content">
                            <div class="error"></div>
                            <div class="form loginBox" style="display: block;">
                                <form method="post" action="/login" id="form_login">
                                    <input id="email" class="form-control" type="text" placeholder="Email"
                                        name="email">
                                    <div
                                        style="height:33px;max-width:33px;vertical-align:top; position:absolute;
                                top:148.55397727272728px;left:265.2551319648094px;cursor:pointer;resize: both;z-index:2147483646;">

                                    </div>
                                    <input id="password" class="form-control" type="password" placeholder="密碼"
                                        name="password">

                                    <div
                                        style="height:33px;max-width:33px;vertical-align:top; position:absolute; top:199.55397727272728px;left:265.2551319648094px;cursor:pointer;resize: both;z-index:2147483646;">
                                    </div>
                                    <input id="submit_login" class="btn btn-default btn-login" type="button"
                                        value="登入">

                                    <div class="d-flex justify-content-around bd-highlight mb-3">
                                        <div class="p-2 bd-highlight">
                                            <span><a href="#" id="showForgotForm">忘記密碼</a></span>
                                        </div>
                                        <div class="login-footer p-2 bd-highlight" style="display: block;">
                                            <span><a href="#" id="showRegisterForm">註冊帳號</a></span>
                                        </div>
                                        <div class="login-footer p-2 bd-highlight" style="display: block;">
                                            <span><a href="#" id="showVerify">重發驗證信</a></span>
                                        </div>
                                    </div>

                                    {{-- <hr>
                                    <div class="btn btn-primary"
                                        onclick="if (!window.__cfRLUnblockHandlers) return false; location.href='/facebook/auth'"
                                        style="width: 100%; margin: 5px 0 5px 0 0; border-radius: 6px"
                                        data-cf-modified-b4a47e509e2e693a0474629e-="">
                                        Facebook 登入
                                    </div> --}}


                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="content registerBox" style="display: none;">
                            <div class="form">
                                <form id="form-signup" method="post" action="/sign-up">
                                    <input id="signup_username" class="form-control" type="text" placeholder="會員名稱"
                                        name="signup_username">
                                    <input id="signup_email" class="form-control" type="text" placeholder="Email"
                                        name="signup_email">
                                    <input id="signup_password" class="form-control" type="password"
                                        placeholder="密碼" name="signup_password">
                                    <span class="text-danger"
                                        style="font-size:12px;color:#333;">(設定密碼請輸入英文+數字，共6位數以上)</span>
                                    <input id="confirm_password" class="form-control" type="password"
                                        placeholder="確認密碼" name="confirm_password">
                                    <p>
                                        <img src="/captcha" alt="點擊刷新"
                                            style="cursor: pointer; width: 180px; height: 36px"
                                            onclick="this.src='{{ url('captcha/default') }}?s='+Math.random()">
                                    </p>
                                    <input class="form-control" type="text" placeholder="輸入驗證碼" id="captcha"
                                        name="captcha">
                                    <input id="sign-up" class="btn btn-default btn-register" type="button"
                                        value="註冊">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="content forgotBox" style="display: none;">
                            <div class="form">
                                <form id="form-reset" method="post" action="/reset_password">
                                    <input id="reset_email" class="form-control" type="text" placeholder="Email"
                                        name="reset_email">
                                    <input id="reset_submit" class="btn btn-default btn-register" type="button"
                                        value="重置密碼">
                                    <div class="d-flex justify-content-around bd-highlight mb-3">
                                        <div class="p-2 bd-highlight">
                                            <span><a href="#" class="showLoginForm">我要登入</a></span>
                                        </div>

                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="content verifyBox" style="display: none;">
                            <div class="form">
                                <form id="form-verify" method="post" action="/email_verify">
                                    <input class="form-control" type="text" placeholder="Email"
                                        name="email_verify">
                                    <input id="verify_submit" class="btn btn-default btn-register" type="button"
                                        value="重發驗證信">
                                    <div class="d-flex justify-content-around bd-highlight mb-3">
                                        <div class="p-2 bd-highlight">
                                            <span><a href="#" class="showLoginForm">我要登入</a></span>
                                        </div>

                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="content">
                            <div clss="w-100">
                                <a href="{{ asset('auth/line') }}" class="btn w-100"
                                    style="background-color: #06C755; color: white">LINE 登入</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="forgot register-footer" style="display: none;">
                        <span>已經有帳號，我要 </span>
                        <a href="#" class="showLoginForm">登入</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Offcanvas Imports-->
    <!-- Cart Offcanvas-->
    <div class="offcanvas offcanvas-end d-none" tabindex="-1" id="offcanvasCart">
        <div class="offcanvas-header d-flex align-items-center">
            <h5 class="offcanvas-title" id="offcanvasCartLabel">購物車</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="d-flex flex-column justify-content-between w-100 h-100">
                <div>

                    <!-- Cart Product-->
                    @if (!empty($cart))
                        @foreach ($cart as $key => $value)
                            <div class="row mx-0 pb-4 mb-4 border-bottom">
                                <div class="col-3">
                                    <picture class="d-block bg-light">
                                        <img class="img-fluid" src="{{ $value['prod_image'] }}"
                                            alt="{{ $value['prod_name'] }}">
                                    </picture>
                                </div>
                                <div class="col-9">
                                    <div>
                                        <h6 class="justify-content-between d-flex align-items-start mb-2">
                                            {{ $value['prod_name'] }}
                                            <i class="ri-close-line" style="cursor: pointer" onclick="cartDelete({{ $key }})"></i>
                                        </h6>
                                        <small class="d-block fw-bolder">{!! $value['items'] !!}</small>
                                        <small class="d-block text-muted fw-bolder">數量: {{ $value['qty'] }}</small>
                                    </div>
                                    <p class="fw-bolder text-end m-0">$ {{ $value['sub_total'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
                <div class="border-top pt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="m-0 fw-bolder">總金額</p>
                        <p class="m-0 fw-bolder">$ {{ $total }}</p>
                    </div>
                    @if (Session::has('member_id'))
                        <a href="/checkout"
                            class="btn btn-orange btn-orange-chunky mt-5 mb-2 d-block text-center">結帳</a>
                    @else
                        <a href="#" onclick="loginOnSystem()"
                            class="btn btn-orange btn-orange-chunky mt-5 mb-2 d-block text-center">結帳</a>
                    @endif
                    <a href="/cart"
                        class="btn btn-dark fw-bolder d-block text-center transition-all opacity-50-hover">瀏覽購物車</a>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.layouts.footer_include')

    <script>
        const cartDelete = (deleteId) => {
            if (confirm('確定要刪除？')) {
                $.post('/cart/delete', {
                    'deleteId': deleteId,
                }, function() {
                    // location.reload();
                })
            }
        }
    </script>

</body>

</html>
