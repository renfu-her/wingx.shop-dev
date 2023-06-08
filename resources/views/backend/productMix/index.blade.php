@extends('backend.layouts.app')

@section('title', 'Admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between">
            <h1 class="h3 mb-0 w-100 text-gray-800">產品組合管理</h1>
        </div>

        <div class="d-sm-flex align-items-center justify-content-between">
            <h5 class="my-3 w-100">產品：{{ $product->name }}</h5>
        </div>

        <button onclick="add_row()" class="btn btn-success mb-3">
            <i class="fa-solid fa-circle-plus"></i>
        </button>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" data-order='[[ 0, "desc" ]]' id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 10%">ID</th>
                                <th style="width: 15%">產品組合 1</th>
                                <th style="width: 15%">產品組合 2</th>
                                <th style="width: 10%">金額</th>
                                <th style="width: 10%">排序</th>
                                <th style="width: 8%">編輯</th>
                                <th style="width: 8%">刪除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productMixes as $key => $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->product_mix1_name }}</td>
                                <td>{{ $value->product_mix2_name }}</td>
                                <td>{{ $value->price }}</td>
                                <td>{{ $value->sort }}</td>
                                <td>
                                    <button class="btn btn-primary" onclick="edit_row({{ $value->id }})">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-danger" onclick="delete_row({{ $value->id }}, {{ $product_id }})">
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
    $(function(){
        $('#dataTable').DataTable({
            columnDefs: [{
                targets: [4, 5],
                orderable: false
            }],
            "language": {
                "url": "/admin/zh-HANT.json"
            }
        })

    })

    let product_id = '{{ $product_id }}'

    const edit_row = (id) => {
        location.href = '/backend/product/mix/' + product_id + '/' + id + '/edit';
    }

    const add_row = () => {
        location.href = '/backend/product/mix/' + product_id + '/create';
    }

    const delete_row = (id, product_id) => {
        if(confirm('確定刪除？')){
            location.href = '/backend/product/mix/delete/' + id + '/' + product_id;
        }
    }
</script>
@endsection
