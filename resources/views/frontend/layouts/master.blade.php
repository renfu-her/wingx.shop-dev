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
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('frontend/favicon/favicon-16x16.png') }}">
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

    <!-- Page Title -->
    <title>🦜BR 麗鸚坊 寵物用品旗艦</title>

</head>

<body class="">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom mx-0 p-0 flex-column  border-0">
        <div class="w-100 pb-lg-0 pt-lg-0 pt-4 pb-3">
            <div class="container-fluid d-flex justify-content-between align-items-center flex-wrap">


                <div class="d-flex align-items-center me-2 lh-1 width-percent" style="cursor: pointer" onclick="location.href='/'">
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
                    <li class="ms-1 d-inline-block">
                        <button class="btn btn-link px-2 text-decoration-none d-flex align-items-center" data-pr-search>
                            <i class="ri-search-2-line ri-lg align-middle"></i>
                        </button>
                    </li>
                    <!-- /Navbar Search-->

                    @if (Session::has('member_id'))
                        <li class="ms-1 d-lg-inline-block">
                            <a class="btn btn-link px-2 py-0 text-decoration-none d-flex align-items-center"
                                href="/logout">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            </a>
                        </li>
                    @endif

                    <!-- Navbar Login-->
                    <li class="ms-1 d-lg-inline-block">
                        <a class="btn btn-link px-2 text-decoration-none d-flex align-items-center" href="#"
                            style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <i class="ri-user-line ri-lg align-middle"></i>
                        </a>
                    </li>
                    <!-- /Navbar Login-->

                    <!-- Navbar Cart-->
                    <li class="ms-1 d-inline-block position-relative">
                        <button
                            class="btn btn-link px-2 text-decoration-none d-flex align-items-center disable-child-pointer"
                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                            <i class="ri-shopping-cart-2-line ri-lg align-middle position-relative z-index-10"></i>

                            <span
                                class="fs-xs fw-bolder f-w-5 f-h-5 bg-orange rounded-lg d-block lh-1 pt-1 position-absolute top-0 end-0 z-index-20 mt-2 text-white">
                                2
                            </span>
                        </button>
                    </li>
                    <!-- /Navbar Cart-->

                </ul>
                <!-- Navbar Icons-->

            </div>
        </div>
    </nav>
    <!-- / Navbar-->


    @yield('content')

    <!-- Footer -->
    <!-- Footer-->
    <footer class="bg-dark mt-10  ">

        <!-- Menus & Newsletter-->
        <div class="border-top-white-opacity py-7 mt-7 text-white">
            <div class="container" data-aos="fade-in">
                <div class="row my-4 flex-wrap">

                    <!-- Footer Nav-->
                    <nav class="col-6 col-md mb-4 mb-md-0">
                        <h6 class="mb-4 fw-bolder fs-6">全系列商品</h6>
                        <ul class="list-unstyled">
                            @foreach ($product_categories as $product_category)
                                <li class="mb-2">
                                    <a class="text-decoration-none text-white opacity-75 opacity-25-hover transition-all"
                                        href="./category/{{ $product_category->id }}">{{ $product_category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                    <!-- /Footer Nav-->

                    <!-- Footer Nav-->
                    <nav class="col-6 col-md mb-4 mb-md-0">
                        <h6 class="mb-4 fw-bolder fs-6">關於我們</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a
                                    class="text-decoration-none text-white opacity-75 opacity-25-hover transition-all"
                                    href="#">關於我們</a>
                            </li>
                            {{-- <li class="mb-2"><a
                                    class="text-decoration-none text-white opacity-75 opacity-25-hover transition-all"
                                    href="#">Our Blog</a></li>
                            <li class="mb-2"><a
                                    class="text-decoration-none text-white opacity-75 opacity-25-hover transition-all"
                                    href="#">FAQs</a></li>
                            <li class="mb-2"><a
                                    class="text-decoration-none text-white opacity-75 opacity-25-hover transition-all"
                                    href="#">Contact</a></li> --}}
                        </ul>
                    </nav>
                    <!-- /Footer Nav-->

                    <!-- Footer Nav-->
                    <nav class="d-none d-md-block col-md">
                        <h6 class="mb-4 fw-bolder fs-6">Navigation</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a
                                    class="text-decoration-none text-white opacity-75 opacity-25-hover transition-all"
                                    href="#">Register</a></li>
                            <li class="mb-2"><a
                                    class="text-decoration-none text-white opacity-75 opacity-25-hover transition-all"
                                    href="#">Cart</a></li>
                            <li class="mb-2"><a
                                    class="text-decoration-none text-white opacity-75 opacity-25-hover transition-all"
                                    href="#">Checkout</a></li>
                            <li class="mb-2"><a
                                    class="text-decoration-none text-white opacity-75 opacity-25-hover transition-all"
                                    href="#">Account</a></li>
                        </ul>
                    </nav>
                    <!-- /Footer Nav-->

                    <!-- Footer Contact-->
                    <div class="col-12 col-md-5">
                        <h6 class="mb-4 fw-bolder fs-6">Join Our Newsletter</h6>
                        <p class="opacity-75">Sign up to our newsletter and we'll email you a code worth 15%
                            off your first order. By subscribing to our mailing list you agree to our terms and
                            conditions.</p>
                        <form
                            class="bg-white d-flex justify-content-start align-items-center border-dark-focus-within transition-all mt-4">
                            <div class="input-group m-0">
                                <input type="text"
                                    class="form-control d-flex flex-grow-1 border-0 bg-transparent py-3"
                                    placeholder="Enter your email" aria-label="Enter your email">
                                <span class="input-group-text bg-transparent border-0"><i
                                        class="ri-arrow-right-line align-middle"></i></span>
                            </div>
                        </form>
                    </div>
                    <!-- /Footer Contact-->

                </div>
                <div
                    class="border-top-white-opacity justify-content-between flex-column flex-md-row align-items-center d-flex pt-6 mt-6 px-0">
                    <p class="small opacity-75">&copy; 2021 Alpine All Rights Reserved. Template by <a
                            class="text-white" href="https://www.pixelrocket.store">Pixel Rocket</a></p>
                    <nav>
                        <ul class="list-unstyled">
                            <li class="d-inline-block me-1 bg-white rounded px-2 pt-1"><i
                                    class="pi pi-paypal pi-sm"></i></li>
                            <li class="d-inline-block me-1 bg-white rounded px-2 pt-1"><i
                                    class="pi pi-mastercard pi-sm"></i>
                            </li>
                            <li class="d-inline-block me-1 bg-white rounded px-2 pt-1"><i
                                    class="pi pi-american-express pi-sm"></i></li>
                            <li class="d-inline-block bg-white rounded px-2 pt-1"><i class="pi pi-visa pi-sm"></i>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Menus & Newsletter-->

    </footer>
    <!-- / Footer-->
    <!-- / Footer-->


    <!-- Offcanvas Imports-->
    <!-- Cart Offcanvas-->
    <div class="offcanvas offcanvas-end d-none" tabindex="-1" id="offcanvasCart">
        <div class="offcanvas-header d-flex align-items-center">
            <h5 class="offcanvas-title" id="offcanvasCartLabel">Your Cart</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="d-flex flex-column justify-content-between w-100 h-100">
                <div>

                    <div class="mt-4 mb-5">
                        <p class="mb-2 fs-6"><i class="ri-truck-line align-bottom me-2"></i> <span
                                class="fw-bolder">$22</span> away
                            from free delivery</p>
                        <div class="progress f-h-1">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 25%"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <!-- Cart Product-->
                    <div class="row mx-0 pb-4 mb-4 border-bottom">
                        <div class="col-3">
                            <picture class="d-block bg-light">
                                <img class="img-fluid" src="./assets/images/products/product-1.jpg"
                                    alt="Bootstrap 5 Template by Pixel Rocket">
                            </picture>
                        </div>
                        <div class="col-9">
                            <div>
                                <h6 class="justify-content-between d-flex align-items-start mb-2">
                                    Mens StormBreaker Jacket
                                    <i class="ri-close-line"></i>
                                </h6>
                                <small class="d-block text-muted fw-bolder">Size: Medium</small>
                                <small class="d-block text-muted fw-bolder">Qty: 1</small>
                            </div>
                            <p class="fw-bolder text-end m-0">$85.00</p>
                        </div>
                    </div>

                    <!-- Cart Product-->
                    <div class="row mx-0 pb-4 mb-4 border-bottom">
                        <div class="col-3">
                            <picture class="d-block bg-light">
                                <img class="img-fluid" src="./assets/images/products/product-2.jpg"
                                    alt="Bootstrap 5 Template by Pixel Rocket">
                            </picture>
                        </div>
                        <div class="col-9">
                            <div>
                                <h6 class="justify-content-between d-flex align-items-start mb-2">
                                    Mens Torrent Terrain Jacket
                                    <i class="ri-close-line"></i>
                                </h6>
                                <small class="d-block text-muted fw-bolder">Size: Medium</small>
                                <small class="d-block text-muted fw-bolder">Qty: 1</small>
                            </div>
                            <p class="fw-bolder text-end m-0">$99.00</p>
                        </div>
                    </div>

                </div>
                <div class="border-top pt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="m-0 fw-bolder">Subtotal</p>
                        <p class="m-0 fw-bolder">$233.33</p>
                    </div>
                    <a href="./checkout.html"
                        class="btn btn-orange btn-orange-chunky mt-5 mb-2 d-block text-center">Checkout</a>
                    <a href="./cart.html"
                        class="btn btn-dark fw-bolder d-block text-center transition-all opacity-50-hover">View
                        Cart</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Filters Offcanvas-->
    <div class="offcanvas offcanvas-end d-none" tabindex="-1" id="offcanvasFilters">
        <div class="offcanvas-header d-flex align-items-center">
            <h5 class="offcanvas-title" id="offcanvasFiltersLabel">Category Filters</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="d-flex flex-column justify-content-between w-100 h-100">

                <!-- Filters-->
                <div>
                    <!-- Filter Category -->
                    <div class="mb-4">
                        <h2 class="mb-4 fs-6 mt-2 fw-bolder">Jacket Category</h2>
                        <nav>
                            <ul class="list-unstyled list-default-text">
                                <li class="mb-2"><a
                                        class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center"
                                        href="#"><span><i class="ri-arrow-right-s-line align-bottom ms-n1"></i>
                                            Waterproof
                                            Jackets</span> <span class="text-muted ms-4">(21)</span></a>
                                </li>
                                <li class="mb-2"><a
                                        class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center"
                                        href="#"><span><i class="ri-arrow-right-s-line align-bottom ms-n1"></i>
                                            Down
                                            Jackets</span> <span class="text-muted ms-4">(13)</span></a>
                                </li>
                                <li class="mb-2"><a
                                        class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center"
                                        href="#"><span><i class="ri-arrow-right-s-line align-bottom ms-n1"></i>
                                            Windproof
                                            Jackets</span> <span class="text-muted ms-4">(18)</span></a>
                                </li>
                                <li class="mb-2"><a
                                        class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center"
                                        href="#"><span><i class="ri-arrow-right-s-line align-bottom ms-n1"></i>
                                            Hiking
                                            Jackets</span> <span class="text-muted ms-4">(25)</span></a>
                                </li>
                                <li class="mb-2"><a
                                        class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center"
                                        href="#"><span><i class="ri-arrow-right-s-line align-bottom ms-n1"></i>
                                            Climbing
                                            Jackets</span> <span class="text-muted ms-4">(11)</span></a>
                                </li>
                                <li class="mb-2"><a
                                        class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center"
                                        href="#"><span><i class="ri-arrow-right-s-line align-bottom ms-n1"></i>
                                            Trekking
                                            Jackets</span> <span class="text-muted ms-4">(19)</span></a>
                                </li>
                                <li class="mb-2"><a
                                        class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center"
                                        href="#"><span><i class="ri-arrow-right-s-line align-bottom ms-n1"></i>
                                            Allround
                                            Jackets</span> <span class="text-muted ms-4">(24)</span></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- / Filter Category-->

                    <!-- Price Filter -->
                    <div class="py-4 widget-filter widget-filter-price border-top">
                        <a class="small text-body text-decoration-none text-secondary-hover transition-all transition-all fs-6 fw-bolder d-block collapse-icon-chevron"
                            data-bs-toggle="collapse" href="#filter-modal-price" role="button"
                            aria-expanded="false" aria-controls="filter-modal-price">
                            Price
                        </a>
                        <div id="filter-modal-price" class="collapse">
                            <div class="filter-price mt-6"></div>
                            <div class="d-flex justify-content-between align-items-center mt-7">
                                <div class="input-group mb-0 me-2 border">
                                    <span class="input-group-text bg-transparent fs-7 p-2 text-muted border-0">$</span>
                                    <input type="number" min="00" max="1000" step="1"
                                        class="filter-min form-control-sm border flex-grow-1 text-muted border-0">
                                </div>
                                <div class="input-group mb-0 ms-2 border">
                                    <span class="input-group-text bg-transparent fs-7 p-2 text-muted border-0">$</span>
                                    <input type="number" min="00" max="1000" step="1"
                                        class="filter-max form-control-sm flex-grow-1 text-muted border-0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Price Filter -->

                    <!-- Brands Filter -->
                    <div class="py-4 widget-filter border-top">
                        <a class="small text-body text-decoration-none text-secondary-hover transition-all transition-all fs-6 fw-bolder d-block collapse-icon-chevron"
                            data-bs-toggle="collapse" href="#filter-modal-brands" role="button"
                            aria-expanded="false" aria-controls="filter-modal-brands">
                            Brands
                        </a>
                        <div id="filter-modal-brands" class="collapse">
                            <div class="input-group my-3 py-1">
                                <input type="text" class="form-control py-2 filter-search rounded"
                                    placeholder="Search" aria-label="Search">
                                <span
                                    class="input-group-text bg-transparent p-2 position-absolute top-2 end-0 border-0 z-index-20"><i
                                        class="ri-search-2-line text-muted"></i></span>
                            </div>
                            <div class="simplebar-wrapper">
                                <div class="filter-options" data-pixr-simplebar>
                                    <div class="form-group form-check mb-0">
                                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-0">
                                        <label
                                            class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                            for="filter-brands-modal-0">Adidas <span
                                                class="text-muted">(21)</span></label>
                                    </div>
                                    <div class="form-group form-check mb-0">
                                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-1">
                                        <label
                                            class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                            for="filter-brands-modal-1">Asics <span
                                                class="text-muted">(13)</span></label>
                                    </div>
                                    <div class="form-group form-check mb-0">
                                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-2">
                                        <label
                                            class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                            for="filter-brands-modal-2">Canterbury <span
                                                class="text-muted">(18)</span></label>
                                    </div>
                                    <div class="form-group form-check mb-0">
                                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-3">
                                        <label
                                            class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                            for="filter-brands-modal-3">Converse <span
                                                class="text-muted">(25)</span></label>
                                    </div>
                                    <div class="form-group form-check mb-0">
                                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-4">
                                        <label
                                            class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                            for="filter-brands-modal-4">Donnay <span
                                                class="text-muted">(11)</span></label>
                                    </div>
                                    <div class="form-group form-check mb-0">
                                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-5">
                                        <label
                                            class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                            for="filter-brands-modal-5">Nike <span
                                                class="text-muted">(19)</span></label>
                                    </div>
                                    <div class="form-group form-check mb-0">
                                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-6">
                                        <label
                                            class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                            for="filter-brands-modal-6">Millet <span
                                                class="text-muted">(24)</span></label>
                                    </div>
                                    <div class="form-group form-check mb-0">
                                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-7">
                                        <label
                                            class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                            for="filter-brands-modal-7">Puma <span
                                                class="text-muted">(11)</span></label>
                                    </div>
                                    <div class="form-group form-check mb-0">
                                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-8">
                                        <label
                                            class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                            for="filter-brands-modal-8">Reebok <span
                                                class="text-muted">(19)</span></label>
                                    </div>
                                    <div class="form-group form-check mb-0">
                                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-9">
                                        <label
                                            class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                            for="filter-brands-modal-9">Under Armour <span
                                                class="text-muted">(24)</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Brands Filter -->

                    <!-- Type Filter -->
                    <div class="py-4 widget-filter border-top">
                        <a class="small text-body text-decoration-none text-secondary-hover transition-all transition-all fs-6 fw-bolder d-block collapse-icon-chevron"
                            data-bs-toggle="collapse" href="#filter-modal-type" role="button" aria-expanded="false"
                            aria-controls="filter-modal-type">
                            Type
                        </a>
                        <div id="filter-modal-type" class="collapse">
                            <div class="input-group my-3 py-1">
                                <input type="text" class="form-control py-2 filter-search rounded"
                                    placeholder="Search" aria-label="Search">
                                <span
                                    class="input-group-text bg-transparent p-2 position-absolute top-2 end-0 border-0 z-index-20"><i
                                        class="ri-search-2-line text-muted"></i></span>
                            </div>
                            <div class="filter-options">
                                <div class="form-group form-check mb-0">
                                    <input type="checkbox" class="form-check-input" id="filter-type-modal-0">
                                    <label
                                        class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                        for="filter-type-modal-0">Slip On </label>
                                </div>
                                <div class="form-group form-check mb-0">
                                    <input type="checkbox" class="form-check-input" id="filter-type-modal-1">
                                    <label
                                        class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                        for="filter-type-modal-1">Strap Up </label>
                                </div>
                                <div class="form-group form-check mb-0">
                                    <input type="checkbox" class="form-check-input" id="filter-type-modal-2">
                                    <label
                                        class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                        for="filter-type-modal-2">Zip Up </label>
                                </div>
                                <div class="form-group form-check mb-0">
                                    <input type="checkbox" class="form-check-input" id="filter-type-modal-3">
                                    <label
                                        class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                        for="filter-type-modal-3">Toggle </label>
                                </div>
                                <div class="form-group form-check mb-0">
                                    <input type="checkbox" class="form-check-input" id="filter-type-modal-4">
                                    <label
                                        class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                        for="filter-type-modal-4">Auto </label>
                                </div>
                                <div class="form-group form-check mb-0">
                                    <input type="checkbox" class="form-check-input" id="filter-type-modal-5">
                                    <label
                                        class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                        for="filter-type-modal-5">Click </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Type Filter -->

                    <!-- Sizes Filter -->
                    <div class="py-4 widget-filter border-top">
                        <a class="small text-body text-decoration-none text-secondary-hover transition-all transition-all fs-6 fw-bolder d-block collapse-icon-chevron"
                            data-bs-toggle="collapse" href="#filter-modal-sizes" role="button"
                            aria-expanded="false" aria-controls="filter-modal-sizes">
                            Sizes
                        </a>
                        <div id="filter-modal-sizes" class="collapse">
                            <div class="filter-options mt-3">
                                <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                    <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-0">
                                    <label class="form-check-label fw-normal" for="filter-sizes-modal-0">6.5</label>
                                </div>
                                <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                    <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-1">
                                    <label class="form-check-label fw-normal" for="filter-sizes-modal-1">7</label>
                                </div>
                                <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                    <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-2">
                                    <label class="form-check-label fw-normal" for="filter-sizes-modal-2">7.5</label>
                                </div>
                                <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                    <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-3">
                                    <label class="form-check-label fw-normal" for="filter-sizes-modal-3">8</label>
                                </div>
                                <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                    <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-4">
                                    <label class="form-check-label fw-normal" for="filter-sizes-modal-4">8.5</label>
                                </div>
                                <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                    <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-5">
                                    <label class="form-check-label fw-normal" for="filter-sizes-modal-5">9</label>
                                </div>
                                <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                    <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-6">
                                    <label class="form-check-label fw-normal" for="filter-sizes-modal-6">9.5</label>
                                </div>
                                <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                    <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-7">
                                    <label class="form-check-label fw-normal" for="filter-sizes-modal-7">10</label>
                                </div>
                                <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                    <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-8">
                                    <label class="form-check-label fw-normal" for="filter-sizes-modal-8">10.5</label>
                                </div>
                                <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                    <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-9">
                                    <label class="form-check-label fw-normal" for="filter-sizes-modal-9">11</label>
                                </div>
                                <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                    <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-10">
                                    <label class="form-check-label fw-normal" for="filter-sizes-modal-10">11.5</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Sizes Filter -->

                    <!-- Colour Filter -->
                    <div class="py-4 widget-filter border-top">
                        <a class="small text-body text-decoration-none text-secondary-hover transition-all transition-all fs-6 fw-bolder d-block collapse-icon-chevron"
                            data-bs-toggle="collapse" href="#filter-modal-colour" role="button"
                            aria-expanded="false" aria-controls="filter-modal-colour">
                            Colour
                        </a>
                        <div id="filter-modal-colour" class="collapse">
                            <div class="filter-options mt-3">
                                <div
                                    class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-primary">
                                    <input type="checkbox" class="form-check-color-input"
                                        id="filter-colours-modal-0">
                                    <label class="form-check-label" for="filter-colours-modal-0"></label>
                                </div>
                                <div
                                    class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-success">
                                    <input type="checkbox" class="form-check-color-input"
                                        id="filter-colours-modal-1">
                                    <label class="form-check-label" for="filter-colours-modal-1"></label>
                                </div>
                                <div
                                    class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-danger">
                                    <input type="checkbox" class="form-check-color-input"
                                        id="filter-colours-modal-2">
                                    <label class="form-check-label" for="filter-colours-modal-2"></label>
                                </div>
                                <div
                                    class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-info">
                                    <input type="checkbox" class="form-check-color-input"
                                        id="filter-colours-modal-3">
                                    <label class="form-check-label" for="filter-colours-modal-3"></label>
                                </div>
                                <div
                                    class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-warning">
                                    <input type="checkbox" class="form-check-color-input"
                                        id="filter-colours-modal-4">
                                    <label class="form-check-label" for="filter-colours-modal-4"></label>
                                </div>
                                <div
                                    class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-dark">
                                    <input type="checkbox" class="form-check-color-input"
                                        id="filter-colours-modal-5">
                                    <label class="form-check-label" for="filter-colours-modal-5"></label>
                                </div>
                                <div
                                    class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-secondary">
                                    <input type="checkbox" class="form-check-color-input"
                                        id="filter-colours-modal-6">
                                    <label class="form-check-label" for="filter-colours-modal-6"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Colour Filter -->
                </div>
                <!-- / Filters-->

                <!-- Filter Button-->
                <div class="border-top pt-3">
                    <a href="#" class="btn btn-dark mt-2 d-block hover-lift-sm hover-boxshadow">Done</a>
                </div>
                <!-- /Filter Button-->
            </div>
        </div>
    </div>
    <!-- Review Offcanvas-->
    <div class="offcanvas offcanvas-end d-none" tabindex="-1" id="offcanvasReview">
        <div class="offcanvas-header d-flex align-items-center">
            <h5 class="offcanvas-title" id="offcanvasReviewLabel">Leave A Review</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <!-- Review Form -->
            <form>
                <div class="form-group mb-3 mt-2">
                    <label class="form-label" for="formReviewName">Your Name</label>
                    <input type="text" class="form-control" id="formReviewName" placeholder="Your Name">
                </div>
                <div class="form-group mb-3 mt-2">
                    <label class="form-label" for="formReviewEmail">Your Email</label>
                    <input type="text" class="form-control" id="formReviewEmail" placeholder="Your Email">
                </div>
                <div class="form-group mb-3 mt-2">
                    <label class="form-label" for="formReviewTitle">Your Review Title</label>
                    <input type="text" class="form-control" id="formReviewTitle" placeholder="Review Title">
                </div>
                <div class="form-group mb-3 mt-2">
                    <label class="form-label" for="formReviewReview">Your Review</label>
                    <textarea class="form-control" name="formReviewReview" id="formReviewReview" cols="30" rows="5"
                        placeholder="Your Review"></textarea>
                </div>
                <button type="submit" class="btn btn-dark hover-lift hover-boxshadow">Submit Review</button>
            </form>
            <!-- / Review Form-->
        </div>
    </div>

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
                                    {{--
                                    <hr>
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
                                    <input id="signup_username" class="form-control" type="text"
                                        placeholder="會員名稱" name="signup_username">
                                    <input id="signup_email" class="form-control" type="text" placeholder="Email"
                                        name="signup_email">
                                    <input id="signup_password" class="form-control" type="password"
                                        placeholder="密碼" name="signup_password">
                                    <span class="text-danger"
                                        style="font-size:12px;color:#333;">(設定密碼請輸入英文大小寫+數字，共6位數以上)</span>
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
                                    <input id="verify_email" class="form-control" type="text" placeholder="Email"
                                        name="verify_email">
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

    <!-- Search Overlay-->
    <section class="search-overlay">
        <div class="container search-container">
            <div class="py-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <p class="lead lh-1 m-0 fw-bold">What are you looking for?</p>
                    <button class="btn btn-light btn-close-search"><i class="ri-close-circle-line align-bottom"></i>
                        Close search</button>
                </div>
                <form>
                    <input type="text" class="form-control" id="searchForm"
                        placeholder="Search by product or category name...">
                </form>
                <div class="my-5">
                    <p class="lead fw-bolder">2 results found for <span class="fw-bold">"Waterproof Jacket"</span>
                    </p>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
                            <!-- Card Product-->
                            <div class="card position-relative h-100 card-listing hover-trigger">
                                <div class="card-header">
                                    <picture class="position-relative overflow-hidden d-block bg-light">
                                        <img class="w-100 img-fluid position-relative z-index-10" title=""
                                            src="./assets/images/products/product-1.jpg"
                                            alt="Bootstrap 5 Template by Pixel Rocket">
                                    </picture>
                                    <div class="card-actions">
                                        <span
                                            class="small text-uppercase tracking-wide fw-bolder text-center d-block">Quick
                                            Add</span>
                                        <div class="d-flex justify-content-center align-items-center flex-wrap mt-3">
                                            <button class="btn btn-outline-dark btn-sm mx-2">S</button>
                                            <button class="btn btn-outline-dark btn-sm mx-2">M</button>
                                            <button class="btn btn-outline-dark btn-sm mx-2">L</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-0 text-center">
                                    <div class="d-flex justify-content-center align-items-center mx-auto mb-1">
                                        <!-- Review Stars Small-->
                                        <div class="rating position-relative d-table">
                                            <div class="position-absolute stars" style="width: 80%">
                                                <i class="ri-star-fill text-dark mr-1"></i>
                                                <i class="ri-star-fill text-dark mr-1"></i>
                                                <i class="ri-star-fill text-dark mr-1"></i>
                                                <i class="ri-star-fill text-dark mr-1"></i>
                                                <i class="ri-star-fill text-dark mr-1"></i>
                                            </div>
                                            <div class="stars">
                                                <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                                <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                                <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                                <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                                <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                            </div>
                                        </div> <span class="small fw-bolder ms-2 text-muted"> 4.2 (123)</span>
                                    </div>
                                    <a class="mb-0 mx-2 mx-md-4 fs-p link-cover text-decoration-none d-block text-center"
                                        href="./product.html">Mens Pennie II Waterproof Jacket</a>
                                    <p class="fw-bolder m-0 mt-2">$325.66</p>
                                </div>
                            </div>
                            <!--/ Card Product-->
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <!-- Card Product-->
                            <div class="card position-relative h-100 card-listing hover-trigger">
                                <div class="card-header">
                                    <picture class="position-relative overflow-hidden d-block bg-light">
                                        <img class="w-100 img-fluid position-relative z-index-10" title=""
                                            src="./assets/images/products/product-2.jpg"
                                            alt="Bootstrap 5 Template by Pixel Rocket">
                                    </picture>
                                    <div class="card-actions">
                                        <span
                                            class="small text-uppercase tracking-wide fw-bolder text-center d-block">Quick
                                            Add</span>
                                        <div class="d-flex justify-content-center align-items-center flex-wrap mt-3">
                                            <button class="btn btn-outline-dark btn-sm mx-2">S</button>
                                            <button class="btn btn-outline-dark btn-sm mx-2">M</button>
                                            <button class="btn btn-outline-dark btn-sm mx-2">L</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-0 text-center">
                                    <div class="d-flex justify-content-center align-items-center mx-auto mb-1">
                                        <!-- Review Stars Small-->
                                        <div class="rating position-relative d-table">
                                            <div class="position-absolute stars" style="width: 70%">
                                                <i class="ri-star-fill text-dark mr-1"></i>
                                                <i class="ri-star-fill text-dark mr-1"></i>
                                                <i class="ri-star-fill text-dark mr-1"></i>
                                                <i class="ri-star-fill text-dark mr-1"></i>
                                                <i class="ri-star-fill text-dark mr-1"></i>
                                            </div>
                                            <div class="stars">
                                                <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                                <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                                <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                                <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                                <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                            </div>
                                        </div> <span class="small fw-bolder ms-2 text-muted"> 4.5 (1289)</span>
                                    </div>
                                    <a class="mb-0 mx-2 mx-md-4 fs-p link-cover text-decoration-none d-block text-center"
                                        href="./product.html">Mens Storm Waterproof Jacket</a>
                                    <p class="fw-bolder m-0 mt-2">$499.99</p>
                                </div>
                            </div>
                            <!--/ Card Product-->
                        </div>
                    </div>
                </div>

                <div class="bg-dark p-4 text-white">
                    <p class="lead m-0">Didn't find what you are looking for? <a
                            class="transition-all opacity-50-hover text-white text-link-border border-white pb-1 border-2"
                            href="#">Send us a message.</a></p>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendor.bundle.js') }}"></script>
    <script src="{{ asset('frontend/js/theme.bundle.js') }}"></script>

    <script>
        $(function() {

            $('#showRegisterForm').on('click', function() {
                $('.registerBox').show();
                $('.loginBox').hide()
                $('.login-footer').hide()
                $('.register-footer').show()
                $('.forgotBox').hide();
                $('.verifyBox').hide();
                $('#login_title').html('註冊')
            })

            $('.showLoginForm').on('click', function() {
                $('.registerBox').hide();
                $('.loginBox').show()
                $('.login-footer').show()
                $('.register-footer').hide()
                $('.forgotBox').hide();
                $('.verifyBox').hide();
                $('#login_title').html('登入')
            })

            $('#showForgotForm').on('click', function() {
                $('.registerBox').hide();
                $('.loginBox').hide()
                $('.login-footer').hide()
                $('.register-footer').hide()
                $('.verifyBox').hide();
                $('.forgotBox').show();
                $('#login_title').html('忘記密碼')
            })


            $('#showVerify').on('click', function() {
                $('.registerBox').hide();
                $('.loginBox').hide()
                $('.login-footer').hide()
                $('.register-footer').hide()
                $('.forgotBox').hide();
                $('.verifyBox').show();
                $('#login_title').html('重發驗證信')
            })

            $('#sign-up').on('click', function() {
                let error_msg = []
                let signup_username = $('#signup_username').val()
                let signup_email = $('#signup_email').val()
                let signup_password = $('#signup_password').val()
                let confirm_password = $('#confirm_password').val()

                if ($.trim(signup_username) == '') {
                    error_msg.push('會員名稱不能為空')
                }

                if ($.trim(signup_email) == '') {
                    error_msg.push("Email 一定要輸入")
                } else {
                    emailRule = /(\W|^)[\w.+\-]*@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/i;
                    if (!signup_email.match(emailRule)) {
                        error_msg.push("Email 格式不正確")
                    }
                }

                if ($.trim(signup_password) == '') {
                    error_msg.push("密碼一定要輸入")
                }

                if ($.trim(confirm_password) == '') {
                    error_msg.push("確認密碼一定要輸入")
                }

                if (signup_password != confirm_password) {
                    error_msg.push('密碼以及確認密碼不一致')
                }

                password_regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,30}$/

                if (signup_password.search(password_regex) == -1) {
                    error_msg.push("請輸入6 位以上，密碼必須包含大小寫字母以及數字組成")
                }

                if (error_msg.length > 0) {
                    alert(error_msg.join("\n"))
                } else {
                    $.post('/check_email', {
                        'email': signup_email,
                    }, function(item) {
                        if (item.code == 200) {
                            alert('Email 已經存在，請重新輸入')
                            $('#signup_username').val('')
                            $('#signup_email').val('')
                            $('#signup_password').val('')
                            $('#confirm_password').val('')
                        } else {
                            $('#form-signup').submit()
                        }
                    })
                }
            })

            $('#submit_login').on('click', function() {
                let error_msg = []
                let email = $('#email').val()
                let password = $('#password').val()


                if ($.trim(email) == '') {
                    error_msg.push('Email 一定要輸入')
                }

                if ($.trim(password) == '') {
                    error_msg.push('密碼一定要輸入')
                } else {
                    emailRule = /(\W|^)[\w.+\-]*@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
                    if (!email.match(emailRule)) {
                        error_msg.push("Email 格式不正確")
                    }
                }

                password_regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,30}$/

                if (password.search(password_regex) == -1) {
                    error_msg.push("請輸入6 位以上，密碼必須包含大小寫字母以及數字組成")
                }

                if (error_msg.length > 0) {
                    alert(error_msg.join("\n"))
                } else {
                    $('#form_login').submit()
                }
            })

            $('#reset_submit').on('click', function(event) {
                let error_msg = []
                let email = $('#reset_email').val()

                if ($.trim(email) == '') {
                    error_msg.push('Email 一定要輸入')
                } else {
                    emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
                    if (!email.match(emailRule)) {
                        error_msg.push("Email 格式不正確")
                    }
                }

                if (error_msg.length > 0) {
                    alert(error_msg.join("\n"))
                } else {
                    $('#form-reset').submit()
                }
            })

            $('#verify_submit').on('click', function(event) {
                let error_msg = []
                let email = $('#verify_email').val()

                if ($.trim(email) == '') {
                    error_msg.push('Email 一定要輸入')
                } else {
                    emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
                    if (!email.match(emailRule)) {
                        error_msg.push("Email 格式不正確")
                    }
                }

                if (error_msg.length > 0) {
                    alert(error_msg.join("\n"))
                } else {
                    $('#form-verify').submit()
                }
            })

        })
    </script>

    <script>
        @if (Session::has('message'))
            alert("{{ Session::get('message') }}");
        @endif
    </script>

    @yield('js')
</body>

</html>
