@extends('frontend.layouts.master')

@section('content')
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom mx-0 p-0 flex-column  border-0">
        <div class="w-100 pb-lg-0 pt-lg-0 pt-4 pb-3">
            <div class="container-fluid d-flex justify-content-between align-items-center flex-wrap">

                <!-- Logo-->
                <a class="navbar-brand fw-bold fs-3 m-0 p-0 flex-shrink-0" href="./index.html">
                    <!-- Start of Logo-->
                    <div class="d-flex align-items-center">
                        <div class="f-w-6 d-flex align-items-center me-2 lh-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 194 194">
                                <path fill="currentColor" class="svg-logo-white"
                                    d="M47.45,60l1.36,27.58,53.41-51.66,50.87,50,3.84-26L194,100.65V31.94A31.94,31.94,0,0,0,162.06,0H31.94A31.94,31.94,0,0,0,0,31.94v82.57Z" />
                                <path fill="currentColor" class="svg-logo-dark"
                                    d="M178.8,113.19l1,34.41L116.3,85.92l-14.12,15.9L88.07,85.92,24.58,147.53l.93-34.41L0,134.86v27.2A31.94,31.94,0,0,0,31.94,194H162.06A31.94,31.94,0,0,0,194,162.06V125.83Z" />
                            </svg>
                        </div> <span class="fs-5">Alpine</span>
                    </div>
                    <!-- / Logo-->

                </a>
                <!-- / Logo-->

                <!-- Main Navigation-->
                <div class="ms-5 flex-shrink-0 collapse navbar-collapse navbar-collapse-light w-auto flex-grow-1"
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
                        <li class="nav-item me-lg-4 dropdown position-static">
                            <a class="nav-link fw-bolder dropdown-toggle py-lg-4" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Menswear
                            </a>
                            <!-- Menswear dropdown menu-->
                            <div class="dropdown-menu dropdown-megamenu">
                                <div class="container">
                                    <div class="row g-0">
                                        <!-- Dropdown Menu Links Section-->
                                        <div class="col-12 col-lg-7">
                                            <div class="row py-lg-5">

                                                <!-- menu row-->
                                                <div class="col col-lg-6 mb-5 mb-sm-0">
                                                    <h6 class="dropdown-heading">Waterproof Layers</h6>
                                                    <ul class="list-unstyled">
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Waterproof
                                                                Jackets</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Insulated
                                                                Jackets</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Down
                                                                Jackets</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Softshell
                                                                Jackets</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Casual
                                                                Jackets</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Windproof
                                                                Jackets</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Breathable
                                                                Jackets</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Cleaning &
                                                                Proofing</a></li>
                                                        <li class="dropdown-list-item"><a
                                                                class="dropdown-item dropdown-link-all"
                                                                href="./category.html">View All</a></li>
                                                    </ul>

                                                </div>
                                                <!-- /menu row-->

                                                <!-- menu row-->
                                                <div class="col col-lg-6">
                                                    <h6 class="dropdown-heading">Brands</h6>
                                                    <ul class="list-unstyled">
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Lifestyle &
                                                                Casual</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Walking
                                                                Shoes</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Running
                                                                Shoes</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Military
                                                                Boots</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Fabric Walking
                                                                Boots</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Leather
                                                                Walking Boots</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Wellies</a>
                                                        </li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Winter
                                                                Footwear</a></li>
                                                        <li class="dropdown-list-item"><a
                                                                class="dropdown-item dropdown-link-all"
                                                                href="./category.html">View All</a></li>
                                                    </ul>
                                                </div>
                                                <!-- /menu row-->

                                            </div>
                                        </div>
                                        <!-- /Dropdown Menu Links Section-->

                                        <!-- Dropdown Menu Images Section-->
                                        <div class="d-none d-lg-block col-lg-5">
                                            <div class="vw-50 h-100 bg-img-cover bg-pos-center-center position-absolute"
                                                style="background-image: url(./assets/images/banners/banner-2.jpg);"></div>
                                        </div>
                                        <!-- Dropdown Menu Images Section-->
                                    </div>
                                </div>
                            </div>
                            <!-- / Menswear dropdown menu-->
                        </li>
                        <li class="nav-item me-lg-4 dropdown position-static">
                            <a class="nav-link fw-bolder dropdown-toggle py-lg-4" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Womenswear
                            </a>
                            <!-- Womenswear dropdown menu-->
                            <div class="dropdown-menu dropdown-megamenu">
                                <div class="container">
                                    <div class="row g-0">
                                        <!-- Dropdown Menu Links Section-->
                                        <div class="col-12 col-lg-7">
                                            <div class="row py-lg-5">

                                                <!-- menu row-->
                                                <div class="col col-lg-6 mb-5 mb-sm-0">
                                                    <h6 class="dropdown-heading">Waterproof Layers</h6>
                                                    <ul class="list-unstyled">
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Waterproof
                                                                Jackets</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Insulated
                                                                Jackets</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Down
                                                                Jackets</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Softshell
                                                                Jackets</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Casual
                                                                Jackets</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Windproof
                                                                Jackets</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Breathable
                                                                Jackets</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Cleaning &
                                                                Proofing</a></li>
                                                        <li class="dropdown-list-item"><a
                                                                class="dropdown-item dropdown-link-all"
                                                                href="./category.html">View All</a></li>
                                                    </ul>

                                                </div>
                                                <!-- /menu row-->

                                                <!-- menu row-->
                                                <div class="col col-lg-6">
                                                    <h6 class="dropdown-heading">Brands</h6>
                                                    <ul class="list-unstyled">
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Lifestyle &
                                                                Casual</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Walking
                                                                Shoes</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Running
                                                                Shoes</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Military
                                                                Boots</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Fabric Walking
                                                                Boots</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Leather
                                                                Walking Boots</a></li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Wellies</a>
                                                        </li>
                                                        <li class="dropdown-list-item"><a class="dropdown-item"
                                                                href="./category.html">Winter
                                                                Footwear</a></li>
                                                        <li class="dropdown-list-item"><a
                                                                class="dropdown-item dropdown-link-all"
                                                                href="./category.html">View All</a></li>
                                                    </ul>
                                                </div>
                                                <!-- /menu row-->

                                            </div>
                                        </div>
                                        <!-- /Dropdown Menu Links Section-->

                                        <!-- Dropdown Menu Images Section-->
                                        <div class="d-none d-lg-block col-lg-5">
                                            <div class="vw-50 h-100 bg-img-cover bg-pos-center-center position-absolute"
                                                style="background-image: url(./assets/images/banners/banner-4.jpg);"></div>
                                        </div>
                                        <!-- Dropdown Menu Images Section-->
                                    </div>
                                </div>
                            </div>
                            <!-- / Womenswear dropdown menu-->
                        </li>
                        <li class="nav-item me-lg-4">
                            <a class="nav-link fw-bolder py-lg-4" href="#">
                                Kidswear
                            </a>
                        </li>
                        <li class="nav-item me-lg-4">
                            <a class="nav-link fw-bolder py-lg-4" href="#">
                                Sale Items
                            </a>
                        </li>
                        <li class="nav-item dropdown me-lg-4">
                            <a class="nav-link fw-bolder dropdown-toggle py-lg-4" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Demo Pages
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="./index.html">Homepage</a></li>
                                <li><a class="dropdown-item" href="./category.html">Category</a></li>
                                <li><a class="dropdown-item" href="./product.html">Product</a></li>
                                <li><a class="dropdown-item" href="./cart.html">Cart</a></li>
                                <li><a class="dropdown-item" href="./checkout.html">Checkout</a></li>
                            </ul>
                        </li>
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

                    <!-- Navbar Wishlist-->
                    <li class="ms-1 d-none d-lg-inline-block">
                        <a class="btn btn-link px-2 py-0 text-decoration-none d-flex align-items-center" href="#">
                            <i class="ri-heart-line ri-lg align-middle"></i>
                        </a>
                    </li>
                    <!-- /Navbar Wishlist-->

                    <!-- Navbar Login-->
                    <li class="ms-1 d-none d-lg-inline-block">
                        <a class="btn btn-link px-2 text-decoration-none d-flex align-items-center" href="#">
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
                                class="fs-xs fw-bolder f-w-5 f-h-5 bg-orange rounded-lg d-block lh-1 pt-1 position-absolute top-0 end-0 z-index-20 mt-2 text-white">2</span>
                        </button>
                    </li>
                    <!-- /Navbar Cart-->

                </ul>
                <!-- Navbar Icons-->

            </div>
        </div>
    </nav>
    <!-- / Navbar-->
    <!-- / Navbar-->

    <!-- Main Section-->
    <section class="mt-0 ">

        <!-- Category Top Banner -->
        <div class="py-6 bg-img-cover bg-dark bg-overlay-gradient-dark position-relative overflow-hidden mb-4 bg-pos-center-center"
            style="background-image: url(./assets/images/banners/banner-1.jpg);">
            <div class="container position-relative z-index-20" data-aos="fade-right" data-aos-delay="300">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item breadcrumb-light"><a href="#">Home</a></li>
                        <li class="breadcrumb-item breadcrumb-light"><a href="#">Activities</a></li>
                        <li class="breadcrumb-item active breadcrumb-light" aria-current="page">Clothing</li>
                    </ol>
                </nav>
                <h1 class="fw-bold display-6 mb-4 text-white">Latest Arrivals (121)</h1>
                <div class="col-12 col-md-6">
                    <p class="lead text-white mb-0">
                        Move, stretch, jump and hike in our latest waterproof arrivals. We've got you covered for your
                        hike or climbing sessions, from Gortex jackets to lightweight waterproof pants. Discover our
                        latest range of outdoor clothing.
                    </p>
                </div>
            </div>
        </div>
        <!-- Category Top Banner -->

        <div class="container">

            <div class="row">

                <!-- Category Aside/Sidebar -->
                <div class="d-none d-lg-flex col-lg-3">
                    <div class="pe-4">
                        <!-- Category Aside -->
                        <aside>

                            <!-- Filter Category -->
                            <div class="mb-4">
                                <h2 class="mb-4 fs-6 mt-2 fw-bolder">Jacket Category</h2>
                                <nav>
                                    <ul class="list-unstyled list-default-text">
                                        <li class="mb-2"><a
                                                class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center"
                                                href="#"><span><i
                                                        class="ri-arrow-right-s-line align-bottom ms-n1"></i> Waterproof
                                                    Jackets</span> <span class="text-muted ms-4">(21)</span></a>
                                        </li>
                                        <li class="mb-2"><a
                                                class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center"
                                                href="#"><span><i
                                                        class="ri-arrow-right-s-line align-bottom ms-n1"></i> Down
                                                    Jackets</span> <span class="text-muted ms-4">(13)</span></a>
                                        </li>
                                        <li class="mb-2"><a
                                                class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center"
                                                href="#"><span><i
                                                        class="ri-arrow-right-s-line align-bottom ms-n1"></i> Windproof
                                                    Jackets</span> <span class="text-muted ms-4">(18)</span></a>
                                        </li>
                                        <li class="mb-2"><a
                                                class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center"
                                                href="#"><span><i
                                                        class="ri-arrow-right-s-line align-bottom ms-n1"></i> Hiking
                                                    Jackets</span> <span class="text-muted ms-4">(25)</span></a>
                                        </li>
                                        <li class="mb-2"><a
                                                class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center"
                                                href="#"><span><i
                                                        class="ri-arrow-right-s-line align-bottom ms-n1"></i> Climbing
                                                    Jackets</span> <span class="text-muted ms-4">(11)</span></a>
                                        </li>
                                        <li class="mb-2"><a
                                                class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center"
                                                href="#"><span><i
                                                        class="ri-arrow-right-s-line align-bottom ms-n1"></i> Trekking
                                                    Jackets</span> <span class="text-muted ms-4">(19)</span></a>
                                        </li>
                                        <li class="mb-2"><a
                                                class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center"
                                                href="#"><span><i
                                                        class="ri-arrow-right-s-line align-bottom ms-n1"></i> Allround
                                                    Jackets</span> <span class="text-muted ms-4">(24)</span></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- / Filter Category-->

                            <!-- Price Filter -->
                            <div class="py-4 widget-filter widget-filter-price border-top">
                                <a class="small text-body text-decoration-none text-secondary-hover transition-all transition-all fs-6 fw-bolder d-block collapse-icon-chevron"
                                    data-bs-toggle="collapse" href="#filter-price" role="button" aria-expanded="true"
                                    aria-controls="filter-price">
                                    Price
                                </a>
                                <div id="filter-price" class="collapse show">
                                    <div class="filter-price mt-6"></div>
                                    <div class="d-flex justify-content-between align-items-center mt-7">
                                        <div class="input-group mb-0 me-2 border">
                                            <span
                                                class="input-group-text bg-transparent fs-7 p-2 text-muted border-0">$</span>
                                            <input type="number" min="00" max="1000" step="1"
                                                class="filter-min form-control-sm border flex-grow-1 text-muted border-0">
                                        </div>
                                        <div class="input-group mb-0 ms-2 border">
                                            <span
                                                class="input-group-text bg-transparent fs-7 p-2 text-muted border-0">$</span>
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
                                    data-bs-toggle="collapse" href="#filter-brands" role="button" aria-expanded="true"
                                    aria-controls="filter-brands">
                                    Brands
                                </a>
                                <div id="filter-brands" class="collapse show">
                                    <div class="input-group my-3 py-1">
                                        <input type="text" class="form-control py-2 filter-search rounded"
                                            placeholder="Search" aria-label="Search">
                                        <span
                                            class="input-group-text bg-transparent px-2 position-absolute top-7 end-0 border-0 z-index-20"><i
                                                class="ri-search-2-line text-muted"></i></span>
                                    </div>
                                    <div class="simplebar-wrapper">
                                        <div class="filter-options" data-pixr-simplebar>
                                            <div class="form-group form-check mb-0">
                                                <input type="checkbox" class="form-check-input" id="filter-brand-0">
                                                <label
                                                    class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                    for="filter-brand-0">Adidas <span
                                                        class="text-muted">(21)</span></label>
                                            </div>
                                            <div class="form-group form-check mb-0">
                                                <input type="checkbox" class="form-check-input" id="filter-brand-1">
                                                <label
                                                    class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                    for="filter-brand-1">Asics <span
                                                        class="text-muted">(13)</span></label>
                                            </div>
                                            <div class="form-group form-check mb-0">
                                                <input type="checkbox" class="form-check-input" id="filter-brand-2">
                                                <label
                                                    class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                    for="filter-brand-2">Canterbury <span
                                                        class="text-muted">(18)</span></label>
                                            </div>
                                            <div class="form-group form-check mb-0">
                                                <input type="checkbox" class="form-check-input" id="filter-brand-3">
                                                <label
                                                    class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                    for="filter-brand-3">Converse <span
                                                        class="text-muted">(25)</span></label>
                                            </div>
                                            <div class="form-group form-check mb-0">
                                                <input type="checkbox" class="form-check-input" id="filter-brand-4">
                                                <label
                                                    class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                    for="filter-brand-4">Donnay <span
                                                        class="text-muted">(11)</span></label>
                                            </div>
                                            <div class="form-group form-check mb-0">
                                                <input type="checkbox" class="form-check-input" id="filter-brand-5">
                                                <label
                                                    class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                    for="filter-brand-5">Nike <span class="text-muted">(19)</span></label>
                                            </div>
                                            <div class="form-group form-check mb-0">
                                                <input type="checkbox" class="form-check-input" id="filter-brand-6">
                                                <label
                                                    class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                    for="filter-brand-6">Millet <span
                                                        class="text-muted">(24)</span></label>
                                            </div>
                                            <div class="form-group form-check mb-0">
                                                <input type="checkbox" class="form-check-input" id="filter-brand-7">
                                                <label
                                                    class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                    for="filter-brand-7">Puma <span class="text-muted">(11)</span></label>
                                            </div>
                                            <div class="form-group form-check mb-0">
                                                <input type="checkbox" class="form-check-input" id="filter-brand-8">
                                                <label
                                                    class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                    for="filter-brand-8">Reebok <span
                                                        class="text-muted">(19)</span></label>
                                            </div>
                                            <div class="form-group form-check mb-0">
                                                <input type="checkbox" class="form-check-input" id="filter-brand-9">
                                                <label
                                                    class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                    for="filter-brand-9">Under Armour <span
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
                                    data-bs-toggle="collapse" href="#filter-type" role="button" aria-expanded="true"
                                    aria-controls="filter-type">
                                    Type
                                </a>
                                <div id="filter-type" class="collapse show">
                                    <div class="input-group my-3 py-1">
                                        <input type="text" class="form-control py-2 filter-search rounded"
                                            placeholder="Search" aria-label="Search">
                                        <span
                                            class="input-group-text bg-transparent px-2 position-absolute top-7 end-0 border-0 z-index-20"><i
                                                class="ri-search-2-line text-muted"></i></span>
                                    </div>
                                    <div class="filter-options">
                                        <div class="form-group form-check mb-0">
                                            <input type="checkbox" class="form-check-input" id="filter-type-0">
                                            <label
                                                class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                for="filter-type-0">Slip On </label>
                                        </div>
                                        <div class="form-group form-check mb-0">
                                            <input type="checkbox" class="form-check-input" id="filter-type-1">
                                            <label
                                                class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                for="filter-type-1">Strap Up </label>
                                        </div>
                                        <div class="form-group form-check mb-0">
                                            <input type="checkbox" class="form-check-input" id="filter-type-2">
                                            <label
                                                class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                for="filter-type-2">Zip Up </label>
                                        </div>
                                        <div class="form-group form-check mb-0">
                                            <input type="checkbox" class="form-check-input" id="filter-type-3">
                                            <label
                                                class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                for="filter-type-3">Toggle </label>
                                        </div>
                                        <div class="form-group form-check mb-0">
                                            <input type="checkbox" class="form-check-input" id="filter-type-4">
                                            <label
                                                class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                for="filter-type-4">Auto </label>
                                        </div>
                                        <div class="form-group form-check mb-0">
                                            <input type="checkbox" class="form-check-input" id="filter-type-5">
                                            <label
                                                class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                for="filter-type-5">Click </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- / Type Filter -->

                            <!-- Sizes Filter -->
                            <div class="py-4 widget-filter border-top">
                                <a class="small text-body text-decoration-none text-secondary-hover transition-all transition-all fs-6 fw-bolder d-block collapse-icon-chevron"
                                    data-bs-toggle="collapse" href="#filter-sizes" role="button" aria-expanded="true"
                                    aria-controls="filter-sizes">
                                    Sizes
                                </a>
                                <div id="filter-sizes" class="collapse show">
                                    <div class="filter-options mt-3">
                                        <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                            <input type="checkbox" class="form-check-bg-input" id="filter-sizes-0">
                                            <label class="form-check-label fw-normal" for="filter-sizes-0">6.5</label>
                                        </div>
                                        <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                            <input type="checkbox" class="form-check-bg-input" id="filter-sizes-1">
                                            <label class="form-check-label fw-normal" for="filter-sizes-1">7</label>
                                        </div>
                                        <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                            <input type="checkbox" class="form-check-bg-input" id="filter-sizes-2">
                                            <label class="form-check-label fw-normal" for="filter-sizes-2">7.5</label>
                                        </div>
                                        <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                            <input type="checkbox" class="form-check-bg-input" id="filter-sizes-3">
                                            <label class="form-check-label fw-normal" for="filter-sizes-3">8</label>
                                        </div>
                                        <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                            <input type="checkbox" class="form-check-bg-input" id="filter-sizes-4">
                                            <label class="form-check-label fw-normal" for="filter-sizes-4">8.5</label>
                                        </div>
                                        <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                            <input type="checkbox" class="form-check-bg-input" id="filter-sizes-5">
                                            <label class="form-check-label fw-normal" for="filter-sizes-5">9</label>
                                        </div>
                                        <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                            <input type="checkbox" class="form-check-bg-input" id="filter-sizes-6">
                                            <label class="form-check-label fw-normal" for="filter-sizes-6">9.5</label>
                                        </div>
                                        <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                            <input type="checkbox" class="form-check-bg-input" id="filter-sizes-7">
                                            <label class="form-check-label fw-normal" for="filter-sizes-7">10</label>
                                        </div>
                                        <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                            <input type="checkbox" class="form-check-bg-input" id="filter-sizes-8">
                                            <label class="form-check-label fw-normal" for="filter-sizes-8">10.5</label>
                                        </div>
                                        <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                            <input type="checkbox" class="form-check-bg-input" id="filter-sizes-9">
                                            <label class="form-check-label fw-normal" for="filter-sizes-9">11</label>
                                        </div>
                                        <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                                            <input type="checkbox" class="form-check-bg-input" id="filter-sizes-10">
                                            <label class="form-check-label fw-normal" for="filter-sizes-10">11.5</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- / Sizes Filter -->

                            <!-- Colour Filter -->
                            <div class="py-4 widget-filter border-top">
                                <a class="small text-body text-decoration-none text-secondary-hover transition-all transition-all fs-6 fw-bolder d-block collapse-icon-chevron"
                                    data-bs-toggle="collapse" href="#filter-colour" role="button" aria-expanded="true"
                                    aria-controls="filter-colour">
                                    Colour
                                </a>
                                <div id="filter-colour" class="collapse show">
                                    <div class="filter-options mt-3">
                                        <div
                                            class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-primary">
                                            <input type="checkbox" class="form-check-color-input" id="filter-colours-0">
                                            <label class="form-check-label" for="filter-colours-0"></label>
                                        </div>
                                        <div
                                            class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-success">
                                            <input type="checkbox" class="form-check-color-input" id="filter-colours-1">
                                            <label class="form-check-label" for="filter-colours-1"></label>
                                        </div>
                                        <div
                                            class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-danger">
                                            <input type="checkbox" class="form-check-color-input" id="filter-colours-2">
                                            <label class="form-check-label" for="filter-colours-2"></label>
                                        </div>
                                        <div
                                            class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-info">
                                            <input type="checkbox" class="form-check-color-input" id="filter-colours-3">
                                            <label class="form-check-label" for="filter-colours-3"></label>
                                        </div>
                                        <div
                                            class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-warning">
                                            <input type="checkbox" class="form-check-color-input" id="filter-colours-4">
                                            <label class="form-check-label" for="filter-colours-4"></label>
                                        </div>
                                        <div
                                            class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-dark">
                                            <input type="checkbox" class="form-check-color-input" id="filter-colours-5">
                                            <label class="form-check-label" for="filter-colours-5"></label>
                                        </div>
                                        <div
                                            class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-secondary">
                                            <input type="checkbox" class="form-check-color-input" id="filter-colours-6">
                                            <label class="form-check-label" for="filter-colours-6"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- / Colour Filter -->

                        </aside>
                        <!-- / Category Aside-->
                    </div>
                </div>
                <!-- / Category Aside/Sidebar -->

                <!-- Category Products-->
                <div class="col-12 col-lg-9">

                    <!-- Top Toolbar-->
                    <div class="mb-4 d-md-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-start align-items-center flex-grow-1 mb-4 mb-md-0">
                            <small class="d-inline-block fw-bolder">Filtered by:</small>
                            <ul class="list-unstyled d-inline-block mb-0 ms-2">
                                <li class="bg-light py-1 fw-bolder px-2 cursor-pointer d-inline-block me-1 small">Type:
                                    Slip On <i class="ri-close-circle-line align-bottom ms-1"></i></li>
                            </ul>
                            <span
                                class="fw-bolder text-muted-hover text-decoration-underline ms-2 cursor-pointer small">Clear
                                All</span>
                        </div>
                        <div class="d-flex align-items-center flex-column flex-md-row">
                            <!-- Filter Trigger-->
                            <button
                                class="btn bg-light p-3 d-flex d-lg-none align-items-center fs-xs fw-bold text-uppercase w-100 mb-2 mb-md-0 w-md-auto"
                                type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFilters"
                                aria-controls="offcanvasFilters">
                                <i class="ri-equalizer-line me-2"></i> Filters
                            </button>
                            <!-- / Filter Trigger-->
                            <div class="dropdown ms-md-2 lh-1 p-3 bg-light w-100 mb-2 mb-md-0 w-md-auto">
                                <p class="fs-xs fw-bold text-uppercase text-muted-hover p-0 m-0" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">Sort By <i
                                        class="ri-arrow-drop-down-line ri-lg align-bottom"></i></p>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item fs-xs fw-bold text-uppercase text-muted-hover mb-2"
                                            href="#">Price: Hi Low</a></li>
                                    <li><a class="dropdown-item fs-xs fw-bold text-uppercase text-muted-hover mb-2"
                                            href="#">Price: Low Hi</a></li>
                                    <li><a class="dropdown-item fs-xs fw-bold text-uppercase text-muted-hover mb-2"
                                            href="#">Name</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> <!-- / Top Toolbar-->

                    <!-- Products-->
                    <div class="row g-4 mb-5">
                        <div class="col-12 col-sm-6 col-md-4">
                            <!-- Card Product-->
                            <div class="card position-relative h-100 card-listing hover-trigger">
                                <div class="card-header">
                                    <picture class="position-relative overflow-hidden d-block bg-light">
                                        <img class="w-100 img-fluid position-relative z-index-10" title=""
                                            src="./assets/images/products/product-1.jpg" alt="">
                                    </picture>
                                    <picture class="position-absolute z-index-20 start-0 top-0 hover-show bg-light">
                                        <img class="w-100 img-fluid" title=""
                                            src="./assets/images/products/product-1b.jpg" alt="">
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
                                            <div class="position-absolute stars" style="width: 90%">
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
                                        </div> <span class="small fw-bolder ms-2 text-muted"> 4.7 (456)</span>
                                    </div>
                                    <a class="mb-0 mx-2 mx-md-4 fs-p link-cover text-decoration-none d-block text-center"
                                        href="./product.html">Full Zip Hoodie</a>
                                    <p class="fw-bolder m-0 mt-2">$1129.99</p>
                                </div>
                            </div>
                            <!--/ Card Product-->
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <!-- Card Product-->
                            <div class="card position-relative h-100 card-listing hover-trigger">
                                <span class="badge card-badge bg-secondary">-25%</span>
                                <div class="card-header">
                                    <picture class="position-relative overflow-hidden d-block bg-light">
                                        <img class="w-100 img-fluid position-relative z-index-10" title=""
                                            src="./assets/images/products/product-2.jpg" alt="">
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
                                            <div class="position-absolute stars" style="width: 60%">
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
                                        </div> <span class="small fw-bolder ms-2 text-muted"> 4.4 (1289)</span>
                                    </div>
                                    <a class="mb-0 mx-2 mx-md-4 fs-p link-cover text-decoration-none d-block text-center"
                                        href="./product.html">Mens Sherpa Hoodie</a>
                                    <div class="d-flex justify-content-center align-items-center mt-2">
                                        <p class="mb-0 me-2 text-danger fw-bolder">$<span>599.55</span></p>
                                        <p class="mb-0 text-muted fw-bolder"><s>$<span>150.00</span></s></p>
                                    </div>
                                </div>
                            </div>
                            <!--/ Card Product-->
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <!-- Card Product-->
                            <div class="card position-relative h-100 card-listing hover-trigger">
                                <span class="badge card-badge bg-secondary">-65%</span>
                                <div class="card-header">
                                    <picture class="position-relative overflow-hidden d-block bg-light">
                                        <img class="w-100 img-fluid position-relative z-index-10" title=""
                                            src="./assets/images/products/product-3.jpg" alt="">
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
                                            <div class="position-absolute stars" style="width: 20%">
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
                                        </div> <span class="small fw-bolder ms-2 text-muted"> 4.7 (754)</span>
                                    </div>
                                    <a class="mb-0 mx-2 mx-md-4 fs-p link-cover text-decoration-none d-block text-center"
                                        href="./product.html">Womens Essentials Hoodie</a>
                                    <div class="d-flex justify-content-center align-items-center mt-2">
                                        <p class="mb-0 me-2 text-danger fw-bolder">$<span>779.55</span></p>
                                        <p class="mb-0 text-muted fw-bolder"><s>$<span>1100.00</span></s></p>
                                    </div>
                                </div>
                            </div>
                            <!--/ Card Product-->
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <!-- Card Product-->
                            <div class="card position-relative h-100 card-listing hover-trigger">
                                <div class="card-header">
                                    <picture class="position-relative overflow-hidden d-block bg-light">
                                        <img class="w-100 img-fluid position-relative z-index-10" title=""
                                            src="./assets/images/products/product-4.jpg" alt="">
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
                                        </div> <span class="small fw-bolder ms-2 text-muted"> 4.4 (1289)</span>
                                    </div>
                                    <a class="mb-0 mx-2 mx-md-4 fs-p link-cover text-decoration-none d-block text-center"
                                        href="./product.html">Elevated Lined Hoodie</a>
                                    <p class="fw-bolder m-0 mt-2">$1829.99</p>
                                </div>
                            </div>
                            <!--/ Card Product-->
                        </div>
                        <div class="d-none d-md-flex col-md-8">
                            <div class="w-100 h-100 position-relative">
                                <div class="position-absolute w-50 h-100 start-0 bottom-0 top-0 bg-pos-center-center bg-img-cover"
                                    style="background-image: url(./assets/images/banners/banner-3.jpg);">
                                </div>
                                <div
                                    class="position-absolute w-50 h-100 bg-light end-0 top-0 bottom-0 d-flex justify-content-center align-items-center">
                                    <div class="px-4 text-center">
                                        <h4 class="fs-4 fw-bold mb-4">Built for adventure</h4>
                                        <p class="mb-4">The perfect grab-and-go layer for every hiking adventure</p>
                                        <a href="#" class="text-link-border border-2 pb-1 fw-bolder">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4">
                            <!-- Card Product-->
                            <div class="card position-relative h-100 card-listing hover-trigger">
                                <div class="card-header">
                                    <picture class="position-relative overflow-hidden d-block bg-light">
                                        <img class="w-100 img-fluid position-relative z-index-10" title=""
                                            src="./assets/images/products/product-1.jpg" alt="">
                                    </picture>
                                    <picture class="position-absolute z-index-20 start-0 top-0 hover-show bg-light">
                                        <img class="w-100 img-fluid" title=""
                                            src="./assets/images/products/product-1b.jpg" alt="">
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
                                            <div class="position-absolute stars" style="width: 90%">
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
                                        </div> <span class="small fw-bolder ms-2 text-muted"> 4.7 (456)</span>
                                    </div>
                                    <a class="mb-0 mx-2 mx-md-4 fs-p link-cover text-decoration-none d-block text-center"
                                        href="./product.html">Full Zip Hoodie</a>
                                    <p class="fw-bolder m-0 mt-2">$1129.99</p>
                                </div>
                            </div>
                            <!--/ Card Product-->
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <!-- Card Product-->
                            <div class="card position-relative h-100 card-listing hover-trigger">
                                <span class="badge card-badge bg-secondary">-25%</span>
                                <div class="card-header">
                                    <picture class="position-relative overflow-hidden d-block bg-light">
                                        <img class="w-100 img-fluid position-relative z-index-10" title=""
                                            src="./assets/images/products/product-2.jpg" alt="">
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
                                            <div class="position-absolute stars" style="width: 60%">
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
                                        </div> <span class="small fw-bolder ms-2 text-muted"> 4.4 (1289)</span>
                                    </div>
                                    <a class="mb-0 mx-2 mx-md-4 fs-p link-cover text-decoration-none d-block text-center"
                                        href="./product.html">Mens Sherpa Hoodie</a>
                                    <div class="d-flex justify-content-center align-items-center mt-2">
                                        <p class="mb-0 me-2 text-danger fw-bolder">$<span>599.55</span></p>
                                        <p class="mb-0 text-muted fw-bolder"><s>$<span>150.00</span></s></p>
                                    </div>
                                </div>
                            </div>
                            <!--/ Card Product-->
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <!-- Card Product-->
                            <div class="card position-relative h-100 card-listing hover-trigger">
                                <span class="badge card-badge bg-secondary">-65%</span>
                                <div class="card-header">
                                    <picture class="position-relative overflow-hidden d-block bg-light">
                                        <img class="w-100 img-fluid position-relative z-index-10" title=""
                                            src="./assets/images/products/product-3.jpg" alt="">
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
                                            <div class="position-absolute stars" style="width: 20%">
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
                                        </div> <span class="small fw-bolder ms-2 text-muted"> 4.7 (754)</span>
                                    </div>
                                    <a class="mb-0 mx-2 mx-md-4 fs-p link-cover text-decoration-none d-block text-center"
                                        href="./product.html">Womens Essentials Hoodie</a>
                                    <div class="d-flex justify-content-center align-items-center mt-2">
                                        <p class="mb-0 me-2 text-danger fw-bolder">$<span>779.55</span></p>
                                        <p class="mb-0 text-muted fw-bolder"><s>$<span>1100.00</span></s></p>
                                    </div>
                                </div>
                            </div>
                            <!--/ Card Product-->
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <!-- Card Product-->
                            <div class="card position-relative h-100 card-listing hover-trigger">
                                <div class="card-header">
                                    <picture class="position-relative overflow-hidden d-block bg-light">
                                        <img class="w-100 img-fluid position-relative z-index-10" title=""
                                            src="./assets/images/products/product-4.jpg" alt="">
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
                                        </div> <span class="small fw-bolder ms-2 text-muted"> 4.4 (1289)</span>
                                    </div>
                                    <a class="mb-0 mx-2 mx-md-4 fs-p link-cover text-decoration-none d-block text-center"
                                        href="./product.html">Elevated Lined Hoodie</a>
                                    <p class="fw-bolder m-0 mt-2">$1829.99</p>
                                </div>
                            </div>
                            <!--/ Card Product-->
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <!-- Card Product-->
                            <div class="card position-relative h-100 card-listing hover-trigger">
                                <div class="card-header">
                                    <picture class="position-relative overflow-hidden d-block bg-light">
                                        <img class="w-100 img-fluid position-relative z-index-10" title=""
                                            src="./assets/images/products/product-5.jpg" alt="">
                                    </picture>
                                    <picture class="position-absolute z-index-20 start-0 top-0 hover-show bg-light">
                                        <img class="w-100 img-fluid" title=""
                                            src="./assets/images/products/product-5b.jpg" alt="">
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
                                            <div class="position-absolute stars" style="width: 84%">
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
                                        </div> <span class="small fw-bolder ms-2 text-muted"> 4.8 (189)</span>
                                    </div>
                                    <a class="mb-0 mx-2 mx-md-4 fs-p link-cover text-decoration-none d-block text-center"
                                        href="./product.html">Mens Slab Hoodie</a>
                                    <p class="fw-bolder m-0 mt-2">$29.99</p>
                                </div>
                            </div>
                            <!--/ Card Product-->
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <!-- Card Product-->
                            <div class="card position-relative h-100 card-listing hover-trigger">
                                <div class="card-header">
                                    <picture class="position-relative overflow-hidden d-block bg-light">
                                        <img class="w-100 img-fluid position-relative z-index-10" title=""
                                            src="./assets/images/products/product-6.jpg" alt="">
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
                                            <div class="position-absolute stars" style="width: 60%">
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
                                        </div> <span class="small fw-bolder ms-2 text-muted"> 4.5 (1567)</span>
                                    </div>
                                    <a class="mb-0 mx-2 mx-md-4 fs-p link-cover text-decoration-none d-block text-center"
                                        href="./product.html">Blocked Striped Hoodie</a>
                                    <p class="fw-bolder m-0 mt-2">$1329.99</p>
                                </div>
                            </div>
                            <!--/ Card Product-->
                        </div>
                    </div>
                    <!-- / Products-->

                    <!-- Pagiation-->
                    <!-- Pagination-->
                    <nav class="border-top mt-5 pt-5 d-flex justify-content-between align-items-center"
                        aria-label="Category Pagination">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#"><i
                                        class="ri-arrow-left-line align-bottom"></i> Prev</a></li>
                        </ul>
                        <ul class="pagination">
                            <li class="page-item active mx-1"><a class="page-link" href="#">1</a></li>
                            <li class="page-item mx-1"><a class="page-link" href="#">2</a></li>
                            <li class="page-item mx-1"><a class="page-link" href="#">3</a></li>
                        </ul>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Next <i
                                        class="ri-arrow-right-line align-bottom"></i></a></li>
                        </ul>
                    </nav> <!-- / Pagination-->

                    <!-- Related Categories-->
                    <div class="border-top mt-5 pt-5">
                        <p class="lead fw-bolder">Related Categories</p>
                        <div class="d-flex flex-wrap justify-content-start align-items-center">
                            <a class="btn btn-sm btn-outline-dark rounded-pill me-2 mb-2 mb-md-0 text-white-hover"
                                href="#">Hiking
                                Shoes</a>
                            <a class="btn btn-sm btn-outline-dark rounded-pill me-2 mb-2 mb-md-0 text-white-hover"
                                href="#">Waterproof Trousers</a>
                            <a class="btn btn-sm btn-outline-dark rounded-pill me-2 mb-2 mb-md-0 text-white-hover"
                                href="#">Hiking
                                Shirts</a>
                            <a class="btn btn-sm btn-outline-dark rounded-pill me-2 mb-2 mb-md-0 text-white-hover"
                                href="#">Jackets</a>
                            <a class="btn btn-sm btn-outline-dark rounded-pill me-2 mb-2 mb-md-0 text-white-hover"
                                href="#">Gilets</a>
                            <a class="btn btn-sm btn-outline-dark rounded-pill me-2 mb-2 mb-md-0 text-white-hover"
                                href="#">Hiking
                                Socks</a>
                            <a class="btn btn-sm btn-outline-dark rounded-pill me-2 mb-2 mb-md-0 text-white-hover"
                                href="#">Rugsacks</a>
                        </div>
                    </div>
                    <!-- Related Categories-->

                </div>
                <!-- / Category Products-->

            </div>
        </div>

    </section>
    <!-- / Main Section-->
@endsection

@section('css')

@endsection

@section('js')

@endsection
