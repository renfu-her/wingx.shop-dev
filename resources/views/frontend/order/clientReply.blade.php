@extends('frontend.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title text-center mb-5 fw-light fs-5">店到店</h5>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="type" class="form-label">物流狀態 </label>
                                <input type="text" class="form-control" value="{{ $data->RtnMsg }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="type" class="form-label">寄貨編號 </label>
                                <input type="text" class="form-control" value="{{ $data->CVSPaymentNo }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="type" class="form-label">物流交易編號 </label>
                                <input type="text" class="form-control" value="{{ $data->AllPayLogisticsID }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
