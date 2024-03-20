@extends('backend.layouts.app')

@section('title', 'Admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">產品分類管理 - 編輯</h1>
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
                                    <x:form::form method="PUT" id="form_post" enctype="multipart/form-data"
                                        :action="route('productCategory.update', $category->id)" :bind="$category">

                                        <div class="mt-3">
                                            <x:form::input name="name" label="名稱" required />
                                        </div>

                                        <div class="mt-3 text-center">
                                            <x:form::button.link class="btn-secondary" href="/backend/productCategory">取消
                                            </x:form::button.link>
                                            <x:form::button.submit id="submit">確認存檔</x:form::button.submit>
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
            $('#form_post').on('submit', function() {

                error_msg = '';

                if ($.trim($('input[name="name"').val()) == '') {
                    error_msg = '名稱不得為空白';
                }

                if (error_msg != '') {
                    alert(error_msg);
                    return false;
                }

                return true
            })
        })
    </script>
@endsection
