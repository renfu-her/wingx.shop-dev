@extends('frontend.layouts.master')

@section('content')
    <section class="replica" id="replica">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="form text-center" style="margin-top: 150px; margin-bottom: 250px">
                        @if ($status == 'success')
                            <h2>已完成訂單，謝謝！</h2><br>
                        @elseif($status == 503)
                            <h2>{{ $message }}</h2><br>
                        @else
                            <h2>訂單未完成，請重新確認您的訂單與付款項目</h2><br>
                        @endif
                        <h3>系統將於 5 秒之後，返回首頁</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
@endsection

@section('js')
    <script>
        setTimeout(function() {
            window.location.href = '/';
        }, 5000);
    </script>
@endsection
