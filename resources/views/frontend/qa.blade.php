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
            <h1 class="mb-4 display-6 fw-bold text-center">知識百科</h1>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Accordion Item #1
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>This is the first item's accordion body.</strong> It is shown by default, until the
                            collapse plugin
                            adds the appropriate classes that we use to style each element. These classes control the
                            overall
                            appearance, as well as the showing and hiding via CSS transitions. You can modify any of this
                            with custom
                            CSS or overriding our default variables. It's also worth noting that just about any HTML can go
                            within the
                            <code>.accordion-body</code>, though the transition does limit overflow.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Accordion Item #2
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>This is the second item's accordion body.</strong> It is hidden by default, until the
                            collapse
                            plugin adds the appropriate classes that we use to style each element. These classes control the
                            overall
                            appearance, as well as the showing and hiding via CSS transitions. You can modify any of this
                            with custom
                            CSS or overriding our default variables. It's also worth noting that just about any HTML can go
                            within the
                            <code>.accordion-body</code>, though the transition does limit overflow.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Accordion Item #3
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>This is the third item's accordion body.</strong> It is hidden by default, until the
                            collapse plugin
                            adds the appropriate classes that we use to style each element. These classes control the
                            overall
                            appearance, as well as the showing and hiding via CSS transitions. You can modify any of this
                            with custom
                            CSS or overriding our default variables. It's also worth noting that just about any HTML can go
                            within the
                            <code>.accordion-body</code>, though the transition does limit overflow.
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection

@section('css')
    <style>

    </style>
@endsection

@section('js')
@endsection
