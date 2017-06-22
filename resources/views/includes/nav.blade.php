<nav class="navbar" style="margin-bottom: 0">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-index">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div>
                <div class="logo-container">
                    @if(Auth::check())
                        <div class="brand" style="display: flex;align-items: center;margin-right: 10px;">
                            {{Auth::user()['first_name'].' '.Auth::user()['last_name']}}
                        </div>
                        <div class="logo" style="width: 50px;height: 50px;display: flex;">
                            <img  style="object-fit: cover" src="https://www.gravatar.com/avatar/{{md5(Auth::user()['email'])}}">
                        </div>
                    @else
                        <h4>{{'فارغ‌التحصیلان ورودی ۹۲ دانشکده کامپیوتر'}}</h4>
                    @endif

                </div>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="navigation-index">
            <ul class="nav navbar-nav navbar-right" style="display: flex;align-items: center">
                <li>
                    <a class="github-button" href="https://github.com/aut-ceit/Graduation" data-size="large" data-show-count="true" aria-label="Star aut-ceit/Graduation on GitHub">Star</a>
                </li>
                <li>
                    <a rel="tooltip" title="" data-placement="bottom" href="https://t.me/joinchat/AAAAAELADWOLRvLOfbRZug" target="_blank" class="btn btn-white btn-simple btn-just-icon" data-original-title="Join us on Telegram">
                        <i class="fa fa-telegram"></i>
                    </a>
                </li>
                <li>
                    <a rel="tooltip" title="" data-placement="bottom" href="https://www.facebook.com/groups/autceit92/" target="_blank" class="btn btn-white btn-simple btn-just-icon" data-original-title="Like us on Facebook">
                        <i class="fa fa-facebook-square"></i>
                    </a>
                </li>
                <li>
                    <a rel="tooltip" title="" data-placement="bottom" href="https://www.instagram.com/ceit_ssc/" target="_blank" class="btn btn-white btn-simple btn-just-icon" data-original-title="Follow us on Instagram">
                        <i class="fa fa-instagram"></i>
                    </a>
                </li>
                @if(Auth::check())
                    <li>
                        <a href="/logout">
                            <i class="material-icons">exit</i> {{'خروج'}}
                        </a>
                    </li>
                    <li>
                        <a href="{{route('personal.main')}}">
                            <i class="material-icons">dashboard</i> {{'صفحه شخصی'}}
                        </a>
                    </li>
                    <li>
                        <a href="{{route('content.main')}}">
                            <i class="material-icons">list</i> {{'ارسال محتوا'}}
                        </a>
                    </li>
                    <li>
                        <a href="/password/change">
                            <i class="material-icons">people</i> {{'تغییر رمز عبور'}}
                        </a>
                    </li>

                @endif


            </ul>
        </div>
    </div>
</nav>
