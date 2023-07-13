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

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/favicon.png') }}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Page Title -->
    <title>WingX 翼優寵物用品旗艦店</title>

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

    @yield('css')

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
                                            <i class="ri-close-line"></i>
                                        </h6>
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

    @yield('js')
</body>

</html>
