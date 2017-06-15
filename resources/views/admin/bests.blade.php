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
    <a href="{{ URL::previous() }}" class="btn btn-danger return-home">{{'بازگشت'}}</a>
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
                    <div class="col-md-10 col-md-offset-1 form-dialog" style="background-color:rgba(255,255,255,.7);">
                        <div class="bests-from">
                            <h3 class="text-muted">{{'ترین های دانشکده'}}</h3>
                            <div class="row">
                                <div class="col-xs-6 col-sm-3">
                                    <h4>{{'نفر سوم'}}</h4>
                                </div>
                                <div class="col-xs-6 col-sm-3">
                                    <h4>{{'نفر دوم'}}</h4>
                                </div>
                                <div class="col-xs-6 col-sm-3">
                                    <h4>{{'نفر اول'}}</h4>
                                </div>
                                <div class="col-xs-6 col-sm-3">
                                    <h4>{{'عنوان ترین'}}</h4>
                                </div>


                            </div>
                            @foreach($answers as $key => $q)
                                <div class="row">

                                    <div class="form-group col-xs-6 col-sm-3 pull-right">
                                        <h4>{{$titles[$key]}}</h4>
                                    </div>
                                    <div class="form-group col-xs-6 col-sm-3 pull-right">
                                        <h5>
                                            @if(count($q))
                                                @if($q[0]['num']>=10)
                                                    <span class="label label-success">{{$q[0]['num']}}</span>
                                                @elseif($q[0]['num']>=5)
                                                    <span class="label label-info">{{$q[0]['num']}}</span>
                                                @else
                                                    <span class="label label-danger">{{$q[0]['num']}}</span>
                                                @endif
                                                {{id_to_name($q[0]['id'])}}
                                            @endif
                                        </h5>
                                    </div>
                                    <div class="form-group col-xs-6 col-sm-3 pull-right">
                                        <h5>
                                            @if(count($q)>1)
                                                @if($q[1]['num']>=10)
                                                    <span class="label label-success">{{$q[1]['num']}}</span>
                                                @elseif($q[1]['num']>=5)
                                                    <span class="label label-info">{{$q[1]['num']}}</span>
                                                @else
                                                    <span class="label label-danger">{{$q[1]['num']}}</span>
                                                @endif
                                                {{id_to_name($q[1]['id'])}}
                                            @endif
                                        </h5>
                                    </div>
                                    <div class="form-group col-xs-6 col-sm-3 pull-right">
                                        <h5>
                                            @if(count($q)>2)
                                                @if($q[2]['num']>=10)
                                                    <span class="label label-success">{{$q[2]['num']}}</span>
                                                @elseif($q[2]['num']>=5)
                                                    <span class="label label-info">{{$q[2]['num']}}</span>
                                                @else
                                                    <span class="label label-danger">{{$q[2]['num']}}</span>
                                                @endif
                                                {{id_to_name($q[2]['id'])}}
                                            @endif
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


