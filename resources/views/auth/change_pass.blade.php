@extends('layouts.app')


@push('styles')
<style>
    body {
        background: url('/img/5.jpg') no-repeat fixed;
        background-size: cover;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="margin-top: 100px">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center" >{{'تغییر رمز عبور'}}</div>

                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                            <label for="password" class="col-md-2 control-label">{{'رمز عبور'}}</label>
                        </div>

                        <div class="form-group">
                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                            <label for="password-confirm" class="col-md-2 control-label">{{'تکرار رمز عبور'}}</label>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{'تغییر رمز عبور'}}
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
