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
                    @include('pages.personal.nav',['active'=>'cover'])
                    <div class="col-md-8 col-md-offset-2 form-dialog">
                        <form class="question-from" action="" method="post">
                            {{csrf_field()}}
                            <h3 class="text-muted">{{'کلمات نقاشی کاور در نشریه'}}</h3>
                            <div class="row">
                                <div class="form-group col-xs-12 label-floating pull-right {{isset($cover_words) && $cover_words =='' ? 'is-empty': ""}}">
                                    <label class="control-label">{{'کلمات نقاشی کاور در نشریه'}}</label>
                                    <textarea type="text" name="cover_words" class="form-control" rows="5"
                                              style="text-align: right">{{isset($cover_words) ? $cover_words : ""}}</textarea>
                                    <span class="material-input"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6 col-md-9"></div>
                                <div class="col-xs-6 col-md-3">
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
        $('button.submit-button').click(function (e) {
            var number = $('.question-from textarea').filter(function () {
                return this.value == "";
            }).length;
            if (number > 0) {
                e.preventDefault();
                toastr.error('لطفا کلمات نقاشی کاور را وارد کنید');
            }
        })
    })
</script>
@endpush
