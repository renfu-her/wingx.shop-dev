@extends('backend.layouts.app')

@section('title', 'Admin')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">產品管理 - 編輯</h1>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="default">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="productEditTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link @if ($activeTab === 'basic') active @endif" id="product-basic-tab"
                                        data-toggle="tab" href="#product-basic" role="tab" aria-controls="product-basic"
                                        aria-selected="{{ $activeTab === 'basic' ? 'true' : 'false' }}">
                                        基本資料
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link @if ($activeTab === 'specs') active @endif" id="product-specs-tab"
                                        data-toggle="tab" href="#product-specs" role="tab" aria-controls="product-specs"
                                        aria-selected="{{ $activeTab === 'specs' ? 'true' : 'false' }}">
                                        規格
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link @if ($activeTab === 'images') active @endif" id="product-images-tab"
                                        data-toggle="tab" href="#product-images" role="tab" aria-controls="product-images"
                                        aria-selected="{{ $activeTab === 'images' ? 'true' : 'false' }}">
                                        圖檔維護
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content border border-top-0 rounded-bottom p-4" id="productEditTabsContent">
                                <div class="tab-pane fade @if ($activeTab === 'basic') show active @endif" id="product-basic"
                                    role="tabpanel" aria-labelledby="product-basic-tab">
                                    <x:form::form method="PUT" id="form_post" enctype="multipart/form-data"
                                        :action="route('product.update', $product->id)" :bind="$product">
                                        @include('backend.product._tabs_basic')
                                    </x:form::form>
                                </div>
                                <div class="tab-pane fade @if ($activeTab === 'specs') show active @endif" id="product-specs"
                                    role="tabpanel" aria-labelledby="product-specs-tab">
                                    @include('backend.product._tabs_specs')
                                </div>
                                <div class="tab-pane fade @if ($activeTab === 'images') show active @endif" id="product-images"
                                    role="tabpanel" aria-labelledby="product-images-tab">
                                    @include('backend.product._tabs_images')
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
    <style>
        #productEditTabs .nav-link {
            font-weight: 600;
        }

        #productEditTabsContent {
            background: #fff;
        }
    </style>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <script>
        function initProductSpecEditor(productId) {
            if (window.productSpecEditorInitialized === productId) {
                return;
            }
            window.productSpecEditorInitialized = productId;

            let options1Count = 0;
            let options2Count = 0;

            function init() {
                $.post('/product/spec', {
                    'product_id': productId,
                    'num': 1
                }, function(items) {
                    if (items.html != '') {
                        $('#init-options1').val(items.detailName)
                        $('.newRow').after(items.html);
                    }
                })

                $.post('/product/spec', {
                    'product_id': productId,
                    'num': 2
                }, function(items) {
                    if (items.html != '') {
                        $('#init-options2').val(items.detailName)
                        $('.newRow-2').after(items.html);
                    }
                })
            }

            function initList() {
                $.post('/product/spec/list', {
                    'product_id': productId
                }, function(items) {
                    $('.list-header').html(items.header)
                    $('#row-dynamic-add').html(items.col);
                })
            }

            function countFilledInputs(selector) {
                let count = 0;
                $(selector).each(function() {
                    if ($(this).val().trim() !== '') {
                        count++;
                    }
                });
                return count;
            }

            function makeOptione1() {
                let selector = 'input[name="options1[]"]';
                $('#row-dynamic-add').html('')
                let row = '';

                $(selector).each(function() {
                    if ($(this).val().trim() !== '') {
                        row += '<div class="row">'
                        row += '<div class="col bordered-div">' + $(this).val() + '</div>';
                        row += '<div class="col bordered-div"><input type="number" class="form-control" name="price[]"></div>';
                        row += '<div class="col bordered-div"><input type="number" class="form-control" name="num[]"></div>';
                        row += '</div>'
                    }
                });
                $('#row-dynamic-add').html(row)
            }

            function makeOptione2() {
                let selectorOption1 = 'input[name="options1[]"]';
                let selectorOption2 = 'input[name="options2[]"]';
                $('#row-dynamic-add').html('')
                let row = '';

                $(selectorOption1).each(function() {
                    if ($(this).val().trim() !== '') {
                        row += '<div class="row">'
                        row += '<div class="col bordered-div">' + $(this).val() + '</div>';
                        row += '<div class="col-9">';
                        $(selectorOption2).each(function() {
                            if ($(this).val().trim() !== '') {
                                row += '<div class="row">';
                                row += '<div class="col bordered-div gray-div">' + $(this).val() + '</div>';
                                row += '<div class="col bordered-div"><input type="number" class="form-control" name="price[]"></div>';
                                row += '<div class="col bordered-div"><input type="number" class="form-control" name="num[]"></div>';
                                row += '</div>'
                            }
                        })
                        row += '</div>'
                        row += '</div>'
                    }
                });
                $('#row-dynamic-add').html(row)
            }

            $(document).off('keyup.productSpec1').on('keyup.productSpec1', 'input[name="options1[]"]', function() {
                options1Count = countFilledInputs('input[name="options1[]"]');
                makeOptione1();
                makeOptione2();
            });

            $(document).off('keyup.productSpec2').on('keyup.productSpec2', 'input[name="options2[]"]', function() {
                options2Count = countFilledInputs('input[name="options2[]"]');
                makeOptione1();
                makeOptione2();
            });

            $('input[name=title1]').off('keyup.productTitle1').on('keyup.productTitle1', function() {
                $('.title1').html($(this).val())
                if ($('.title1').html() == '') {
                    $('.title1').html('規格一')
                }
            })

            $('input[name=title2]').off('keyup.productTitle2').on('keyup.productTitle2', function() {
                $('.title2').html($(this).val())
                if ($('.title2').html() == '') {
                    $('.title2').hide();
                } else {
                    $('.title2').show();
                }
            })

            $('#addRow').off('click.productSpecAdd1').on('click.productSpecAdd1', function() {
                let html = '';
                html += '<div class="input-group mb-3 col-md-4 col-12 removeRow">';
                html += '<input type="text" name="options1[]" class="form-control m-input" placeholder="輸入選項" autocomplete="off">';
                html += '<button class="btn btn-danger removeItem" type="button">-</button>';
                html += '</div>';
                $('.spec-one').append(html);
            })

            $('#addRow-2').off('click.productSpecAdd2').on('click.productSpecAdd2', function() {
                let html = '';
                html += '<div class="input-group mb-3 col-md-4 col-12 removeRow">';
                html += '<input type="text" name="options2[]" class="form-control m-input" placeholder="輸入選項" autocomplete="off">';
                html += '<button class="btn btn-danger removeItem" type="button">-</button>';
                html += '</div>';
                $('.spec-two').append(html);
            })

            $(document).off('click.productSpecRemove').on('click.productSpecRemove', '.removeItem', function() {
                $(this).closest('.removeRow').remove();
                makeOptione1();
                makeOptione2();
            });

            init();
            initList();
        }

        function submitProductDetailForm() {
            document.getElementById('dynamic-form').submit();
        }

        $(function() {
            initProductSpecEditor('{{ $product->id }}');

            $('#shipSave').on('click', function() {

                error_msg = [];

                shipPrice = $('input[name="shipPrice"]').val()
                shipId = $('input[name="shipId"]').val()

                if ($.trim(shipPrice) == '') {
                    error_msg.push('運費金額不得為空白');
                }

                if (error_msg.length > 0) {
                    alert(error_msg.join(','));
                    return false;
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

        const shipStatus = (shipId) => {
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
