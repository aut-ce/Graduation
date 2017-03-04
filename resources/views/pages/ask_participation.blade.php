@extends('layouts.app')

@section('content')
    <div class="wrapper ask-participation">
        <div class="header header-filter" style="background-image: url('/img/2.jpg');">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 ask-dialog">
                        <form class="ask-from" action="" method="post">
                            {{csrf_field()}}
                            <h3 class="text-muted">{{'آیا در جشن فارق التحصیلی ورودی ۹۲ شرکت میکنید ؟'}}</h3>
                            {{'در صورتی که شرکت میکنید تعداد را با احتساب خود وارد کنید:'}}
                            <div class="row">
                                <div class="form-group col-xs-6 col-xs-of label-floating is-empty">
                                    <div class="checkbox" style="text-align: right">
                                        <label>
                                            <span style="margin-right: 10px;">{{'شرکت میکنم'}}</span>
                                            <input type="checkbox" name="optionsCheckboxes">
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-xs-6 col-xs-of label-floating is-empty">
                                    <label class="control-label">{{'تعداد افراد'}}</label>
                                    <input type="email" class="form-control">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-6 col-xs-of label-floating is-empty">
                                    <label class="control-label">{{'ایمیل'}}</label>
                                    <input  type="email" class="form-control" style="direction: ltr;text-align: right" required>
                                    <span class="material-input"></span>
                                </div>
                                <div class="form-group col-xs-6 col-xs-of label-floating is-empty">
                                    <label class="control-label">{{'شماره تلفن'}}</label>
                                    <input type="number" class="form-control" required>
                                    <span class="material-input"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-9"></div>
                                <div class="col-xs-3">
                                    <button class="btn btn-success submit-button">{{'ثبت'}}<div class="ripple-container"></div></button>
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
        $('.ask-participation .checkbox input').on('change',function (e) {
            var span = $(this).prev();
            if(this.checked == false){
                span.html('شرکت نمیکنم')
                span.css('color','#f55145')
            }
            else{
                span.html('شرکت میکنم')
                span.css('color','#55b559')

            }
        })
        $('.ask-participation .checkbox span').eq(0).css('color','#f55145');
        $('form.ask-from').submit(function(e) {
            if($('input[type="number"]').eq(0).val().match(/09\d{9}/g)){

                return false;
            }
        });

    })
</script>
@endpush