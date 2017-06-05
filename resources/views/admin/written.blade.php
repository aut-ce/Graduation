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
                            <h3 class="text-muted">{{'متن های نوشته شده توسط بچه ها'}}</h3>
                            @foreach($written as $key => $value)
                                <div class="row">
                                    <div class="hidden-xs col-sm-2 pull-right"></div>
                                    <div class="form-group col-xs-6 col-sm-4 pull-right">
                                        <h4>{{id_to_name($key)}}</h4>
                                    </div>
                                    <div class="form-group col-xs-3 col-sm-3 pull-right">
                                        <h5>
                                            {{--@if(isset($value['cover']) &&  $value['cover'] !=0 )--}}
                                                {{--<span class="label label-info">{{$value['cover']}}</span>--}}
                                            {{--@else--}}
                                                {{--<span class="label label-danger">0</span>--}}
                                            {{--@endif--}}
                                            {{'پنهان شده'}}
                                        </h5>

                                    </div>

                                    <div class="form-group col-xs-3 col-sm-3 pull-right">
                                        <h5>
                                            @if(isset($value['art']) &&  $value['art'] !=0 )
                                                <span class="label label-info">{{$value['art']}}</span>
                                            @else
                                                <span class="label label-danger">0</span>
                                            @endif
                                            {{'متن برای دوستان'}}
                                        </h5>

                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


