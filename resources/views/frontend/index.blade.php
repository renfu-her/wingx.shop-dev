@extends('frontend.layouts.base')

@section('content')
    <!-- Main Section-->
    <section class="mt-0 ">

        <section class="position-relative " style="height: 550px">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($banners as $key => $value)
                        <div class="carousel-item @if ($key == 0) active @endif">
                            <img src="{{ asset('upload/banner/' . $value->image) }}" class="d-block w-100"
                                style="object-fit: cover; width: 100%; height: 550px">
                        </div>
                    @endforeach

                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleSlidesOnly"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleSlidesOnly"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </section>

        @foreach ($product_categories as $key => $value)
            <section class="mb-9 mt-5" data-aos="fade-up">
                <div class="container">
                    <div class="w-md-50 mb-5">
                        {{-- <p class="small fw-bolder text-uppercase tracking-wider mb-2 text-muted">Summer Favourites</p> --}}
                        <h3 class="fw-bold mb-3">{{ $value->name }}</h3>
                        {{-- <p class="lead">We've sorted through our feed to put together a collection of our products
                        perfect
                        for a summer outdoors.</p> --}}
                    </div>
                    <!-- Swiper Latest -->
                    <div class="swiper-container overflow-visible" data-swiper
                        data-options='{
                "spaceBetween": 25,
                "cssMode": true,
                "roundLengths": true,
                "scrollbar": {
                  "el": ".swiper-scrollbar",
                  "hide": false,
                  "draggable": true
                },
                "navigation": {
                  "nextEl": ".swiper-next",
                  "prevEl": ".swiper-prev"
                },
                "breakpoints": {
                  "576": {
                    "slidesPerView": 1
                  },
                  "768": {
                    "slidesPerView": 2
                  },
                  "992": {
                    "slidesPerView": 3
                  },
                  "1200": {
                    "slidesPerView": 4
                  }
                }
              }'>
                        <div class="swiper-wrapper pb-5 pe-1">
                            @forelse($products[$key] as $k => $v)
                                <div class="swiper-slide d-flex h-auto">
                                    <!-- Card Product-->
                                    <div class="card position-relative h-100 card-listing hover-trigger">
                                        <div class="card-header">
                                            <picture class="position-relative overflow-hidden d-block bg-light">
                                                <img class="w-100 img-fluid position-relative z-index-10" title=""
                                                    src="{{ $v->image_url }}" alt="">
                                            </picture>
                                            <picture class="position-absolute z-index-20 start-0 top-0 hover-show bg-light">
                                                <img class="w-100 img-fluid" title="" src="{{ $v->image_url }}"
                                                    alt="">
                                            </picture>
                                        </div>
                                        <div class="card-body px-0 text-center">
                                            <a class="mb-0 mx-2 mx-md-4 fs-p link-cover text-decoration-none d-block text-center"
                                                href="/product/{{ $v->id }}">{{ $v->name }}</a>
                                            <p class="fw-bolder m-0 mt-2">$ {{ $v->price }}</p>
                                        </div>
                                    </div>
                                    <!--/ Card Product-->
                                </div>
                            @empty
                                <div class="swiper-slide text-center w-100"
                                    style="height: 150px; border: 1px solid; line-height: 150px;">
                                    尚未有商品
                                </div>
                            @endforelse
                        </div>

                        <!-- Buttons-->
                        <div
                            class="swiper-btn swiper-disabled-hide swiper-prev swiper-btn-side btn-icon bg-dark text-white ms-3 shadow-lg mt-n5 ms-n4">
                            <i class="ri-arrow-left-s-line ri-lg"></i>
                        </div>
                        <div
                            class="swiper-btn swiper-disabled-hide swiper-next swiper-btn-side swiper-btn-side-right btn-icon bg-dark text-white me-n4 shadow-lg mt-n5">
                            <i class="ri-arrow-right-s-line ri-lg"></i>
                        </div>

                        <!-- Add Scrollbar -->
                        <div class="swiper-scrollbar"></div>

                    </div>
                    <!-- / Swiper Latest-->
                </div>
            </section>
        @endforeach

    </section>
    <!-- / Main Section-->
@endsection


@section('css')
@endsection

@section('js')
@endsection
