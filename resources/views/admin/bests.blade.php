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
                            <h3 class="text-muted">{{'ترین های دانشکده'}}</h3>
                            @foreach($answers as $key => $q)
                                <div class="row">
                                    <div class="hidden-xs col-sm-2 pull-right"></div>
                                    <div class="form-group col-xs-6 col-sm-4 pull-right">
                                        <h4>{{$titles[$key]}}</h4>
                                    </div>
                                    <div class="form-group col-xs-6 col-sm-4 pull-right">
                                        <h5>
                                            @if(count($q))
                                                @if($q[0]['num']>=10)
                                                    <span class="label label-success">{{$q[0]['num']}}</span>
                                                @else
                                                    <span class="label label-info">{{$q[0]['num']}}</span>
                                                @endif
                                                {{inst_id_to_name($q[0]['id'])}}
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


