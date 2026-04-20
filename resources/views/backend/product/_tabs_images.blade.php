<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h5 class="mb-0 text-gray-800">圖檔列表</h5>
    <a href="{{ route('product_image.create', $product->id) }}" class="btn btn-success">
        <i class="fa-solid fa-circle-plus"></i>
    </a>
</div>

<div class="table-responsive">
    <table class="table table-bordered mb-0" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th style="width: 10%">ID</th>
                <th style="width: 40%">圖檔</th>
                <th style="width: 16%">順序</th>
                <th style="width: 8%">編輯</th>
                <th style="width: 8%">刪除</th>
            </tr>
        </thead>
        <tbody>
            @forelse($product_images as $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>
                        <img src="{!! $value->image_url !!}" style="width: 150px; max-width: 100%;" alt="">
                    </td>
                    <td>{{ $value->sort }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('product_image.edit', [$product->id, $value->id]) }}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="{{ route('product_image.delete', $value->id) }}"
                            onclick="return confirm('確定刪除？')">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">目前沒有圖檔資料</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
