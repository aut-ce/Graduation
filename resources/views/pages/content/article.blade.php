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
                    @include('pages.content.nav',['active'=>'article'])
                    <div class="col-md-8 col-md-offset-2 form-dialog">
                        <form class="article-from" action="{{route('content.articleAction',$article->_id)}}" method="post"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            @if($cover)
                                <input type="hidden" name="cover" value="1">
                                <h3 class="text-muted">{{'ارسال کلمه برای کاور'}}</h3>
                            @elseif($for || $article['texter'])
                                <h3 class="text-muted">{{'ارسال مطلب مطلب برای صفحه دوستان'}}</h3>
                            @else
                                <h3 class="text-muted">{{'ارسال مطلب برای نشریه'}}</h3>
                            @endif
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-6 label-floating pull-right {{ $article['title']=='' ? 'is-empty': ""}}">
                                    <label class="control-label">{{'عنوان'}}</label>
                                    @if($cover)
                                        <input type="text" name="title" class="form-control" required readonly
                                               style="text-align: right"
                                               value="کلمه برای کاور">
                                    @else
                                        <input type="text" name="title" class="form-control" required
                                               style="text-align: right"
                                               value="{{$article['title']==-1 || !$article['title'] ?'': $article['title']}}">
                                    @endif
                                    <span class="material-input"></span>
                                </div>
                                @if($for || $article['texter'])
                                    <div class="form-group label-floating col-xs-12 col-sm-6">
                                        <label class="control-label">{{'برای صفحه‌ی:'}}</label>
                                        @include('includes.select2-users-search',[
                                        'select_url'=>route('select.allUsers'),
                                        'default' => isset($article['texter']) ? $article['texter'] : '',
                                        'select_name' => 'texter'
                                        ])
                                    </div>
                                @endif
                                <div class="form-group col-xs-12 label-floating pull-right {{$article['content']=='' ? 'is-empty': ""}}">
                                    <label class="control-label">{{'متن'}}</label>
                                    <textarea type="text" name="description" class="form-control" rows="10" required
                                              style="text-align: right">{{$article['content'] ?: ""}}</textarea>
                                    <span class="material-input"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-4 pull-right picture">
                                    <div class="input-group">
                                        <input type="text" readonly="" class="form-control" value="انتخاب تصویر...">
                                        <span class="input-group-btn input-group-sm">
                                            <button type="button" class="attach btn btn-fa btn-round btn-info btn-sm">
                                                <i class="material-icons">attach_file</i>
                                            </button>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group col-xs-12 col-sm-6 pull-right art-image">
                                    @if($article['picture'])
                                        <img src="{{cdn($article['picture'])}}" alt="">
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6 col-md-9"></div>
                                <div class="col-xs-6 col-md-3">
                                    <button class="btn btn-success submit-button">{{'ثبت'}}
                                        <div class="ripple-container"></div>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(function () {

        $('button.attach').bind('click', function (e) {
            $('.form-group.picture .input-group').append('<input type="file" name="picture" multiple="">');
            $('.form-group.picture input:file').on('change', function () {
                $('.form-group.picture input:text').val($(this).val().split(/(\\|\/)/g).pop())
            })
            $('.form-group.picture input').click();
        })
    })
</script>
@endpush
