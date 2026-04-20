<div class="spec-tab-wrap" data-product-id="{{ $product->id }}">
    <style>
        .spec-tab-wrap .spec {
            background-color: #f9f9f9 !important;
            padding: 20px !important;
        }

        .spec-tab-wrap .bordered-div {
            border: 1px solid #dee2e6;
            background-color: white;
            padding: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .spec-tab-wrap .gray-div {
            background-color: white !important;
        }
    </style>

    <div class="container-fluid px-0">
        <form id="dynamic-form" method="post" action="/backend/product/detail/save">
            @csrf
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
                    <div class="input-group mb-3 col-md-4 col-12">
                        <input type="text" name="title1" class="form-control m-input"
                            placeholder="範例：顔色" autocomplete="off" value="{{ $productTitleOneName }}">
                    </div>
                </div>

                <div class="row spec-one">
                    <div class="input-group mb-3 col-md-4 col-12 newRow" id="input-form-row">
                        <input type="text" name="options1[]" class="form-control m-input"
                            placeholder="輸入選項" id="init-options1" autocomplete="off">
                        <button class="btn btn-success" type="button" id="addRow">+</button>
                    </div>
                </div>
            </div>

            <p></p>

            <div class="spec">
                <div class="row">
                    <div class="input-group mb-3 col-12">
                        <h5>規格二</h5>
                    </div>
                    <div class="input-group mb-3 col-md-4 col-12">
                        <input type="text" name="title2" class="form-control m-input"
                            placeholder="範例：尺寸" autocomplete="off" value="{{ $productTitleTwoName }}">
                    </div>
                </div>

                <div class="row spec-two">
                    <div class="input-group mb-3 col-md-4 col-12 newRow-2" id="input-form-row-2">
                        <input type="text" name="options2[]" class="form-control m-input"
                            placeholder="輸入選項" id="init-options2" autocomplete="off">
                        <button class="btn btn-success" type="button" id="addRow-2">+</button>
                    </div>
                </div>
            </div>

            <p></p>

            <div class="spec">
                <div class="container-fluid px-0 mt-3 row-change">
                    <div class="row list-header">
                        <div class="col bordered-div gray-div title1">規格一</div>
                        <div class="col bordered-div gray-div title2" style="display: none">規格二</div>
                        <div class="col bordered-div gray-div">金額</div>
                        <div class="col bordered-div gray-div">數量</div>
                    </div>
                    <span id="row-dynamic-add"></span>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <button type="button" class="btn btn-primary m-3" onclick="submitProductDetailForm()">存檔</button>
                <button type="button" class="btn btn-secondary m-3" onclick="location.href='/backend/product'">取消</button>
            </div>
        </form>
    </div>
</div>
