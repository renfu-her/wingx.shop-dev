@extends('backend.layouts.app')

@section('title', 'Admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">訂單管理</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" data-order='[[ 0, "desc" ]]' id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 5%">ID</th>
                                <th style="width: 15%">訂單編號</th>
                                <th style="width: 10%">訂購者</th>
                                <th style="width: 15%">E-mail</th>
                                <th style="width: 8%">金額</th>
                                <th style="width: 8%">運費</th>
                                <th style="width: 8%">總金額</th>
                                <th style="width: 8%">付款類別</th>
                                <th style="width: 8%">付款狀態</th>
                                <th style="width: 8%">手動付款狀態</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $key => $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->order_no }}</td>
                                <td>{{ $value->member_name }}</td>
                                <td>{{ $value->member_email }}</td>
                                <td>{{ $value->total }}</td>
                                <td>{{ $value->ship_price }}</td>
                                <td>{{ $value->ttl_price }}</td>
                                <td>{{ $value->payment_name }}</td>
                                <td>{!! $value->status_name !!}</td>
                                <td>{!! $value->manual_status_name !!}</td>
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

</script>
@endsection
