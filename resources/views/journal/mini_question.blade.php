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
    <a href="{{route('journal.home')}}" class="btn btn-danger return-home">{{'بازگشت'}}</a>
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
                            <h3 class="text-muted">{{'سوال های کوتاه پاسخ: '}}{{$user['first_name'].' '.$user['last_name']}} </h3>
                            <form class="row" action="" style="display:flex;background-color: #fff;padding: 10px">
                                <div style="width: 50%">
                                    <div class="form-group label-floating {{isset($user) ? '': 'is-empty'}}">
                                        <label class="control-label">{{'شماره دانشجویی'}}</label>
                                        <input type="text" class="form-control" name="username" value="{{isset($user) ? $user['username'] : ""}}">
                                        <span class="material-input"></span></div>
                                </div>
                                <div  style="display: flex;align-items: center;width: 50%;padding: 2rem">
                                    <input type="submit" value="{{'متن های نوشته شده'}}" style="margin: 0" class="btn btn-raised btn-google-plus sharrre">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 form-dialog">
                        <form class="mini-question-from" action="" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="username" value="{{$user['username']}}">
                            <h3 class="text-muted">{{'سوالات کوتاه پاسخ'}}</h3>
                            <div class="row">
                                @foreach($questions as $key=>$q)
                                    @if(isset($answers[$q]) && $answers[$q])
                                    <div class="form-group col-xs-12 col-sm-6 label-floating pull-right {{isset($answers[$q]) && $answers[$q]=='' ? 'is-empty': ""}}">
                                        <label class="control-label">{{$q}}</label>
                                        <input type="text" name="q[{{$q}}]" class="form-control"
                                               style="text-align: right"
                                               value="{{isset($answers[$q]) ? $answers[$q] : ""}}">
                                        <span class="material-input"></span>
                                    </div>
                                    @endif
                                @endforeach
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
        $('button.submit-button').click(function (e) {
            var number = $('.mini-question-from input:text').filter(function () {
                return this.value != "";
            }).length;
            if (number < 12) {
                e.preventDefault();
                toastr.error('حداقل ۱۲ سوال میخوایم');
            }

        })
    })
</script>
@endpush
