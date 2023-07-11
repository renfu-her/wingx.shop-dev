@extends('frontend.layouts.master')

@section('content')
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
