@extends('backend.layouts.app')

@section('title', 'Admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">產品管理 - 編輯</h1>
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
                                        :action="route('product.update', $product->id)" :bind="$product">

                                        <div class="mt-3">
                                            <x:form::select name="category_id" class="form-control" label="分類"
                                                :options="$product_category" :selected="$product->category_id" required />
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
                                            @if ($product->define_image == 1)
                                                <img src="{{ asset('upload/images/' . $product->id . '/' . $product->image) }}"
                                                    style="width: 15rem">
                                            @else
                                                <img src="https://down-tw.img.susercontent.com/file/{{ $product->image }}"
                                                    style="width: 15rem" alt="">
                                            @endif
                                            <x:form::input type="file" name="image" label="封面圖片" />
                                        </div>

                                        <div class="mt-3">
                                            <x:form::textarea name="description" label="詳細內容" rows="10" />
                                        </div>

                                        {{-- <div class="mt-3">
                                            <x:form::select class="form-control" name="is_free_ship" label="免運費"
                                                :options="[0 => '停用', 1 => '啓用', ]" :selected="[0]" />
                                        </div> --}}

                                        {{-- <div class="mt-3">
                                            <x:form::checkbox class="form-checkbox" name="ships" label="運費方式"
                                                :group="$ships" :checked="$ship_ids" multiple  inline/>
                                        </div> --}}

                                        <div class="mt-3">
                                            <div>
                                                <label class="form-label">運費方式</label>
                                            </div>
                                            <div class="list-group">
                                                @foreach ($orderShipArray as $ship)
                                                    <div
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <p class="fw-bold mb-1">{{ $ship['name'] }}</p>
                                                        </div>
                                                        <div class="row d-flex justify-content-between align-items-center">
                                                            <input type="hidden" value="{{ $ship['price'] }}"
                                                                name="shipPrice[{{ $ship['id'] }}]">
                                                            <span
                                                                class="m-1 ship-price-{{ $ship['id'] }}">NT${{ $ship['price'] }}</span>
                                                            <button class="btn btn-outline-secondary btn-sm m-2"
                                                                type="button"
                                                                onclick="changePrice({{ $ship['id'] }}, '{{ $ship['name'] }}', {{ $ship['price'] }})"><i
                                                                    class="fas fa-pencil-alt"></i></button>

                                                            <div class="custom-control custom-switch m-2">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    name="shipStatus[{{ $ship['id'] }}]"
                                                                    id="shipStatus-{{ $ship['id'] }}"
                                                                    onclick="shipStatis({{ $ship['id'] }})"
                                                                    @if ($ship['status'] == 1) checked @endif>
                                                                <label class="custom-control-label"
                                                                    for="shipStatus-{{ $ship['id'] }}"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <!-- 複製以上 div 來添加更多的列表項目... -->
                                            </div>
                                        </div>

                                        <div class="mt-3">
                                            <x:form::select class="form-control" name="status" label="啓用狀態"
                                                :options="[1 => '啓用', 0 => '停用']" :selected="$product->status" />
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

    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <x:form::form method="POST" id="formShipPrice" enctype="multipart/form-data"
                    :action="route('product.updateShipPrice')">
                    <div class="modal-header">
                        <h5 class="modal-title" id="shipName">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="mt-3">
                            <x:form::input type="number" name="shipPrice" label="金額" required />
                            <x:form::input type="hidden" name="shipId" label="ID" value="" />
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                        <button type="button" class="btn btn-primary" id="shipSave">儲存</button>
                    </div>
                </x:form::form>
            </div>
        </div>
    </div>


@endsection

@section('css')

@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <script>
        $(function() {

            $('#shipSave').on('click', function() {

                error_msg = [];

                shipPrice = $('input[name="shipPrice"]').val()
                shipId = $('input[name="shipId"]').val()

                if ($.trim(shipPrice) == '') {
                    error_msg.push('運費金額不得為空白'); // 使用 push 方法添加元素到數組
                }

                // 如果 error_msg 有元素（即，如果有錯誤訊息）
                if (error_msg.length > 0) {
                    alert(error_msg.join(',')); // 將所有的錯誤訊息合併成一個字串並顯示
                    return false; // 阻止表單提交
                }

                $.post("{{ route('product.updateShipPrice') }}", {
                    'shipPrice': shipPrice,
                    'shipId': shipId,
                }, function(data) {
                    if (data.status == 200) {
                        $('.ship-price-' + shipId).html('NT$' + shipPrice)
                        $('#statusModal').modal('hide')
                    }
                })

                return true;

            })

            $('input[type=checkbox]').on('change', function() {
                console.log($(this).attr('id'))
                console.log($(this).prop('checked'))
            })

        })

        const changePrice = (shipId, shipName, shipPrice) => {

            $('#shipName').html(shipName);

            $('input[name=shipPrice]').val(shipPrice)
            $('input[name=shipId]').val(shipId)

            $('#statusModal').modal('show')
        }

        const shipStatis = (shipId) => {


            let isChecked = $('#shipStatus-' + shipId).prop('checked');

            $.post("{{ route('product.updateShipStatus') }}", {
                'shipId': shipId,
                'shipStatus': isChecked
            }, function(items) {
                console.log(items)
            })
        }
    </script>
@endsection
