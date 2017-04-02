@extends('layouts.app')

@section('content')
    <div class="signup-page g-auth">
        <nav class="navbar navbar-transparent navbar-absolute">
            <div class="container g-auth-header">
                <!-- Brand and toggle get grouped for better mobile display -->
                {{--<div class="navbar-header ">--}}
                    <img src="img/logo.jpg" class="img-raised img-responsive" alt="CEIT">
                    <div class="navbar-brand">{{'جشن فارغ‌التحصیلی ورودی های ۹۲'}}</div>
                {{--</div>--}}

                {{--<div class="collapse navbar-collapse" id="navigation-example">--}}
                    {{--<ul class="nav navbar-nav navbar-right">--}}
                        {{--<li>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            </div>
        </nav>
        <div class="wrapper">
            <div class="header header-filter" style="background: url('img/1.jpg');background-size: 100%;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4  col-sm-6 ">
                            <div class="card card-signup">
                                <form class="form" method="post" action="/register">
                                    {{csrf_field()}}
                                    <div class="header header-info g-flex-center">
                                        <h4>{{'ثبت نام'}}</h4><i class="material-icons g-left-margin6">person_add</i>
                                    </div>
                                    <p class="text-divider">{{'برای غیر ۹۲ ایا'}}</p>
                                    <div class="content">
                                        <div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">face</i>
										</span>
                                            <input type="text" required name="name" class="form-control" placeholder="{{'نام ...'}}">
                                        </div>

                                        <div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">email</i>
										</span>
                                            <input type="email"  required name="email" class="form-control" placeholder="{{'ایمیل ...'}}">
                                        </div>

                                        <div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">lock_outline</i>
										</span>
                                            <input type="password" required name="password" placeholder="{{'رمزعبور ...'}}" class="form-control" />
                                        </div>

                                    </div>
                                    <div class="footer text-center">
                                        <input type="submit" value="ثبت نام" class="btn btn-simple btn-primary btn-lg">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-4 hidden-sm"></div>
                        <div class="col-md-4  col-sm-6 ">
                            <div class="card card-signup">
                                <form class="form" method="post" action="/login">
                                    {{csrf_field()}}
                                    <div class="header header-success g-flex-center">
                                        <h4>{{'ورود'}}</h4><i class="material-icons g-left-margin6">person</i>
                                    </div>
                                    <p class="text-divider">{{'برای ۹۲ ایا'}}</p>
                                    <div class="content">

                                        <div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">face</i>
										</span>
                                            <input name="email" type="text" class="form-control" placeholder="{{'شماره دانشجویی یا ایمیل'}}">
                                        </div>


                                        <div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">lock_outline</i>
										</span>
                                            <input name="password" type="password" placeholder="{{'رمز عبور'}}" class="form-control" />
                                        </div>

                                        <div class="checkbox">
                                            <label>
                                                <input name="remember" type="checkbox" name="optionsCheckboxes">
                                                {{'مرا به خاطرت نگه دار'}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="footer text-center">
                                        <input type="submit" value="ورود" class="btn btn-simple btn-primary btn-lg">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($errors->all())
                    <div class="alert alert-danger container">
                        <div class="container-fluid">
                            <div class="alert-icon">
                                <i class="material-icons">error_outline</i>
                            </div>
                            <button type="button" class="close g-left-margin9" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="material-icons">clear</i></span>
                            </button>
                            {{'خطا: '}} {{ $errors->first() }}
                        </div>
                    </div>
                @endif

                <footer class="footer">
                    <div class="container">
                        <a href="password/reset" class="text-muted">
                            {{'🤔رمز عبور را فراموش کرده‌اید؟'}}
                        </a>
                        <span class="copyright pull-right">
                             made by {{'😝'}} Tim</a>
                        </span>
                    </div>
                </footer>

            </div>

        </div>
    </div>
@endsection


@push('scripts')
<script type="text/javascript">

    $().ready(function () {
        // the body of this function is in assets/material-kit.js
        materialKit.initSliders();
        window_width = $(window).width();

        if (window_width >= 992) {
            big_image = $('.wrapper > .header');

            $(window).on('scroll', materialKitDemo.checkScrollForParallax);
        }

    });
</script>
@endpush

