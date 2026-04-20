@extends('backend.layouts.app')

@section('title', 'Admin')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">圖像管理</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                @include('backend.product._tabs_images')
            </div>
        </div>
    </div>
@endsection
