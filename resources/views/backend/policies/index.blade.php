@extends('backend.layouts.app')

@section('title', 'Admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">政策管理</h1>
        </div>

        <button onclick="add_row()" class="btn btn-success mb-3">
            <i class="fa-solid fa-circle-plus"></i>
        </button>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 80%">標題</th>
                                <th>編輯</th>
                                <th>刪除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($policies as $key => $value)
                                <tr>
                                    <td>{{ $value->name }}</td>

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
                    targets: [2],
                    orderable: false
                }],
                "language": {
                    "url": "/admin/zh-HANT.json"
                }
            })

        })

        const edit_row = (id) => {
            location.href = '/backend/policies/' + id + '/edit';
        }

        const add_row = () => {
            location.href = '/backend/policies/create';
        }

        const delete_row = (id) => {
            location.href = '/backend/policies/delete/' + id;
        }
    </script>
@endsection
