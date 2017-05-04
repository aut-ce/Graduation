<div class="main-nav col-md-6 col-md-offset-3 col-xs-12 text-center">
    <ul class="nav nav-pills" role="tablist">
        <li class="{{$active == 'mini' ? 'active' : ''}}"><a href="{{route('personal.mini')}}">
                <i class="material-icons">dashboard</i>
                {{'سوالات کوتاه پاسخ'}}
            </a>
        </li>
        <li class="{{$active == 'ppic' ? 'active' : ''}}"><a href="{{route('personal.ppic')}}">
                <i class="material-icons">schedule</i>
                {{'تصویر خاطره انگیز در نشریه'}}
            </a>
        </li>
        <li class="{{$active == 'questions' ? 'active' : ''}}"><a href="{{route('personal.questions')}}">
                <i class="material-icons">list</i>
                {{'سوالات بلند'}}
            </a>
        </li>
        <li class="{{$active == 'cover' ? 'active' : ''}}"><a href="{{route('personal.cover')}}">
                <i class="material-icons">schedule</i>
                {{'کاور در نشریه'}}
            </a>
        </li>
    </ul>
</div>