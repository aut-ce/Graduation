@extends('layouts.app')

@push('styles')
<style>
    body {
        background: url('/img/2.jpg') no-repeat fixed;
        background-size: cover;
    }
</style>
@endpush

@section('content')
    <a href="{{route('secret.userList')}}" class="btn btn-danger return-home">{{'بازگشت'}}</a>
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
                    <div class="col-md-8 col-md-offset-2 form-dialog" style="background-color:rgba(255,255,255,.7);">
                        <div class="bests-from">
                            <h3 class="text-muted">{{'رای های ترین: '}}{{$user['first_name'].' '.$user['last_name']}} </h3>
                            <form class="row" action="{{route('secret.bests')}}" style="display:flex;background-color: #fff;padding: 10px">
                                <div style="width: 50%">
                                    <div class="form-group label-floating {{isset($user) ? '': 'jis-empty'}}">
                                        <label class="control-label">{{'شماره دانشجویی'}}</label>
                                        <input type="text" class="form-control" name="username" value="{{isset($user) ? $user['username'] : ""}}">
                                        <span class="material-input"></span></div>
                                </div>
                                <div  style="display: flex;align-items: center;width: 50%;padding: 2rem">
                                    <input type="submit" value="{{'رای های ترین'}}" style="margin: 0" class="btn btn-raised btn-google-plus sharrre">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 col-md-offset-2 col-xs-12 form-dialog">
                        <div class="bests-from">
                            <h3 class="text-muted">{{'ترین های دانشکده'}}</h3>
                            @foreach($titles as $key => $q)
                                <div class="row">
                                    <div class="hidden-xs col-sm-2 pull-right"></div>
                                    <div class="form-group col-xs-6 col-sm-4 pull-right">
                                        <h4>{{$q}}</h4>
                                    </div>
                                    <div class="form-group col-xs-6 col-sm-4 pull-right">
                                        @if(isset($answers[$key]))
                                            <h4>{{id_to_name($answers[$key])}}</h4>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


