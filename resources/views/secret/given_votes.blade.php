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
    <a href="{{route('secret.home')}}" class="btn btn-danger return-home">{{'بازگشت'}}</a>
    <div class="wrapper home content">
        <div class="header header-filter">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 ">
                        <div class="brand">
                            <h2 class="">{{'ورودی‌های ۹۲ دانشکده کامپیوتر'}}</h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-md-offset-3 form-dialog" style="background-color:rgba(255,255,255,.7);">
                        <div class="bests-from">
                            <h3 class="text-muted">{{'رای های ترین: '}}{{$user['first_name'].' '.$user['last_name']}} </h3>
                            <form class="row" action="{{route('secret.givenVotes')}}" style="display:flex;background-color: #fff;padding: 10px">
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
                    <div class="list col-md-6 col-md-offset-3 form-dialog">
                        <h3 class="text-muted">{{'لیست کاربران'}}</h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{'عنوان ترین'}}</th>
                                <th>{{'تعداد رای'}}</th>
                                <th>{{'عملیات'}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($answers as $key => $value)
                                <tr>
                                    <td>{{$titles[$key]}}</td>
                                    <td>
                                        @if($value >= 10)
                                            <span class="label label-success">{{$value}}</span>
                                        @elseif($value >= 5)
                                            <span class="label label-info">{{$value}}</span>
                                        @else
                                            <span class="label label-danger">{{$value}}</span>
                                        @endif
                                    </td>
                                    <td class="td-actions text-right">
                                        <a href="{{route('secret.givenVotesDetails')}}?username={{$user['email']}}&key={{$key}}"
                                           class="btn btn-success btn-simple btn-xs" rel="tooltip" title="{{'جزییات رای ها'}}" type="button">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

