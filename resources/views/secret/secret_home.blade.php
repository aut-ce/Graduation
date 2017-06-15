@extends('layouts.app')

@push('styles')
<style>
    body {
        background: url('/img/7.jpg') no-repeat fixed;
        background-size: cover;
    }
</style>
@endpush

@section('content')
    <a href="{{route('landing')}}" class="btn btn-danger return-home">{{'بازگشت'}}</a>
    <div class="wrapper home">
        <div class="header header-filter">
            <div class="container">

                <div class="row sharing-area text-center">
                    <h3 class="brand">{{'پنل ادمین مخفی'}}</h3>
                    <a href="{{route('secret.cover')}}" class="btn btn-raised btn-google-plus sharrre">
                        {{'کاور'}}
                    </a>
                    <a href="{{route('secret.articles')}}?for=1" class="btn btn-raised btn-facebook sharrre">
                        {{'متن ها بچه ها '}}
                    </a>
                    <a href="{{route('secret.writtenArticles')}}" id="twitter" class="btn btn-raised btn-twitter sharrre">
                        {{'متن نوشته شده'}}
                    </a>
                    <a href="{{route('secret.userList')}}" id="twitter" class="btn btn-raised btn-facebook sharrre">
                        {{'لیست کاربران'}}
                    </a>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="description">
                            <h3>{{'سلام'}}</h3>
                            <h4>{{'اسپای ها'}}</h4>
                            <ul>
                                <li>{{'سجاد'}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection