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
        <img src="{{ asset('upload/images/' . $product->id . '/' . $product->image) }}" style="width: 15rem">
    @else
        <img src="https://down-tw.img.susercontent.com/file/{{ $product->image }}" style="width: 15rem" alt="">
    @endif
    <x:form::input type="file" name="image" label="封面圖片" />
</div>

<div class="mt-3">
    <x:form::textarea name="description" label="詳細內容" rows="10" />
</div>

<div class="mt-3">
    <div>
        <label class="form-label">運費方式</label>
    </div>
    <div class="list-group">
        @foreach ($orderShipArray as $ship)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <p class="fw-bold mb-1">{{ $ship['name'] }}</p>
                </div>
                <div class="row d-flex justify-content-between align-items-center">
                    <input type="hidden" value="{{ $ship['price'] }}" name="shipPrice[{{ $ship['id'] }}]">
                    <span class="m-1 ship-price-{{ $ship['id'] }}">NT${{ $ship['price'] }}</span>
                    <button class="btn btn-outline-secondary btn-sm m-2"
                        type="button"
                        onclick="changePrice({{ $ship['id'] }}, '{{ $ship['name'] }}', {{ $ship['price'] }})"><i
                            class="fas fa-pencil-alt"></i></button>

                    <div class="custom-control custom-switch m-2">
                        <input type="checkbox" class="custom-control-input"
                            name="shipStatus[{{ $ship['id'] }}]"
                            id="shipStatus-{{ $ship['id'] }}"
                            onclick="shipStatus({{ $ship['id'] }})"
                            @if ($ship['status'] == 1) checked @endif>
                        <label class="custom-control-label" for="shipStatus-{{ $ship['id'] }}"></label>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="mt-3">
    <x:form::select class="form-control" name="status" label="啓用狀態"
        :options="[1 => '啓用', 0 => '停用']" :selected="$product->status" />
</div>

<div class="mt-3 text-center">
    <x:form::button.link class="btn-secondary" href="/backend/product">取消</x:form::button.link>
    <x:form::button.submit id="submit">確認存檔</x:form::button.submit>
</div>
