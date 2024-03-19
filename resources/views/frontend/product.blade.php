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
    <!-- Main Section-->
    <section class="mt-5 ">
        <!-- Page Content Goes Here -->

        <!-- Product Top-->
        <section class="container">

            <!-- Breadcrumbs-->
            {{-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">首頁</a></li>
                    <li class="breadcrumb-item"><a
                            href="/category/{{ $product_category->id }}">{{ $product_category->name }}</a></li>
                </ol>
            </nav> <!-- /Breadcrumbs--> --}}

            <div class="row g-5">

                <!-- Images Section-->
                <div class="col-12 col-lg-7">
                    <div class="fotorama" data-nav="thumbs">
                        @foreach ($product_images as $product_image)
                            <img src="{{ $product_image->image_url }}" alt="">
                        @endforeach
                    </div>
                </div>
                <!-- /Images Section-->

                <!-- Product Info Section-->
                <div class="col-12 col-lg-5">
                    <div class="pb-3">

                        <!-- Product Name, Review, Brand, Price-->
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <p class="small fw-bolder text-uppercase tracking-wider text-muted mb-0 lh-1">
                                {{ $product_category->name }}
                            </p>
                        </div>
                        <h1 class="mb-2 fs-2 fw-bold">{{ $product->name }}</h1>
                        <div class="d-flex justify-content-start align-items-center">
                            <p class="lead fw-bolder m-0 fs-3 lh-1 text-danger me-2 product-cart price-origin">
                                $ {{ $product->price }}
                            </p>
                            <p class="lead fw-bolder m-0 fs-3 lh-1 text-danger me-2 product-cart price-json-post"
                                style="display: none">

                            </p>
                        </div>

                        <!-- Product Options-->
                        @if ($productTitleOne != null)
                            <div class="border-top mt-4 mb-3">
                                <div class="product-option mb-4 mt-4 ">
                                    <small class="text-uppercase d-block fw-bolder mb-2">
                                        {{ $productTitleOne->name }} :
                                    </small>
                                    <div class="">
                                        <div clas="buts btns d-flex justify-content-start flex-wrap blue">
                                            <div class="checkbox_resource resource-top">
                                                @foreach ($productDetailOne as $option)
                                                    <label>
                                                        <input type="radio" name="options1" value="{{ $option->id }}"
                                                            onchange="priceOne()">
                                                        <span class="round button">{{ $option->name }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($productTitleTwo != null)
                            <div class="border-top mt-4 mb-3">
                                <div class="product-option mb-4 mt-4 ">
                                    <small class="text-uppercase d-block fw-bolder mb-2">
                                        {{ $productTitleTwo->name }} :
                                    </small>
                                    <div class="">
                                        <div clas="buts btns d-flex justify-content-start flex-wrap blue">
                                            <div class="checkbox_resource resource-top">
                                                @foreach ($productDetailTwo as $option)
                                                    <label>
                                                        <input type="radio" name="options2" value="{{ $option->id }}"
                                                            onchange="priceTwo()">
                                                        <span class="round button">{{ $option->name }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endif
                        <!-- /Product Options-->

                        <div class="border-top mt-4 mb-3">
                            <div class="product-option mb-4 mt-4 ">
                                <small class="text-uppercase d-block fw-bolder mb-2">
                                    數量 :
                                </small>
                                <div class="">
                                    <button class="decrement">-</button>
                                    <input type="number" min="1" value="1" class="product-qty">
                                    <button class="increment">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Add To Cart-->
                        <div class="d-flex justify-content-between mt-3">
                            <input type="hidden" id="dataBase" value="product">
                            <input type="hidden" id="items">
                            <input type="hidden" id="price" value="{{ $product->price }}">
                            <input type="hidden" id="prod_id" value="{{ $product->id }}">
                            @if ($product->store_number <= 0)
                                <div class="flex-grow-1 me-2 text-white d-flex align-items-center justify-content-center"
                                    style="background-color: gray;">無法訂購</div>
                            @else
                                <button class="btn btn-dark btn-dark-chunky flex-grow-1 me-2 text-white"
                                    onclick="cart()">加入購物車</button>
                            @endif
                            <button class="btn btn-orange btn-orange-chunky"><i class="ri-heart-line"></i></button>
                        </div>
                        <!-- /Add To Cart-->

                        <!-- Socials-->
                        <div class="my-4">
                            <div class="d-flex justify-content-start align-items-center">
                                <p class="fw-bolder lh-1 mb-0 me-3">分享</p>
                                <ul class="list-unstyled p-0 m-0 d-flex justify-content-start lh-1 align-items-center mt-1">
                                    <li class="me-2">
                                        <a class="text-decoration-none"
                                            href="https://www.facebook.com/sharer.php?u={{ url('/product/' . $product_id) }}"
                                            role="button">
                                            <i class="fa-brands fa-facebook"></i></a>
                                    </li>
                                    <li class="me-2"><a class="text-decoration-none"
                                            href="http://line.naver.jp/R/msg/text/?{{ url('/product/' . $product_id) }}"
                                            role="button">
                                            <i class="fa-brands fa-line"></i></a>
                                    </li>
                                    <li class="me-2"><a class="text-decoration-none"
                                            href="https://twitter.com/share?text={{ $product->name }}&url={{ url('/product/' . $product_id) }}"
                                            role="button">
                                            <i class="fa-brands fa-twitter"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Socials-->

                        <!-- Special Offers-->
                        <div class="bg-light rounded py-2 px-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex border-0 px-0 bg-transparent">
                                    <i class="ri-truck-line"></i>
                                    <span class="fs-6 ms-3">運費：中華郵政 $80。 宅配 $150。</span>
                                </li>
                            </ul>
                        </div>
                        <!-- /Special Offers-->

                    </div>
                </div>
                <!-- / Product Info Section-->
            </div>
        </section>
        <!-- / Product Top-->

        <section>

            <!-- Product Tabs-->
            <div class="mt-7 pt-5 border-top">
                <div class="container">
                    <!-- Tab Nav-->
                    <ul class="nav justify-content-center nav-tabs nav-tabs-border mb-4" id="myTab" role="tablist">
                        <li class="nav-item w-100 mb-2 mb-sm-0 w-sm-auto mx-sm-3" role="presentation">
                            <a class="nav-link fs-5 fw-bolder nav-link-underline mx-sm-3 px-0 active" id="details-tab"
                                data-bs-toggle="tab" href="#details" role="tab" aria-controls="details"
                                aria-selected="true">詳細資料</a>
                        </li>
                    </ul>
                    <!-- / Tab Nav-->

                    <!-- Tab Content-->
                    <div class="tab-content" id="myTabContent">

                        <!-- Tab Details Content-->
                        <div class="tab-pane fade show active py-5" id="details" role="tabpanel"
                            aria-labelledby="details-tab">
                            <div class="col-12 col-lg-10 mx-auto">
                                <div class="row g-5">
                                    <div class="col-12 col-md-9 offset-md-3 ">
                                        <p>{!! nl2br($product->description) !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- / Tab Content-->
                </div>
            </div>
            <!-- / Product Tabs-->

        </section>

    </section>
    <!-- / Main Section-->
@endsection

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    <style>
        input[type="radio"] {
            display: none;
        }
    </style>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
    <script>
        let options1 = 0;
        let options2 = 0;

        $(function() {

            $('.increment').click(function() {
                var currentVal = parseInt($(this).siblings('.product-qty').val(), 10);
                $(this).siblings('.product-qty').val(currentVal + 1);
            });

            $('.decrement').click(function() {
                var currentVal = parseInt($(this).siblings('.product-qty').val(), 10);
                if (currentVal > 1) { // Ensure the value doesn't go below 1
                    $(this).siblings('.product-qty').val(currentVal - 1);
                }
            });
        })

        const selectItem = (dataBase, prod_id, price) => {

            $('#dataBase').val(dataBase)
            $('#prod_id').val(prod_id)
            $('#price').val(price)

        }

        const cart = () => {

            let opt1 = 0;
            let opt2 = 0;
            let opt1Checked = false;
            let opt2Checked = false;

            if ($('input[name="options1"]').length > 0) {
                opt1Checked = true
                opt1 = $('input[name="options1"]:checked').length;
            }
            if ($('input[name="options2"]').length > 0) {
                opt2Checked = true
                opt2 = $('input[name="options2"]:checked').length;
            }

            if (opt1 == 0 && opt1Checked == true) {
                alert('沒有選擇商品規格');
                return false
            }

            if (opt2 == 0 && opt2Checked == true) {
                alert('沒有選擇商品規格');
                return false;
            }

            let qty = $('.product-qty').val()
            let price = $('#price').val()
            let prod_id = $('#prod_id').val()
            let dataBase = $('#dataBase').val()
            let items = $('#items').val();

            if (prod_id == '') {
                alert('目前沒有選擇商品')
                return
            }

            if (qty == 0) {
                alert('數量必須大於 0')
                return
            }

            $.post('/cart/order', {
                id: prod_id,
                dataBase: dataBase,
                prod_id: prod_id,
                price: price,
                qty: qty,
                items: items
            }, function(data) {
                if (data.status == 'success') {
                    alert('加入購物車成功')
                    location.reload()
                } else {
                    alert('加入購物車失敗')
                }
            })

        }


        const priceOne = () => {
            options1 = $('input[name="options1"]:checked').val()
            priceGet()
        }

        const priceTwo = () => {
            options2 = $('input[name="options2"]:checked').val()
            priceGet()
        }

        const priceGet = () => {
            $.post('/price/get', {
                'product_id': '{{ $product->id }}',
                'options1': options1,
                'options2': options2
            }, function(items) {
                $('#price').val(items.price)
                $('#items').val(items.items)
                $('.price-json-post').html('$ ' + items.price).show()
                $('.price-origin').hide()
            })
        }
    </script>
@endsection
