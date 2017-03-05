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
                                <div class="form-group col-xs-6 col-xs-of label-floating is-empty participation-number" style="display: none;">
                                    <label class="control-label">{{'تعداد افراد'}}</label>
                                    <input type="number" class="form-control" name="number">
                                    <span class="material-input"></span>
                                </div>
                                <div class="form-group col-xs-6 col-xs-of label-floating is-empty pull-right">
                                    <div class="part-checkbox checkbox" style="text-align: right">
                                        <label>
                                            <span style="margin-right: 10px;">{{'شرکت میکنم'}}</span>
                                            <input type="checkbox" name="participation">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-6 col-xs-of label-floating is-empty pull-right">
                                    <label class="control-label">{{'ایمیل'}}</label>
                                    <input  type="email" name="email" class="form-control" style="direction: ltr;text-align: right" required>
                                    <span class="material-input"></span>
                                </div>
                                <div class="form-group col-xs-6 col-xs-of label-floating is-empty">
                                    <label class="control-label">{{'شماره تلفن'}}</label>
                                    <input type="number" name="phone" class="form-control" required>
                                    <span class="material-input"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-xs-9 col-xs-of label-floating is-empty pull-right">
                                    <div class="checkbox phone-checkbox" style="text-align: right">
                                        <label style="margin-right: 20px;">
                                            <span style="margin-right: 10px;">{{'نمایش داده نشود'}}</span>
                                            <input type="checkbox" name="show_phone">
                                        </label>
                                        <h6 style="display: inline-block">{{'آیا میخواهید شماره تلفن شما در مجله فارق التحصیلی نمایش داده شود؟'}}</h6>
                                    </div>
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
        $('.ask-participation .part-checkbox input').on('change',function (e) {
            var span = $(this).prev();
            var participation_number =  $('.ask-dialog .participation-number');
            if(this.checked == false){
                span.html('شرکت نمیکنم')
                span.css('color','#f55145')
                participation_number.hide('fast');
            }
            else{
                participation_number.show('fast');
                span.html('شرکت میکنم')
                span.css('color','#55b559')

            }
        })
        $('.ask-participation .phone-checkbox input').on('change',function (e) {
            var span = $(this).prev();
            if(this.checked == false){
                span.html('نمایش داده نشود')
                span.css('color','#f55145')
            }
            else{
                span.html('نمایش داده شود')
                span.css('color','#55b559')

            }
        })
        $('.ask-participation .checkbox span').css('color','#f55145');
        $('form.ask-from').submit(function() {
            if(!($('input[type="number"][name="phone"]').eq(0).val().match(/09\d{9}/g))){
                toastr.error('شماره تلفن را درست وارد کنید')
                return false;
            }
            var conf = 1;
            if(!$('.ask-participation .part-checkbox input').prop("checked")){
                conf = window.confirm('از این که در جشن شرکت نمیکنید مطمئن هستید؟');
            }
            if(!$('input[type="number"][name="number"]').val()){
                toastr.error('تعداد افراد را وارد کنید');
                return false;
            }
            if(!conf)
                return false;
        });

    })
</script>
@endpush