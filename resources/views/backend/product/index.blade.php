@extends('backend.layouts.app')

@section('title', 'Admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">產品管理</h1>
        </div>

        <button onclick="add_row()" class="btn btn-success mb-3">
            <i class="fa-solid fa-circle-plus"></i>
        </button>

        <form method="POST" id="search-form">
            <div class="form-group row g-3" style="color: #000 !important">
                <div class="col-md-12 col-12">
                    <div class="row no-gutters">
                        <label class="m-1 col-form-label text-right">商品型號： </label>
                        <div class="m-1">
                            <select id="category_id" name="category_id" class="form-control col-12">
                                <option value="">分類</option>
                                @foreach ($product_categories as $value)
                                    <option value="{{ $value['id'] }}" @if ($category_id == $value['id']) selected @endif>
                                        {{ $value['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="m-1 text-center">
                            <button type="submit" class="btn btn-success">搜尋</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" data-order='[[ 0, "desc" ]]' id="dataTable" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 10%">ID</th>
                                <th style="width: 15%">標題</th>
                                <th style="width: 15%">封面圖檔</th>
                                <th style="width: 10%">價格</th>
                                <th style="width: 10%">產品組合</th>
                                <th style="width: 10%">圖檔維護</th>
                                <th style="width: 8%">編輯</th>
                                <th style="width: 8%">刪除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>
                                        <img src="{!! $value->image_url !!}" class="w-100" alt="">
                                    </td>
                                    <td>{{ number_format($value->price) }}</td>
                                    <td>
                                        <button class="btn btn-success" onclick="edit_mix({{ $value->id }})">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-success" onclick="edit_image_row({{ $value->id }})">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary" onclick="edit_row({{ $value->id }})">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger" onclick="delete_row({{ $value->id }})">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection


@section('js')
    <script>
        $(function() {
            $('#dataTable').DataTable({
                columnDefs: [{
                    targets: [4, 5],
                    orderable: false
                }],
                "language": {
                    "url": "/admin/zh-HANT.json"
                }
            })

            $('#search-form').on('submit', function(e) {
                e.preventDefault();
                var data = $(this).serialize();
                location.href = '/backend/product?' + data;
            })
        })

        const edit_row = (id) => {
            location.href = '/backend/product/' + id + '/edit';
        }

        const add_row = () => {
            location.href = '/backend/product/create';
        }

        const edit_image_row = (id) => {
            location.href = '/backend/product/image/' + id;
        }

        const edit_mix = (product_id) => {
            location.href = '/backend/product/mix/' + product_id;
        }

        const delete_row = (id) => {
            if (confirm('確定刪除？')) {
                location.href = '/backend/product/delete/' + id;
            }
        }
    </script>
@endsection
