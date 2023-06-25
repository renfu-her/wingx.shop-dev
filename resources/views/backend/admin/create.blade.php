@extends('backend.layouts.app')

@section('title', 'Admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">管理者管理 - 新增</h1>
        </div>

        <!-- DataTales Example -->

        <div class="row">
            <div class="col-lg-12">
                <!-- Default Bootstrap Form Controls-->
                <div id="default">
                    <div class="card mb-4">
                        <div class="card-body">
                            <!-- Component Preview-->
                            <div class="sbp-preview">
                                <div class="sbp-preview-content">
                                    <x:form::form method="POST" id="form_post" enctype="multipart/form-data" :action="route('admin.store')" >

                                        <div class="mt-3">
                                            <x:form::input name="name" label="姓名" required />
                                        </div>

                                        <div class="mt-3">
                                            <x:form::input type="email" name="email" label="E-mail" required />
                                        </div>

                                        <div class="mt-3 password-input">
                                            <x:form::input type="password" name="password" label="密碼" required/>
                                        </div>

                                        <div class="mt-3">
                                            <x:form::select class="form-control" name="status" label="啓用狀態"
                                                :options="[1 => '啓用', 0 => '停用']" :selected="[1]" />
                                        </div>

                                        <div class="mt-3 text-center">
                                            <x:form::button.submit id="submit">確認存檔</x:form::button.submit>
                                            <x:form::button.link class="btn-secondary" href="/backend/user">取消
                                            </x:form::button.link>
                                        </div>

                                    </x:form::form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')

@endsection

@section('js')

    <script>
        $(function() {

            $('.password-input').find('label').html('密碼 <span style="color: red">(請輸入6 位以上，密碼必須包含字母以及數字組成)</span>')

            $('#form_post').on('submit', function(){
                let error_msg = [];

                if($('input[name=name]').val() == ''){
                    error_msg.push('請輸入姓名');
                }

                if($('input[name=email]').val() == ''){
                    error_msg.push('請輸入E-mail');
                }

                if($('input[name=password]').val() == ''){
                    error_msg.push('請輸入密碼');
                }

                if(error_msg.length > 0){
                    alert(error_msg.join('\n'));
                    return false;
                }
            })
        })

    </script>
@endsection
