@extends('frontend.layouts.master')

@section('content')
<section class="mt-0 ">

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
    <section class="mt-5 container ">
        <h1 class="mb-4 display-6 fw-bold text-center">聯絡我們</h1>
        <div class="row">
            <div class="col-6 mx-auto contact-us">
                <ul>
                    <li>統編：42937613</li>
                    <li>電話：0976153071</li>
                    <li>LINE 專人服務：wing1798</li>
                    <li>E-mail: <a href="mailto:wingx1798@gmail.com">wingx1798@gmail.com</a>
                </ul>
            </div>
        </div>

    </section>
</section>
@endsection

@section('css')
    <style>
        .contact-us ul {
            list-style-type: none;
        }

        .contact-us ul li {
            font-size: 22px;
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('js')
@endsection
