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
                    <table class="table table-bordered" data-order='[[ 0, "desc" ]]' id="dataTable" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 5%">ID</th>
                                <th style="width: 10%">訂單編號</th>
                                <th style="width: 15%">訂購者</th>
                                <th style="width: 20%">訂購產品</th>
                                <th style="width: 6%">金額</th>
                                <th style="width: 6%">運費</th>
                                <th style="width: 8%">運送方式</th>
                                <th style="width: 6%">總金額</th>
                                <th style="width: 8%">付款類別</th>
                                <th style="width: 8%">付款狀態</th>
                                <th style="width: 10%">手動付款狀態</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->order_no }}</td>
                                    <td>收件者：{{ $value->name }} <br>
                                        收件地址：{{ $value->zipcode }}{{ $value->county }}{{ $value->district }}{{ $value->address }}
                                        <br> E-mail：{{ $value->member_email }}</td>
                                    <td>
                                        @foreach ($value['product'] as $detail)
                                            <span style="font-weight: 600">{{ $detail['name'] }} </span> <br>
                                            {!! $detail['items'] !!} <br>
                                        @endforeach
                                    </td>
                                    <td>{{ $value->total }}</td>
                                    <td>{{ $value->ship_price }}</td>
                                    <td>
                                        @if ($value['ship_price'] == 80)
                                            中華郵政
                                        @elseif($value['ship_price'] == 150)
                                            宅配
                                        @endif
                                    </td>
                                    <td>{{ $value->ttl_price }}</td>
                                    <td>{{ $value['payment_name'] }}</td>
                                    <td>{!! $value->status_name !!}</td>
                                    <td>
                                        <select class="form-control"
                                            onchange="manualStatus({{ $value->id }}, this.value)">
                                            <option value="0" @if ($value->manual_status == 0) selected @endif>未設定
                                            </option>
                                            <option value="1" @if ($value->manual_status == 1) selected @endif>已付款
                                            </option>
                                            <option value="2" @if ($value->manual_status == 2) selected @endif>已取消
                                            </option>
                                        </select>
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
                    targets: [3, 4],
                    orderable: false
                }],
                "language": {
                    "url": "/admin/zh-HANT.json"
                }
            })

        })

        const manualStatus = (id, manual_status) => {
            $.post('/api/order/setManualStatus', {
                id: id,
                manual_status: manual_status
            }, function(data) {
                if (data.status == 'success') {
                    alert('更新成功')
                } else {
                    alert('更新失敗')
                }
            })
        }
    </script>
@endsection
