@extends('backend.layouts.app')

@section('title', 'Admin')

@section('content')
    <div class="container mt-5">
        <form id="dynamic-form" method="post" action="/backend/product/detail/save">
            <div class="spec">
                <div class="row">

                    <div class="input-group mb-3 col-12">
                        <h5>商品名稱</h5>
                    </div>
                    <div class="input-group mb-3 col-12">
                        <input label="標題" value="{{ $product->name }}" class="form-control-plaintext"
                            style="font-weight: 600" readonly />
                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                    </div>

                    <div class="input-group mb-3 col-12">
                        <h5>規格一</h5>
                    </div>
                    <div class="input-group mb-3 col-4">
                        <input type="text" name="title1" class="form-control m-input" placeholder="範例：顔色"
                            autocomplete="off" value="{{ $productTitleOneName }}">
                    </div>
                </div>

                <div class="row spec-one">
                    <div class="input-group mb-3 col-4 newRow" id="input-form-row">
                        <input type="text" name="options1[]" class="form-control m-input" placeholder="輸入選項"
                            autocomplete="off">
                        <button class="btn btn-success" type="button" id="addRow">+</button>
                    </div>

                    {{-- <div id="newRow"></div> --}}
                </div>
            </div>
            <p></p>

            <div class="spec">
                <div class="row">
                    <div class="input-group mb-3 col-12">
                        <h5>規格二</h5>
                        {{-- <input type="text"> --}}
                    </div>
                    <div class="input-group mb-3 col-4">
                        <input type="text" name="title2" class="form-control m-input" placeholder="範例：尺寸"
                            autocomplete="off" value="{{ $productTitleTwoName }}">
                    </div>
                </div>

                <div class="row spec-two">
                    <div class="input-group mb-3 col-4 newRow-2" id="input-form-row-2">
                        <input type="text" name="options2[]" class="form-control m-input" placeholder="輸入選項"
                            autocomplete="off">
                        <button class="btn btn-success" type="button" id="addRow-2">+</button>
                    </div>

                    {{-- <div id="newRow"></div> --}}
                </div>
            </div>
            <p></p>

            <div class="spec">
                <div class="container mt-5 row-change">
                    <div class="row list-header">
                        <!-- Define each column with the col class -->
                        <div class="col bordered-div gray-div title1">規格一</div>
                        <div class="col bordered-div gray-div title2" style="display: none">規格二</div>
                        <div class="col bordered-div gray-div">金額</div>
                        <div class="col bordered-div gray-div">數量</div>
                    </div>
                    <span id="row-dynamic-add">

                    </span>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <button type="button" class="btn btn-primary m-3" onclick="submitForm()">存檔</button>
                <button type="button" class="btn btn-secondary m-3">取消</button>
            </div>
        </form>
    </div>


@endsection

@section('css')
    <style>
        .spec {
            background-color: white !important;
            padding: 20px !important;
        }

        .bordered-div {
            border: 1px solid #dee2e6;
            /* Bootstrap default border color */
            padding: 1rem;
            /* Some padding inside the divs */
            margin-bottom: 0.5rem;
            /* Spacing between rows */
        }

        .gray-div {
            background-color: #F8F8F8 !important;
        }
    </style>
@endsection

@section('js')
    <script>
        $(function() {

            let options1Count = 0;
            let options2Count = 0;

            // init();
            initList();

            function init() {
                // 第一項目
                $.post('/product/spec', {
                    'product_id': '{{ $product->id }}',
                    'num': 1
                }, function(item) {
                    if (item != '') {
                        $('.spec-one').html('');
                        $('.spec-one').html(item);
                    } else {
                        $('.spec-one').html('');
                        $('.spec-one').html(makeInit(1, 'add'));
                    }
                })

                // 第二項目
                $.post('/product/spec', {
                    'product_id': '{{ $product->id }}',
                    'num': 2
                }, function(item) {

                    if (item != '') {
                        $('.spec-two').html('');
                        $('.spec-two').html(item);
                    } else {
                        $('.spec-two').html('');
                        $('.spec-two').html(makeInit(2, 'add'));
                    }

                })
            }

            function initList() {
                // 產生列表
                $.post('/product/spec/list', {
                    'product_id': '{{ $product->id }}'
                }, function(items) {
                    $('.list-header').html('');
                    $('.list-header').html(items.header)

                    $('#row-dynamic-add').html('');
                    $('#row-dynamic-add').html(items.col);
                })

            }

            function makeInit(num, addOrDel) {

                makeNum = '';
                if (num == 2) {
                    makeNum = '-2'

                }

                makeNumRow = '';
                if (addOrDel == 'add') {
                    makeNumRow = 'new-row'.$makeNum;
                }

                var html = '';
                html += '<div class="input-group mb-3 col-4 ' + makeNumRow + '" id="input-form-row' + makeNum +
                    '">';
                html +=
                    '<input type="text" name="options' + num +
                    '[]" class="form-control m-input" placeholder="輸入選項" autocomplete="off">';

                if (addOrDel == 'add') {
                    html += '<button class="btn btn-success" type="button" id="addRow' + makeNum + '">+</button>'
                } else {
                    html += '<button class="btn btn-danger" type="button" id="removeRow' + makeNum +
                        '">-</button>';
                }

                html += '</div>';
                return html;
            }


            // 函數: 計算非空輸入的數量
            function countFilledInputs(selector, countVar) {
                // 重置計數器
                let count = 0;
                // 遍歷所有輸入欄位，計算非空輸入的數量
                $(selector).each(function() {
                    if ($(this).val().trim() !== '') {
                        count++;
                    }
                });
                // 更新對應計數器的值
                countVar = count;

                return count;
            }

            // make options1
            function makeOptione1() {
                selector = 'input[name="options1[]"]'
                $('#row-dynamic-add').html('')
                row = '';

                $(selector).each(function() {
                    if ($(this).val().trim() !== '') {
                        row += '<div class="row">'
                        row += '<div class="col bordered-div">' + $(this).val() + '</div>';
                        row +=
                            '<div class="col bordered-div"><input type="number" class="form-control" name="price[]"></div>';
                        row +=
                            '<div class="col bordered-div"><input type="number" class="form-control" name="num[]"></div>';
                        row += '</div>'
                    }
                });
                $('#row-dynamic-add').html(row)
            }

            function makeOptione2() {
                selectorOption1 = 'input[name="options1[]"]'
                selectorOption2 = 'input[name="options2[]"]'
                $('#row-dynamic-add').html('')
                row = '';

                $(selectorOption1).each(function() {
                    if ($(this).val().trim() !== '') {
                        row += '<div class="row">'
                        row += '<div class="col bordered-div">' + $(this).val() + '</div>';
                        row += '<div class="col-9">';
                        $(selectorOption2).each(function() {
                            if ($(this).val().trim() !== '') {
                                row += '<div class="row">';
                                row += '<div class="col bordered-div gray-div">' + $(this).val() +
                                    '</div>';
                                row +=
                                    '<div class="col bordered-div"><input type="number" class="form-control" name="price[]"></div>';
                                row +=
                                    '<div class="col bordered-div"><input type="number" class="form-control" name="num[]"></div>';
                                row += '</div>'
                            }
                        })
                        row += '</div>'
                        row += '</div>'
                    }
                });
                $('#row-dynamic-add').html(row)
            }

            // 監聽輸入欄位的變化，並更新計數器
            $(document).on('keyup', 'input[name="options1[]"]', function() {
                options1Count = countFilledInputs('input[name="options1[]"]',
                    options1Count);
                makeOptione1();
                // console.log('Options1 filled count:', options1Count);
            });

            $(document).on('keyup', 'input[name="options2[]"]', function() {
                options2Count = countFilledInputs('input[name="options2[]"]',
                    options2Count);
                makeOptione2();
                // console.log('Options2 filled count:', options2Count);
            });

            $('input[name=title1]').on('keyup', function() {
                $('.title1').html($(this).val())
                if ($('.title1').html() == '') {
                    $('.title1').html('規格一')
                }
            });
            $('input[name=title2]').on('keyup', function() {
                $('.title2').html($(this).val()).show()
                $('.s-2').show();
                if ($('.title2').html() == '') {
                    $('.title2').html('規格二').hide()
                    $('.s-2').html('').hide()
                }
            });

            // 新增行
            $("#addRow").click(function() {
                var html = '';
                html += '<div class="input-group mb-3 col-4" id="input-form-row">';
                html +=
                    '<input type="text" name="options1[]" class="form-control m-input" placeholder="輸入選項" autocomplete="off">';
                html +=
                    '<button class="btn btn-danger" type="button" id="removeRow">-</button>';
                html += '</div>';

                $('.newRow').after(html);
            });

            $("#addRow-2").click(function() {
                var html = '';
                html += '<div class="input-group mb-3 col-4" id="input-form-row-2">';
                html +=
                    '<input type="text" name="options2[]" class="form-control m-input" placeholder="輸入選項" autocomplete="off">';
                html +=
                    '<button class="btn btn-danger" type="button" id="removeRow-2">-</button>';
                html += '</div>';

                $('.newRow-2').after(html);
            });

            // 移除行
            $(document).on('click', '#removeRow', function() {
                $(this).closest('#input-form-row').remove();
            });
            $(document).on('click', '#removeRow-2', function() {
                $(this).closest('#input-form-row-2').remove();
            });

        })

        const submitForm = () => {

            let allFilled = true;

            $('#row-dynamic-add input').each(function() {
                if ($(this).val() === '') {
                    allFilled = false;
                    return false; // break the loop
                }
            })

            if (!allFilled) {
                alert('請填寫金額以及數量');
            } else {
                $('#dynamic-form').submit();
            }
        }
    </script>
@endsection
