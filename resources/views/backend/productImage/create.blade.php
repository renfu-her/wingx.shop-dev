@extends('backend.layouts.app')

@section('title', 'Admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">圖像管理 - 新增</h1>
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
                                    <x:form::form method="POST" id="form_post" enctype="multipart/form-data" :action="route('product_image.store', $product_id)">

                                        <div class="mt-3">
                                            <x:form::input type="file" name="image" label="圖片" required />
                                        </div>

                                        <div class="mt-3">
                                            <x:form::input type="number" name="sort" label="順序" value="1" />
                                        </div>

                                        <div class="mt-3 text-center">
                                            <x:form::button.link class="btn-secondary" href="/backend/product/image">取消
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

            $('#form_post').on('submit', function(){
                let error_msg = []

                if($('input[name=image]').val() == ''){
                    error_msg.push('請上傳圖片')
                }

                if($('input[name=sort]').val() == ''){
                    error_msg.push('請輸入順序')
                }

                if(error_msg.length > 0){
                    alert(error_msg.join('\n'))
                    return false
                }
            })
        })
    </script>
@endsection
