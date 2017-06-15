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
    <a href="{{route('landing')}}" class="btn btn-danger return-home">{{'بازگشت'}}</a>
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
                    @include('pages.content.nav',['active'=>'list'])
                    <div class="list col-md-8 col-md-offset-2 form-dialog">
                        <h3 class="text-muted">{{'مطالب ارسالی'}}</h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>{{'عنوان'}}</th>
                                <th>{{'نوع'}}</th>
                                <th>{{'برای'}}</th>
                                <th>{{'تاریخ'}}</th>
                                <th>{{'عملیات'}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($content as $key => $item)
                                <tr>
                                    <td class="text-center">{{$key+1}}</td>
                                    <td>{{$item['title']}}</td>
                                    <td>{{isset($item['path'])?'فایل':'مقاله'}}</td>
                                    <td>{{isset($item['texter'])?user_to_name($item['texter']):''}}</td>
                                    <td>{{dateFormat($item['updated_at'])}}</td>
                                    @if(isset($item['path']))
                                        <td class="td-actions text-right">
                                            <a href="{{route('content.file',$item)}}" class="btn btn-success btn-simple btn-xs" rel="tooltip"
                                                    title="{{'ویرایش'}}" type="button"><i class="fa fa-edit"></i></a>
                                            <a href="{{route('content.fileDelete',$item)}}" class="btn btn-danger btn-simple btn-xs" rel="tooltip" title={{'حذف'}}
                                                    type="button"><i class="fa fa-times"></i></a>
                                        </td>
                                    @else
                                        <td class="td-actions text-right">
                                            @if($item['cover'])
                                            <a href="{{route('content.article',$item)}}?cover=1" class="btn btn-success btn-simple btn-xs" rel="tooltip"
                                                    title="{{'ویرایش'}}" type="button"><i class="fa fa-edit"></i></a>
                                            @else
                                                <a href="{{route('content.article',$item)}}" class="btn btn-success btn-simple btn-xs" rel="tooltip"
                                                   title="{{'ویرایش'}}" type="button"><i class="fa fa-edit"></i></a>
                                            @endif
                                            <a href="{{route('content.articleDelete',$item)}}" class="btn btn-danger btn-simple btn-xs" rel="tooltip" title={{'حذف'}}
                                                    type="button"><i class="fa fa-times"></i></a>
                                        </td>
                                    @endif
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

@push('scripts')
<script>
    $(function () {

    })
</script>
@endpush
