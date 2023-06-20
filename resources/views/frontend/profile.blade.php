@extends('frontend.layouts.master')

@section('content')
    <section class="mt-5 container ">
        <section class="replica" id="replica">
            <div class="container">
                <div class="row gy-5">
                    <div class="col-12 text-center">
                        <button class="btn btn-primary" onclick="location.href='/order/list'">訂單列表</button>
                        <button class="btn btn-primary" onclick="location.href='/profile'">個人資料</button>

                    </div>
                    <div class="col-md-12">
                        <div class="text-center">
                            <h5>個人資料</h5>
                        </div>
                        <div class="col-12">
                            <x:form::form method="PUT" id="form_post" enctype="multipart/form-data"
                                :action="route('profile.update', $member->id)" :bind="$member">

                                <div class="mt-3">
                                    <x:form::input name="name" label="名稱" required />
                                </div>

                                <div class="mt-3">
                                    <x:form::input name="email" label="E-mail" readonly />
                                </div>

                                <div class="mt-3">
                                    <x:form::input name="mobile" label="手機號碼" />
                                </div>

                                <div class="form-group">
                                    <div class="twzipcode">
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <select class="form-select" name="county" id="county"
                                                    data-role="county"></select>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <select class="form-select" name="district" id="district"
                                                    data-role="district"></select>
                                            </div>
                                        </div>
                                        <input type="hidden" id="zipcode" name="zipcode" data-role="zipcode" />
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <x:form::input name="address" label="地址" />
                                </div>

                                <div class="mt-3 text-center">
                                    <x:form::button.link class="btn-secondary" href="/">
                                        取消
                                    </x:form::button.link>
                                    <x:form::button.submit id="submit">確認存檔</x:form::button.submit>
                                </div>

                            </x:form::form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection

@section('css')
    <style>

    </style>
@endsection

@section('js')
    <script src="{{ asset('frontend/js/twzipcode.min.js') }}"></script>
    <script>
        $(function() {

            const twzipcode = new TWzipcode();

            twzipcode.set({{ $member->zipcode }})
        })
    </script>
@endsection