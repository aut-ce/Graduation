@extends('layouts.app')

@push('styles')
<style>
    body {
        background: url('/img/8.jpg') no-repeat fixed;
        background-size: cover;
    }
</style>
@endpush

@section('content')
    <a href="{{ route('admin.home') }}" class="btn btn-danger return-home">{{'بازگشت'}}</a>

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
                            <h3 class="text-muted">{{'کاور های نوشته شده توسط بچه ها برای: '}}{{$user['first_name'].' '.$user['last_name']}} </h3>
                            <form class="row" action="{{route('journal.cover')}}" style="display:flex;background-color: #fff;padding: 10px">
                                <div style="width: 50%">
                                    <div class="form-group label-floating {{isset($user) ? '': 'jis-empty'}}">
                                        <label class="control-label">{{'شماره دانشجویی'}}</label>
                                        <input type="text" class="form-control" name="username" value="{{isset($user) ? $user['username'] : ""}}">
                                        <span class="material-input"></span></div>
                                </div>
                                <div  style="display: flex;align-items: center;width: 50%;padding: 2rem">
                                    <input type="submit" value="{{'کاور'}}" style="margin: 0" class="btn btn-raised btn-google-plus sharrre">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="card card-nav-tabs ">
                            <div class="header header-success">
                                <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                        <ul class="nav nav-tabs" data-tabs="tabs" style="display: flex;justify-content: flex-end">
                                            <li class="active">
                                                <a href="#profile" data-toggle="tab">
                                                    <i class="material-icons">face</i>
                                                    {{$confirm ? 'تایید شده' : 'تایید نشده'}}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="content">
                                <div class="tab-content text-center">
                                    <div class="tab-pane active" id="settings">
                                        @foreach(explode("\r\n",$covers) as $p)
                                            <p style="direction: rtl;">{{$p}}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--for each cover--}}
                @foreach([] as $cover)
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="card card-nav-tabs ">
                                <div class="header header-success">
                                    <div class="nav-tabs-navigation">
                                        <div class="nav-tabs-wrapper">
                                            <ul class="nav nav-tabs" data-tabs="tabs" style="display: flex;justify-content: flex-end">
                                                <li class="active">
                                                    <a href="#profile" data-toggle="tab">
                                                        <i class="material-icons">face</i>
                                                        {{$cover['user']['first_name']}} {{$cover['user']['last_name']}}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="content">
                                    <div class="tab-content text-center">
                                        <div class="tab-pane active" id="settings">
                                            @foreach(explode("\r\n",$cover['content']) as $p)
                                            <p style="direction: rtl;">{{$p}}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                    @if($cover['picture']!= -1)
                                        <div style="width: 100%;display: flex;justify-content: center">
                                            <img src="{{cdn($cover['picture'])}}" style="max-width: 20rem">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <br><br>
            </div>
        </div>
    </div>
@endsection


