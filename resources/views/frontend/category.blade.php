@extends('frontend.layouts.master')

@section('content')
    <section class="mt-0 ">

        <!-- Category Top Banner -->
        <div class="py-6 bg-img-cover bg-light bg-overlay-gradient-dark position-relative overflow-hidden mb-4 bg-pos-center-center"
            style="background-image: url(./assets/images/banners/banner-1.jpg);">
            <div class="container position-relative z-index-20" data-aos="fade-right" data-aos-delay="300">
                <div class="col-12 col-md-6">
                    <p class="lead text-white mb-0">

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
                                <h2 class="mb-4 fs-6 mt-2 fw-bolder">商品目録</h2>
                                <nav>
                                    <ul class="list-unstyled list-default-text">
                                        <li class="mb-2">
                                            <a class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center"
                                                href="/catehory/0">
                                                <span>
                                                    <i class="ri-arrow-right-s-line align-bottom ms-n1"></i>
                                                    所有商品
                                                </span>
                                                <span class="text-muted ms-4">({{ $categoryCountAll }})</span>
                                            </a>
                                        </li>
                                        @foreach ($product_categories as $product_category)
                                            <li class="mb-2"><a
                                                    class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center"
                                                    href="/category/{{ $product_category->id }}">
                                                    <span>
                                                        <i class="ri-arrow-right-s-line align-bottom ms-n1"></i>
                                                        {{ $product_category->name }}
                                                    </span>
                                                    <span
                                                        class="text-muted ms-4">({{ $product_category->count }})</span></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </nav>
                            </div>
                        </aside>
                        <!-- / Category Aside-->
                    </div>
                </div>
                <!-- / Category Aside/Sidebar -->

                <!-- Category Products-->
                <div class="col-12 col-lg-9">
                    <!-- Products-->
                    <div class="row g-4 mb-5">

                        @forelse($products as $product)
                            <div class="col-6 col-sm-6 col-md-4">
                                <!-- Card Product-->
                                <div class="card position-relative h-100 card-listing hover-trigger">
                                    <div class="card-header">
                                        <picture class="position-relative overflow-hidden d-block bg-light">
                                            <img class="w-100 img-fluid position-relative z-index-10" title=""
                                                src="{{ $product->image_url }}" alt="">
                                        </picture>
                                        <picture class="position-absolute z-index-20 start-0 top-0 hover-show bg-light">
                                            <img class="w-100 img-fluid" title="" src="{{ $product->image_url }}"
                                                alt="">
                                        </picture>
                                    </div>
                                    <div class="card-body px-0 text-center">
                                        <a class="mb-0 mx-2 mx-md-4 fs-p link-cover text-decoration-none d-block text-center"
                                            href="/product/{{ $product->id }}">{{ $product->name }}</a>
                                        <p class="fw-bolder m-0 mt-2">$ {{ number_format($product->price) }}</p>
                                    </div>
                                </div>
                                <!--/ Card Product-->
                            </div>
                        @empty
                            <div class="col-12 col-sm-6 col-md-12 d-flex justify-content-center">
                                <div class="p-5" style="font-size: 26px">
                                    尚未有商品
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <!-- / Products-->

                    <!-- Pagination-->
                    <nav class="border-top mt-5 pt-5 d-flex justify-content-center align-items-center text-center"
                        aria-label="Category Pagination">
                        {{ $products->links('pages') }}
                    </nav>
                    <!-- / Pagination-->
                </div>
                <!-- / Category Products-->
            </div>
        </div>

    </section>
    <!-- / Main Section-->
@endsection

@section('css')
    <style>
        img,
        svg {
            width: 16px;
        }
    </style>
@endsection

@section('js')
@endsection
