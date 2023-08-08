@extends('backend.layouts.app')

@section('title', 'Admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">政策管理 - 新增</h1>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Default Bootstrap Form Controls-->
                <div id="default">
                    <div class="card mb-4">
                        <div class="card-body">
                            <!-- Component Preview-->
                            <div class="sbp-preview">
                                <div class="sbp-preview-content">
                                    <x:form::form method="POST" :action="route('policies.store')">
                                        <div class="mt-3">
                                            <x:form::input name="name" label="政策標題" />
                                        </div>

                                        <div class="mt-3">
                                            <x:form::textarea name="content" label="內容" rows="3" />
                                        </div>

                                        <div class="mt-3 text-center">
                                            <x:form::button.link class="btn-secondary" href="/backend/policies">取消
                                            </x:form::button.link>
                                            <x:form::button.submit id="submit">確認存檔</x:form::button.submit>
                                        </div>

                                    </x:form::form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('/admin/css/simplemde.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('/admin/js/simplemde.min.js') }}"></script>
    <script>
        $(function() {

        })

        var simplemde = new SimpleMDE();

        $('#refresh').on('click', function() {
            let title = stripHtml(simplemde.value())
            title = title.replaceAll('#', '')
            var length = 155;
            var trimmedString = title.substring(0, length);
            console.log(trimmedString)
            $('input[name=description]').val(trimmedString)
        })

        function stripHtml(html) {
            let tmp = document.createElement("div");
            tmp.innerHTML = html;

            return tmp.textContent || tmp.innerText || "";
        }

        // var simplemde = new SimpleMDE({ element: $("#content")[0] });
    </script>
@endsection
