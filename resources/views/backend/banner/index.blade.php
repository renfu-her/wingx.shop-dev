@extends('backend.layouts.app')

@section('title', 'Admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Banner 管理</h1>
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
                                <th style="width: 20%">圖檔</th>
                                <th style="width: 10%">狀態</th>
                                <th style="width: 8%">編輯</th>
                                <th style="width: 8%">刪除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($banners as $key => $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>
                                    <img src="{!! $value->image_url !!}" class="w-100" alt="">
                                </td>
                                <td>{{ $value->status_name }}</td>

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
    $(function(){
        $('#dataTable').DataTable({
            columnDefs: [{
                targets: [3, 4],
                orderable: false
            }],
            "language": {
                "url": "/admin/zh-HANT.json"
            }
        })

    })

    const edit_row = (id) => {
        location.href = '/backend/banner/' + id + '/edit';
    }

    const add_row = () => {
        location.href = '/backend/banner/create';
    }


    const delete_row = (id) => {
        if(confirm('確定刪除？')){
            location.href = '/backend/product/destory/' + id;
        }
    }
</script>
@endsection
