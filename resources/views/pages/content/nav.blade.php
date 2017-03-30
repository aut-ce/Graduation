<div class="main-nav col-md-6 col-md-offset-3 col-xs-12 text-center">
    <ul class="nav nav-pills" role="tablist">
        <li class="{{$active == 'file' ? 'active' : ''}}"><a href="{{route('content.file')}}">
                <i class="material-icons">dashboard</i>
                {{'ارسال فایل'}}
            </a></li>
        <li class="{{$active == 'article' ? 'active' : ''}}"><a href="{{route('content.article')}}">
                <i class="material-icons">schedule</i>
                {{'متن برای نشریه'}}
            </a></li>
        <li class="{{$active == 'list' ? 'active' : ''}}"><a href="{{route('content.list')}}">
                <i class="material-icons">list</i>
                {{'لیست محتوای ارسالی'}}
            </a></li>
    </ul>
</div>