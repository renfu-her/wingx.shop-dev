@extends('frontend.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title text-center mb-5 fw-light fs-5">登入</h5>
                        <form>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com"
                                    data-nlok-ref-guid="51641740-131e-440f-9cd6-6f27cc57f4e9">
                                <div id="norton-idsafe-field-styling-divId"
                                    style="height:42.18181818181818px;max-width:42.18181818181818px;vertical-align:top; position:absolute; top:7.90909090909091px;left:301.366568914956px;cursor:pointer;resize: both;z-index:2147483646;">
                                    <img id="norton-idsafe-field-logo-imgId"
                                        src="chrome-extension://lcccdlklhahfmobgpnilndimkankpnkg/images/ic-field-logo.svg"
                                        style="height:42.18181818181818px; max-width:42.18181818181818px;"></div>
                                <label for="floatingInput">E-mail</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                                    data-nlok-ref-guid="4cf3ffb4-e445-49c3-9f99-3fc237be5737">
                                <div id="norton-idsafe-field-styling-divId"
                                    style="height:42.18181818181818px;max-width:42.18181818181818px;vertical-align:top; position:absolute; top:7.90909090909091px;left:301.366568914956px;cursor:pointer;resize: both;z-index:2147483646;">
                                    <img id="norton-idsafe-field-logo-imgId"
                                        src="chrome-extension://lcccdlklhahfmobgpnilndimkankpnkg/images/ic-field-logo.svg"
                                        style="height:42.18181818181818px; max-width:42.18181818181818px;"></div>
                                <label for="floatingPassword">Password</label>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                                <label class="form-check-label" for="rememberPasswordCheck">
                                    Remember password
                                </label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit"
                                    data-nlok-ref-guid="d3b25475-e729-48c4-f589-48c81c4e31bd">Sign
                                    in</button>
                            </div>
                            <hr class="my-4">
                            <div class="d-grid mb-2">
                                <button class="btn btn-google btn-login text-uppercase fw-bold" type="submit">
                                    <i class="fab fa-google me-2"></i> Sign in with Google
                                </button>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-facebook btn-login text-uppercase fw-bold" type="submit">
                                    <i class="fab fa-facebook-f me-2"></i> Sign in with Facebook
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
@endsection

@section('js')
@endsection
