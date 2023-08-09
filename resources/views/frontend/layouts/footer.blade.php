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
                                <li class="mb-2"><a
                                        class="text-decoration-none text-white opacity-75 opacity-25-hover transition-all"
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
                                    href="#">商店介紹</a>
                            </li>
                            <li class="mb-2"><a
                                    class="text-decoration-none text-white opacity-75 opacity-25-hover transition-all"
                                    href="#">購物流程</a>
                            </li>
                            <li class="mb-2"><a
                                    class="text-decoration-none text-white opacity-75 opacity-25-hover transition-all"
                                    href="#">會員制度</a>
                            </li>
                            <li class="mb-2"><a
                                    class="text-decoration-none text-white opacity-75 opacity-25-hover transition-all"
                                    href="#">退換貨方式</a>
                            </li>
                            <li class="mb-2"><a
                                    class="text-decoration-none text-white opacity-75 opacity-25-hover transition-all"
                                    href="{{ url('privacy') }}">隱私權政策</a>
                            </li>

                        </ul>
                    </nav>

                </div>
                <div
                    class="border-top-white-opacity justify-content-between flex-column flex-md-row align-items-center d-flex pt-6 mt-6 px-0">
                    <p class="small opacity-75">&copy; 2023 WingX All Rights Reserved.</p>
                    <nav>
                        <ul class="list-unstyled">
                            {{-- <li class="d-inline-block me-1 bg-white rounded px-2 pt-1">
                                <i class="pi pi-paypal pi-sm"></i></li> --}}
                            <li class="d-inline-block me-1 bg-white rounded px-2 pt-1">
                                <i class="pi pi-mastercard pi-sm"></i>
                            </li>
                            {{-- <li class="d-inline-block me-1 bg-white rounded px-2 pt-1">
                                <i class="pi pi-american-express pi-sm"></i></li> --}}
                            <li class="d-inline-block bg-white rounded px-2 pt-1">
                                <i class="pi pi-visa pi-sm"></i>
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
