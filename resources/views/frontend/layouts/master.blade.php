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
    <title>WingX 翼優</title>

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

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom mx-0 p-0 flex-column  border-0">
        <div class="w-100 pb-lg-0 pt-lg-0 pt-4 pb-3">
            <div class="container-fluid d-flex justify-content-between align-items-center flex-wrap">


                <div class="d-flex align-items-center me-2 lh-1 width-percent" style="cursor: pointer"
                    onclick="location.href='/'">
                    <img src="{{ asset('frontend/images/logos/logo_c.svg') }}" style="width: 100%" alt="">
                </div>

                <!-- Main Navigation-->
                <div class="flex-shrink-0 collapse navbar-collapse navbar-collapse-light w-auto flex-grow-1"
                    id="navbarNavDropdown">

                    <!-- Mobile Nav Toggler-->
                    <button
                        class="btn btn-link px-2 text-decoration-none navbar-toggler border-0 position-absolute top-0 end-0 mt-3 me-2"
                        data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ri-close-circle-line ri-2x"></i>
                    </button>
                    <!-- / Mobile Nav Toggler-->

                    <ul class="navbar-nav py-lg-2 mx-auto">
                        <ul class="navbar-nav py-lg-2 mx-auto">
                            <li class="nav-item dropdown me-lg-4">
                                <a class="nav-link fw-bolder dropdown-toggle py-lg-4" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    全系列商品
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach ($product_categories as $product_category)
                                        <li><a class="dropdown-item"
                                                href="/category/{{ $product_category->id }}">{{ $product_category->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="nav-item dropdown me-lg-4">
                                <a class="nav-link fw-bolder py-lg-4" href="#">
                                    聯絡我們
                                </a>
                            </li>
                        </ul>
                    </ul>
                </div>
                <!-- / Main Navigation-->

                <!-- Navbar Icons-->
                <ul class="list-unstyled mb-0 d-flex align-items-center">

                    <!-- Navbar Toggle Icon-->
                    <li class="d-inline-block d-lg-none">
                        <button
                            class="btn btn-link px-2 text-decoration-none navbar-toggler border-0 d-flex align-items-center"
                            data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="ri-menu-line ri-lg align-middle"></i>
                        </button>
                    </li>
                    <!-- /Navbar Toggle Icon-->

                    <!-- Navbar Search-->
                    {{-- <li class="ms-1 d-inline-block">
                        <button class="btn btn-link px-2 text-decoration-none d-flex align-items-center" data-pr-search>
                            <i class="ri-search-2-line ri-lg align-middle"></i>
                        </button>
                    </li> --}}
                    <!-- /Navbar Search-->

                    @if (Session::has('member_id'))
                        <!-- 使用者登出-->
                        <li class="ms-1 d-lg-inline-block">
                            <a class="btn btn-link px-2 py-0 text-decoration-none d-flex align-items-center"
                                href="/logout">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i> 登出
                            </a>
                        </li>
                    @endif

                    @if (Session::has('member_id'))
                        <!-- 直接導向購物車列表以頁面 -->
                        <li class="ms-1 d-lg-inline-block">
                            <a class="btn btn-link px-2 text-decoration-none d-flex align-items-center"
                                href="/order/list">
                                <i class="ri-user-line ri-lg align-middle"></i>
                            </a>
                        </li>
                    @else
                        <!-- 使用者登入, modal-->
                        <li class="ms-1 d-lg-inline-block">
                            <a class="btn btn-link px-2 text-decoration-none d-flex align-items-center" href="#"
                                data-bs-toggle="modal" data-bs-target="#loginModal">
                                <i class="ri-user-line ri-lg align-middle"></i> 使用者登入
                            </a>
                        </li>
                    @endif


                    <!-- 購物車-->
                    <li class="ms-1 d-inline-block position-relative">
                        <button
                            class="btn btn-link px-2 text-decoration-none d-flex align-items-center disable-child-pointer"
                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                            <i class="ri-shopping-cart-2-line ri-lg align-middle position-relative z-index-10"></i> 購物車

                            @if ($cart_count['cart_count'] > 0)
                                <span
                                    class="fs-xs fw-bolder f-w-5 f-h-5 bg-orange rounded-lg d-block lh-1 pt-1 position-absolute top-0 end-0 z-index-20 mt-2 text-white cart-count">

                                </span>
                            @endif

                        </button>
                    </li>


                </ul>
                <!-- Navbar Icons-->

            </div>
        </div>
    </nav>
    <!-- / Navbar-->


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
