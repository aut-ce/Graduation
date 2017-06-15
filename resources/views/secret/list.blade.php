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
                    <div class="list col-md-12 form-dialog">
                        <h3 class="text-muted">{{'لیست کاربران'}}</h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>{{'شماره دانشجویی'}}</th>
                                <th>{{'نام و نام خانوادگی'}}</th>
                                <th>{{'متن های نوشته شده'}}</th>
                                <th>{{'متون صفحه'}}</th>
                                <th>{{'کاور های نوشته شده'}}</th>
                                <th>{{'کاور های صفحه'}}</th>
                                <th>{{'ترین'}}</th>
                                <th>{{'ترین اساتید'}}</th>
                                <th>{{'ترین داده شده'}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = $current*25 ?>
                            @foreach($users as $key => $user)
                                <?php $i++ ?>
                                <tr>
                                    <td class="text-center">{{$i}}</td>
                                    <td>{{$user['username']}}</td>
                                    <td>{{$user['first_name'].' '.$user['last_name']}}</td>
                                    <td class="td-actions text-right">
                                        <a href="{{route('secret.writtenArticles')}}?username={{$user['email']}}"
                                           class="btn btn-default btn-simple btn-xs" rel="tooltip" title="{{'متون ارسالی توسط این کاربر'}}" type="button">
                                            <i class="fa fa-edit"></i></a>
                                        <?php $count= $user->writtenArticlesCount(); if($count){?>
                                            <span class="label label-default">{{$count}}</span>
                                        <?php } ?>
                                    </td>
                                    <td class="td-actions text-right">
                                        <a href="{{route('secret.articles')}}?username={{$user['email']}}"
                                           class="btn btn-primary btn-simple btn-xs" rel="tooltip" title="{{'متون نوشته شده برای این کاربر'}}" type="button">
                                            <i class="fa fa-file-text-o"></i>
                                        </a>
                                        <?php $count= $user->articlesCount(); if($count){?>
                                            <span class="label label-primary">{{$count}}</span>
                                        <?php } ?>
                                    </td>
                                    <td class="td-actions text-right">
                                        <a href="{{route('secret.writtenCover')}}?username={{$user['email']}}"
                                           class="btn btn-info btn-simple btn-xs" rel="tooltip" title="{{'کاور های نوشته شده توسط این کاربر'}}" type="button">
                                            <i class="fa fa-file-text"></i>
                                        </a>
                                        <?php $count= $user->writtenCoversCount(); if($count){?>
                                            <span class="label label-info">{{$count}}</span>
                                        <?php } ?>
                                    </td>
                                    <td class="td-actions text-right">
                                        <a href="{{route('secret.cover')}}?username={{$user['email']}}"
                                           class="btn btn-success btn-simple btn-xs" rel="tooltip" title="{{'کاور های نوشته شده برای این کاربر'}}" type="button">
                                            <i class="fa fa-file-o"></i>
                                        </a>
                                        <?php $count= $user->coversCount(); if($count){?>
                                            <span class="label label-success">{{$count}}</span>
                                        <?php } ?>
                                    </td>
                                    <td class="td-actions text-right">
                                        <a href="{{route('secret.bests')}}?username={{$user['email']}}"
                                           class="btn btn-warning btn-simple btn-xs" rel="tooltip" title="{{'رای های ترین این کاربر'}}" type="button">
                                            <i class="fa fa-chain-broken"></i>
                                        </a>
                                    </td>
                                    <td class="td-actions text-right">
                                        <a href="{{route('secret.instBests')}}?username={{$user['email']}}"
                                           class="btn btn-success btn-simple btn-xs" rel="tooltip" title="{{'رای های ترین اساتید این کاربر'}}" type="button">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </td>
                                    <td class="td-actions text-right">
                                        <a href="{{route('secret.givenVotes')}}?username={{$user['email']}}"
                                           class="btn btn-primary btn-simple btn-xs" rel="tooltip" title="{{'رای های داده شده به این کاربر'}}" type="button">
                                            <i class="fa fa-paragraph"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div style="display: flex;justify-content: center">
                            <ul class="pagination pagination-primary">
                                @for($i=0; $i<$pages; $i++)
                                    <li class="{{$current == ($i) ? 'active' : ''}}" ><a  href="{{route('secret.userList',$i)}}">{{$i+1}}</a></li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

