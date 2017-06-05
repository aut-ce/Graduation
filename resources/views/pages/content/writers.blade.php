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
                    @include('pages.content.nav',['active'=>'writers'])
                    <div class="list col-md-8 col-md-offset-2 form-dialog">
                        <h3 class="text-muted">{{'کی چقد نوشته واسه شما'}}</h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>{{'نام'}}</th>
                                <th>{{'متن'}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center">{{1}}</td>
                                <td><strong>{{'کاور'}}</strong></td>
                                <td>
                                    @if($cover > 4 )
                                        <span class="label label-success">{{$cover}}</span>
                                    @elseif($cover == 4)
                                        <span class="label label-info">{{$cover}}</span>
                                    @else
                                        <span class="label label-danger">{{$cover}}</span>
                                    @endif
                                </td>
                            </tr>
                            <?php $i = 1 ?>
                            @foreach($articles as $key => $item)
                                <?php $i++ ?>
                                <tr>
                                    <td class="text-center">{{$i}}</td>
                                    <td>{{$key}}</td>
                                    <td>
                                        @if(isset($item['text']) &&  $item['text'] >1 )
                                            <span class="label label-success">{{$item['text']}}</span>
                                        @elseif(isset($item['text']) &&  $item['text'] = 1)
                                            <span class="label label-info">{{$item['text']}}</span>
                                        @else
                                            <span class="label label-danger">0</span>
                                        @endif
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
