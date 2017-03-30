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
                    @include('pages.personal.nav',['active'=>'questions'])
                    <div class="col-md-8 col-md-offset-2 form-dialog">
                        <form class="question-from" action="" method="post">
                            {{csrf_field()}}
                            <h3 class="text-muted">{{'سوالات بلند'}}</h3>
                            <div class="row">
                                @foreach($questions as $key=>$q)
                                    <div class="form-group col-xs-12 col-sm-6 label-floating pull-right {{isset($answers[$q]) && $answers[$q]=='' ? 'is-empty': ""}}">
                                        <label class="control-label">{{$q}}</label>
                                        <textarea type="text" name="q[{{$q}}]" class="form-control" rows="5"
                                               style="text-align: right">{{isset($answers[$q]) ? $answers[$q] : ""}}</textarea>
                                        <span class="material-input"></span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="row">
                                <div class="col-xs-9"></div>
                                <div class="col-xs-3">
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
            var number = $('.question-from textarea').filter(function () {
                return this.value == "";
            }).length;
            if (number > 4) {
                e.preventDefault();
                toastr.error('حداقل به ۳ سوال پاسخ دهید');
            }

        })
    })
</script>
@endpush
