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
                    <div class="main-nav col-md-6 col-md-offset-3 col-xs-12 text-center">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="active"><a href="#dashboard">
                                    <i class="material-icons">dashboard</i>
                                    {{'سوالات کوتاه پاسخ'}}
                                </a></li>
                            <li class=""><a href="#schedule">
                                    <i class="material-icons">schedule</i>
                                    {{'صفحه دوستان'}}
                                </a></li>
                            <li class=""><a href="#tasks">
                                    <i class="material-icons">list</i>
                                    {{'نشریه'}}
                                </a></li>
                        </ul>
                    </div>

                    <div class="col-md-8 col-md-offset-2 form-dialog">
                        <form class="mini-question-from" action="" method="post">
                            {{csrf_field()}}
                            <h3 class="text-muted">{{'سوالات کوتاه پاسخ'}}</h3>
                            <div class="row">
                                @foreach($questions as $key=>$q)
                                    <div class="form-group col-xs-12 col-sm-6 label-floating is-empty pull-right">
                                        <label class="control-label">{{$q}}</label>
                                        <input type="text" name="q[{{$q}}]" class="form-control"
                                               style="text-align: right" required>
                                        <span class="material-input"></span>
                                    </div>
                                @endforeach
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
