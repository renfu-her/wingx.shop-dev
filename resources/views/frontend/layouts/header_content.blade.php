<div class="w-100 pb-lg-0 pt-lg-0 pt-4 pb-3">
    <div class="container-fluid d-flex justify-content-between align-items-center flex-wrap">

        <div class="d-flex align-items-center me-2 lh-1 width-percent" style="cursor: pointer"
            onclick="location.href='/'">
            <img src="{{ asset('frontend/images/logos/logo_c.svg') }}" style="width: 100% " alt="">
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
                    <a class="nav-link fw-bolder py-lg-4" href="/contact-us">
                        聯絡我們
                    </a>
                </li>

                <li class="nav-item dropdown me-lg-4">
                    <a class="nav-link fw-bolder py-lg-4" href="/qa">
                        知識百科
                    </a>
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

            {{-- <li class="ms-1 d-inline-block">
                <button class="btn btn-link px-2 text-decoration-none d-flex align-items-center"
                    data-pr-search>
                    <i class="ri-search-2-line ri-lg align-middle"></i>
                </button>
            </li> --}}

            @if (Session::has('member_id'))
                <!-- 使用者登登出 -->
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
                <!-- 使用者登入, modal -->
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
