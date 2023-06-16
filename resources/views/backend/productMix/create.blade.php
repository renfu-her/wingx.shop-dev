@extends('backend.layouts.app')

@section('title', 'Admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between">
            <h1 class="h3 mb-0 w-100 text-gray-800">產品組合管理 - 新增</h1>
        </div>

        <div class="d-sm-flex align-items-center justify-content-between">
            <h5 class="my-3 w-100">產品：{{ $product->name }}</h5>
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
                                    <x:form::form method="POST" id="form_post" enctype="multipart/form-data" :action="route('product_mix.store', $product_id)">

                                        <div class="mt-3">
                                            <x:form::select  name="product_mix1" label="組合商品 1" class="form-control" :options="$product_mix1_selected" required />
                                        </div>

                                        <div class="mt-3">
                                            <x:form::select  name="product_mix2" label="組合商品 2" class="form-control" :options="$product_mix2_selected" />
                                        </div>

                                        <div class="mt-3">
                                            <x:form::input type="number" name="price" label="金額"  />
                                        </div>

                                        <div class="mt-3">
                                            <x:form::input name="description" label="組合說明"  />
                                        </div>

                                        <div class="mt-3">
                                            <x:form::input type="number" name="sort" label="順序" value="1" />
                                        </div>

                                        <div class="mt-3">
                                            <x:form::select class="form-control" name="status" label="啓用狀態"
                                                :options="[1 => '啓用', 0 => '停用']" :selected="[1]" />
                                        </div>

                                        <div class="mt-3 text-center">
                                            <x:form::input type="hidden" name="product_id" value="{{ $product_id }}" />
                                            <x:form::button.link class="btn-secondary" href="/backend/product/mix/{{ $product_id }}">取消
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

                if($('select[name=product_mix1]').val() == ''){
                    error_msg.push('請選擇組合商品 1')
                }

                if($('input[name=price]').val() == ''){
                    error_msg.push('請輸入金額')
                }

                if($('input[name=description]').val() == ''){
                    error_msg.push('請輸入組合說明')
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
