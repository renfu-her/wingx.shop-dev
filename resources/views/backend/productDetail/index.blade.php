@extends('backend.layouts.app')

@section('title', 'Admin')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">產品規格管理</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                @include('backend.product._tabs_specs')
            </div>
        </div>
    </div>
@endsection

@section('js')
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
        });
    </script>
@endsection
