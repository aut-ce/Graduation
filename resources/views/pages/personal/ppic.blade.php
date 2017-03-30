@extends('layouts.app')

@push('styles')
<style>
    body {
        background: url('/img/3.jpg') no-repeat fixed;
        background-size: cover;
    }
</style>
@endpush

@section('content')
    <div class="wrapper home personal">
        <div class="header header-filter">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 ">
                        <div class="brand">
                            <h2 class="">{{'ورودی‌های ۹۲ دانشکده کامپیوتر'}}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @include('pages.personal.nav',['active'=>'ppic'])
                    <div class="col-md-8 col-md-offset-2 form-dialog">
                        <form class="question-from" action="" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="file" class="ppic-input" style="display: none;" name="ppic">
                            <h3 class="text-muted">{{'عکس پروفایل در نشریه'}}</h3>
                            <div class="row">
                                <div class="col-xs-6 col-md-4 col-xs-offset-3 col-md-offset-4 text-center">
                                    <img src="{{$ppic}}" alt="{{'عکس پرفایل'}}"
                                         class="img-rounded img-responsive img-raised">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-md-4 col-xs-offset-3 col-md-offset-4 text-center">
                                    <div class="btn btn-info add-ppic-button">{{'بارگذاری عکس'}}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-9"></div>
                                <div class="col-xs-3">
                                    <button class="btn btn-success submit-button">{{'ثبت'}}
                                        <div class="ripple-container"></div>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(function () {
        $('.add-ppic-button').click(function() {
            $('form .ppic-input').click();
            $("form .ppic-input").change(function () {
                readURL($('form .ppic-input')[0], '.img-rounded');
            });
        });
        $('button.submit-button').click(function (e) {
            $('form').submit();
        })
    })
</script>
@endpush
