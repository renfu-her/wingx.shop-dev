@extends('frontend.layouts.master')

@section('content')
    <div class="container">
        <div class="div-height"></div>
        <div class="mt-2 markdown-body" id="show_md">
            {!! $content_markdown !!}
        </div>

        <!-- 空白區；height: 20px -->
        <div class="mb-3"></div>
    </div>
@endsection


@section('css')
    <link rel="stylesheet" href="{{ asset('css/github-markdown-light.css') }}">
    <style>
        .div-height {
            height: 60px;
        }
    </style>
@endsection
