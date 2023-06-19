@extends('frontend.layouts.master')

@section('title', '重置密碼 - ')

@section('content')
    <!-- contact -->
    <section class="reset-password page" id="contact">
        <div class="container">
            <div class="contact-form">
                <form id="form_verify" action="/verify_password" method="post">
                    <div class="content">
                        <h1>重置密碼</h1>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="password">密碼 *</label>
                                <input type="password" id="password" name="password">
                            </div>
                            <div class="col-md-12">
                                <label for="confirm_password">確認密碼 *</label>
                                <input type="password" id="confirm_password" name="confirm_password">
                            </div>
                            <input type="hidden" name="verify" value="{{ $verify }}">
                            <button id="submit_verify" type="button">送出​</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection


@section('css')

@endsection

@section('js')
    <script>
        $(function(){
            $('#submit_verify').on('click', function(){

                let error_msg = []
                let password = $('#password').val()
                let confirm_password = $('#confirm_password').val()

                if($.trim(password) == ''){
                    error_msg.push("密碼不得空白")
                }
                if($.trim(confirm_password) == ''){
                    error_msg.push("確認密碼不得空白")
                }
                if(confirm_password != password){
                    error_msg.push("密碼以及確認密碼不符")
                }

                password_regex = /^[a-zA-Z0-9]{6,}$/i

                if(password.search(password_regex) == -1){
                    error_msg.push("請輸入6 位以上，密碼必須包含大小寫字母以及數字組成")
                }

                if(error_msg.length > 0) {
                    alert(error_msg.join("\n"))
                } else {
                    $('#form_verify').submit()
                }
            })
        })
    </script>
@endsection
