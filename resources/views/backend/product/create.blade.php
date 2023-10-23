@extends('backend.layouts.app')

@section('title', 'Admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">產品管理 - 新增</h1>
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
                                    <x:form::form method="POST" id="form_post" enctype="multipart/form-data"
                                        :action="route('product.store')">

                                        <div class="mt-3">
                                            <x:form::select name="category_id" class="form-control" label="分類"
                                                :options="$product_category" required />
                                        </div>

                                        <div class="mt-3">
                                            <x:form::input name="name" label="標題" required />
                                        </div>

                                        <div class="mt-3">
                                            <x:form::input type="number" name="price" label="價格" required />
                                        </div>
 
                                        <div class="mt-3">
                                            <x:form::input type="number" name="store_number" label="庫存" />
                                        </div>

                                        <div class="mt-3">
                                            <x:form::input type="file" name="image" label="封面圖片" required />
                                        </div>

                                        <div class="mt-3">
                                            <x:form::textarea name="description" label="詳細內容" rows="10" />
                                        </div>
                                        {{--
                                        <div class="mt-3">
                                            <x:form::select class="form-control" name="is_free_ship" label="免運費"
                                                :options="[0 => '停用', 1 => '啓用', ]" :selected="[0]" />
                                        </div> --}}

                                        <div class="mt-3">
                                            <x:form::checkbox class="form-checkbox" name="ships" label="運費方式"
                                                :group="$ships"  multiple inline/>
                                        </div>

                                        <div class="mt-3">
                                            <x:form::select class="form-control" name="status" label="啓用狀態"
                                                :options="[1 => '啓用', 0 => '停用']" :selected="[1]" />
                                        </div>

                                        <div class="mt-3 text-center">
                                            <x:form::button.link class="btn-secondary" href="/backend/product">取消
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

        })
    </script>
@endsection
