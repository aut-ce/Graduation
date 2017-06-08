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
                            <h3 class="text-muted">{{'متن های نوشته شده برای من: '}} </h3>
                        </div>
                    </div>
                </div>

                @foreach($articles as $article)
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="card card-nav-tabs ">
                                <div class="header header-success">
                                    <div class="nav-tabs-navigation">
                                        <div class="nav-tabs-wrapper">
                                            <ul class="nav nav-tabs" data-tabs="tabs" style="display: flex;justify-content: flex-end">
                                                <li class="active">
                                                    <a href="#profile" data-toggle="tab">
                                                        <i class="material-icons">title</i>
                                                        {{$article['title']}}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#profile" data-toggle="tab">
                                                        <i class="material-icons">face</i>
                                                        {{$article['user']['first_name']}} {{$article['user']['last_name']}}
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="content">
                                    <div class="tab-content text-center">
                                        <div class="tab-pane active" id="settings">
                                            @foreach(explode("\r\n",$article['content']) as $p)
                                            <p style="direction: rtl;">{{$p}}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                    @if($article['picture']!= -1)
                                        <div style="width: 100%;display: flex;justify-content: center">
                                            <img src="{{cdn($article['picture'])}}" style="max-width: 20rem">
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


