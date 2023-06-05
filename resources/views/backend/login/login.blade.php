@extends('backend.layouts.app-login')

@section('title', 'Admin')

@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row d-flex justify-content-center align-items-center">

            <div class="col-xl-6 col-lg-6 col-md-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">後臺登入</h1>
                                    </div>
                                    <form class="user" id="form_post" method="post" action="{{ route('login_verify') }}">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="email" name="email" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" id="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        {{-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> --}}
                                        <button id="submit_post" type="button" class="btn btn-primary btn-user btn-block">
                                            登入
                                        </button>
                                        {{-- <hr>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> --}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection

@section('js')
    <script>
        $(function(){

            $('#submit_post').on('click', function(){
                let error_msg = []

                if($.trim($('#email').val()) == ''){
                    error_msg.push('請輸入 Email')
                }
                if($.trim($('#password').val()) == ''){
                    error_msg.push('請輸入密碼')
                }

                if(error_msg.length == 0){
                    $('#form_post').submit();
                } else {
                    alert(error_msg.join("\n"));
                }
            })
        })
    </script>
@endsection
