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

        <div class="container">
            <div class="row">
                @if ($product_categories[0])
                    <div class="col-12 col-md-4 pt-6" >
                        <div class="p-8" style="background: url({{ asset('frontend/images/home/index-slide-1.jpg') }}) 0% 0% / cover no-repeat;">
                            <h5 style="color: white" class="font-shadow">{{ $product_categories[0]['name'] }}</h5>
                            <a href="/category/1" class="btn btn-dar" style="background-color: #FF5F42 !important; color: white">購物去</a>
                        </div>
                    </div>
                @endif
                @if ($product_categories[1])
                    <div class="col-12 col-md-8 pt-6">
                        <div class="p-8" style="background: url({{ asset('frontend/images/home/index-slide-2.jpg') }}) 0% 0% / cover no-repeat">
                            <h5 style="color: white" class="font-shadow">{{ $product_categories[1]['name'] }}</h5>
                            <a href="/category/2" class="btn btn-dark"  style="background-color: #FF5F42 !important; color: white">購物去</a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                @if ($product_categories[2])
                    <div class="col-12 col-md-8 pt-6">
                        <div class="p-8" style="background: url({{ asset('frontend/images/home/index-slide-3.jpg') }}) 0% 0% / cover no-repeat;">
                            <h5 style="color: white" class="font-shadow">{{ $product_categories[2]['name'] }}</h5>
                            <a href="/category/3" class="btn btn-dar" style="background-color: #FF5F42 !important; color: white">購物去</a>
                        </div>
                    </div>
                @endif
                @if ($product_categories[3])
                    <div class="col-12 col-md-4 pt-6">
                        <div class="p-8" style="background: url({{ asset('frontend/images/home/index-slide-4.jpg') }}) 0% 0% / cover no-repeat">
                            <h5 style="color: white" class="font-shadow">{{ $product_categories[3]['name'] }}</h5>
                            <a href="/category/4" class="btn btn-dark"  style="background-color: #FF5F42 !important; color: white">購物去</a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                @if ($product_categories[4])
                    <div class="col-12 col-md-4 pt-6">
                        <div class="p-8" style="background: url({{ asset('frontend/images/home/index-slide-4.jpg') }}) 0% 0% / cover no-repeat;">
                            <h5 style="color: white" class="font-shadow">{{ $product_categories[4]['name'] }}</h5>
                            <a href="/category/5" class="btn btn-dar" style="background-color: #FF5F42 !important; color: white">購物去</a>
                        </div>
                    </div>
                @endif
                @if ($product_categories[5])
                    <div class="col-12 col-md-8 pt-6">
                        <div class="p-8" style="background: url({{ asset('frontend/images/home/index-slide-5.jpg') }}) 0% 0% / cover no-repeat">
                            <h5 style="color: white" class="font-shadow">{{ $product_categories[5]['name'] }}</h5>
                            <a href="/category/6" class="btn btn-dark"  style="background-color: #FF5F42 !important; color: white">購物去</a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                @if ($product_categories[6])
                    <div class="col-12 col-md-8 pt-6">
                        <div class="p-8" style="background: url({{ asset('frontend/images/home/index-slide-6.jpg') }}) 0% 0% / cover no-repeat;">
                            <h5 style="color: white" class="font-shadow">{{ $product_categories[6]['name'] }}</h5>
                            <a href="/category/7" class="btn btn-dar" style="background-color: #FF5F42 !important; color: white">購物去</a>
                        </div>
                    </div>
                @endif
                @if ($product_categories[7])
                    <div class="col-12 col-md-4 pt-6">
                        <div class="p-8" style="background: url({{ asset('frontend/images/home/index-slide-7.jpg') }}) 0% 0% / cover no-repeat">
                            <h5 style="color: white" class="font-shadow">{{ $product_categories[7]['name'] }}</h5>
                            <a href="/category/8" class="btn btn-dark"  style="background-color: #FF5F42 !important; color: white">購物去</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </section>
    <!-- / Main Section-->
@endsection


@section('css')
@endsection

@section('js')
@endsection
