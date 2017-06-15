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
                            <h3 class="text-muted">{{'رای های ترین: '}}{{$user['first_name'].' '.$user['last_name']}} {{'برای :'.$title}}</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="list col-md-6 col-md-offset-3 form-dialog">
                        <h3 class="text-muted">{{'لیست کاربران'}}</h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{'#'}}</th>
                                <th>{{'نام'}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=0 ?>
                            @foreach($users as  $u)
                                <?php $i++ ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>
                                        {{id_to_name($u)}}
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

