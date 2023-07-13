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
                @forelse($qas as $key => $value)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $key + 1 }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $key + 1 }}" aria-expanded="true" aria-controls="collapse-{{ $key + 1 }}">
                            {{ $value->question }}
                        </button>
                    </h2>
                    <div id="collapse-{{ $key + 1 }}" class="accordion-collapse collapse" aria-labelledby="heading_{{ $key + 1 }}"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            {!! nl2br($value->answer) !!}
                        </div>
                    </div>
                </div>
                @empty
                <div class="col text-center">
                    <h3>目前沒有資料</h3>
                </div>
                @endforelse

            </div>
        </section>
    </section>
@endsection

@section('css')
    <style>
        .accordion {
            border: 1px solid #ccc;
            border-radius: 6px;
        }
    </style>
@endsection

@section('js')
@endsection
