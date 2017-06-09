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
                    @include('pages.content.nav',['active'=>'file'])
                    <div class="col-md-8 col-md-offset-2 form-dialog">
                        <form class="file-from" action="{{route('content.fileAction')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$file['_id']}}">
                            <h3 class="text-muted">{{'ارسال فایل'}}</h3>
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-6 label-floating pull-right {{ $file['title']=='' ? 'is-empty': ""}}">
                                    <label class="control-label">{{'عنوان'}}</label>
                                    <input type="text" name="title" class="form-control" required
                                           style="text-align: right" value="{{$file['title'] ?: ""}}">
                                    <span class="material-input"></span>
                                </div>

                                <div class="form-group col-xs-12 col-sm-6 pull-right file">
                                    <div class="input-group">
                                        <span class="input-group-btn input-group-sm">
                                            <button type="button" class="attach btn btn-fa btn-round btn-info btn-sm">
                                                <i class="material-icons">attach_file</i>
                                            </button>
                                        </span>
                                        <input type="text" readonly="" class="form-control" value="انتخاب فایل...">
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-6 label-floating pull-right {{$file['description']=='' ? 'is-empty': ""}}">
                                    <label class="control-label">{{'توضیحات'}}</label>
                                    <textarea type="text" name="description" class="form-control" rows="5" required
                                              style="text-align: right">{{$file['description'] ?: ""}}</textarea>
                                    <span class="material-input"></span>
                                </div>
                                <div class="form-group col-xs-12 col-sm-6 label-floating pull-right {{ $file['name']=='' ? 'is-empty': ""}}">
                                    <label class="control-label">{{'نام فایل'}}</label>
                                    <input type="text" name="name" class="form-control" required
                                           style="text-align: right" value="{{$file['name'] ?: ""}}">
                                    <span class="material-input"></span>
                                </div>
                                <div class="form-group col-xs-12 col-sm-6 pull-right art-image">
                                    @if($file['path'])
                                        <img src="{{cdn($file['path'])}}" alt="">
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
            $('.form-group.file .input-group').append('<input type="file" name="file" multiple="">');
            $('.form-group.file input:file').on('change', function () {
                $('.form-group.file input:text').val($(this).val().split(/(\\|\/)/g).pop())
            })
            $('.form-group.file input').click();
        })
    })
</script>
@endpush
