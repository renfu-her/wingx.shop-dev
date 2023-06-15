@extends('frontend.layouts.master')

@section('content')
    <!-- Main Section-->
    <section class="mt-5 ">
        <!-- Page Content Goes Here -->

        <!-- Product Top-->
        <section class="container">

            <!-- Breadcrumbs-->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">首頁</a></li>
                    <li class="breadcrumb-item"><a
                            href="/category/{{ $product_category->id }}">{{ $product_category->name }}</a></li>
                </ol>
            </nav> <!-- /Breadcrumbs-->

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
                            <p class="lead fw-bolder m-0 fs-3 lh-1 text-danger me-2 product-cart">$ {{ $product->price }}
                            </p>
                        </div>

                        <!-- Product Options-->
                        <div class="border-top mt-4 mb-3">
                            <div class="product-option mb-4 mt-4 ">
                                <small class="text-uppercase d-block fw-bolder mb-2">
                                    產品組合 :
                                </small>
                                <div class="">
                                    <div clas="buts btns d-flex justify-content-start flex-wrap blue">
                                        <div class="checkbox_resource resource-top">
                                            <label>
                                                <input type="radio" name="product_mix" value="{{ $product->price }}">
                                                <span class="round button"
                                                    onclick="selectItem('products', {{ $product->id }}, {{ $product->price }})">{{ $product->name }}</span>
                                            </label>
                                        </div>
                                    </div>
                                    @foreach ($productMix as $k => $v)
                                        <div clas="buts btns d-flex justify-content-start flex-wrap blue">
                                            <div class="checkbox_resource resource-top">
                                                <label>
                                                    <input type="radio" name="product_mix" value="{{ $v->price }}">
                                                    <span class="round button"
                                                        onclick="selectItem('product_mixes', {{ $v->id }}, {{ $v->price }})">{{ $v->product_name }}</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- /Product Options-->

                        <div class="border-top mt-4 mb-3">
                            <div class="product-option mb-4 mt-4 ">
                                <small class="text-uppercase d-block fw-bolder mb-2">
                                    數量 :
                                </small>
                                <div class="">
                                    <select class="form-select product-qty">
                                        @for ($i = 1; $i <= 50; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Add To Cart-->
                        <div class="d-flex justify-content-between mt-3">
                            <input type="hidden" id="dataBase">
                            <input type="hidden" id="price">
                            <input type="hidden" id="prod_id">
                            <button class="btn btn-dark btn-dark-chunky flex-grow-1 me-2 text-white"
                                onclick="cart()">加入購物車</button>
                            <button class="btn btn-orange btn-orange-chunky"><i class="ri-heart-line"></i></button>
                        </div>
                        <!-- /Add To Cart-->

                        <!-- Socials-->
                        <div class="my-4">
                            <div class="d-flex justify-content-start align-items-center">
                                <p class="fw-bolder lh-1 mb-0 me-3">分享</p>
                                <ul class="list-unstyled p-0 m-0 d-flex justify-content-start lh-1 align-items-center mt-1">
                                    <li class="me-2"><a class="text-decoration-none" href="#" role="button"><i
                                                class="ri-facebook-box-fill"></i></a></li>
                                    <li class="me-2"><a class="text-decoration-none" href="#" role="button"><i
                                                class="ri-instagram-fill"></i></a></li>
                                    <li class="me-2"><a class="text-decoration-none" href="#" role="button"><i
                                                class="ri-pinterest-fill"></i></a></li>
                                    <li class="me-2"><a class="text-decoration-none" href="#" role="button"><i
                                                class="ri-twitter-fill"></i></a></li>
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
        $(function() {

        })

        const selectItem = (dataBase, prod_id, price) => {

            $('#dataBase').val(dataBase)
            $('#prod_id').val(prod_id)
            $('#price').val(price)

        }

        const cart = () => {
            let qty = $('.product-qty').val()
            let price = $('#price').val()
            let prod_id = $('#prod_id').val()
            let dataBase = $('#dataBase').val()

            if (prod_id == '') {
                alert('目前沒有選擇商品')
                return
            } else {
                $.post('/cart/order', {
                    id: prod_id,
                    dataBase: dataBase,
                    prod_id: prod_id,
                    price: price,
                    qty: qty
                }, function(data) {
                    if (data.status == 'success') {
                        alert('加入購物車成功')
                        location.reload()
                    } else {
                        alert('加入購物車失敗')
                    }
                })
            }
        }
    </script>
@endsection
