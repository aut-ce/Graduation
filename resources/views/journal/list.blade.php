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
    <a href="{{route('journal.home')}}" class="btn btn-danger return-home">{{'بازگشت'}}</a>
    <div class="wrapper home content">
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
                            <h3 class="text-muted">{{'سوال های کوتاه پاسخ: '}}{{$user['first_name'].' '.$user['last_name']}} </h3>
                            <form class="row" action="" style="display:flex;background-color: #fff;padding: 10px">
                                <div style="width: 50%">
                                    <div class="form-group label-floating {{isset($user) ? '': 'is-empty'}}">
                                        <label class="control-label">{{'شماره دانشجویی'}}</label>
                                        <input type="text" class="form-control" name="username" value="{{isset($user) ? $user['username'] : ""}}">
                                        <span class="material-input"></span></div>
                                </div>
                                <div  style="display: flex;align-items: center;width: 50%;padding: 2rem">
                                    <input type="submit" value="{{'متن های نوشته شده'}}" style="margin: 0" class="btn btn-raised btn-google-plus sharrre">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="list col-md-8 col-md-offset-2 form-dialog">
                        <h3 class="text-muted">{{'مطالب نوشته شده برای:'}}</h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>{{'عنوان'}}</th>
                                <th>{{'نویسنده'}}</th>
                                <th>{{'تاریخ'}}</th>
                                <th>{{'تایید'}}</th>
                                <th>{{'عملیات'}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($content as $key => $item)
                                <tr>
                                    <td class="text-center">{{$key+1}}</td>
                                    <td>{{$item['title']}}</td>
                                    <td>{{isset($item['user'])?user_to_name($item['user']):''}}</td>
                                    <td>{{dateFormat($item['updated_at'])}}</td>
                                    <td class="td-actions text-right">
                                        @if(isset($item['done']) && $item['done'])
                                            <span class="label label-success">{{'بله'}}</span>
                                        @else
                                            <span class="label label-danger">{{'خیر'}}</span>
                                        @endif
                                    </td>
                                    <td class="td-actions text-right">
                                        <a href="{{route('journal.editArt',$item)}}" class="btn btn-success btn-simple btn-xs" rel="tooltip"
                                                title="{{'ویرایش'}}" type="button"><i class="fa fa-edit"></i></a>
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

