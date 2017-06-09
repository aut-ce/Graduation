@extends('layouts.app')

@push('styles')
<style>
    body {
        background: url('/img/10.jpg') no-repeat fixed;
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
                    <div class="col-md-8 col-md-offset-2 form-dialog">
                        <form class="bests-from" action="" method="post">
                            {{csrf_field()}}
                            <h3 class="text-muted">{{'ترین های اساتید دانشکده'}}</h3>
                            @foreach($titles as $key => $q)
                                <div class="row">
                                    <div class="hidden-xs col-sm-2 pull-right"></div>
                                    <div class="form-group col-xs-6 col-sm-4 pull-right">
                                        <h4>{{$q}}</h4>
                                    </div>
                                    <div class="form-group col-xs-6 col-sm-4 pull-right">
                                        <select class="js-example-basic-single user-bests select2" name="q[{{$key}}]">
                                            @if(isset($answers[$key]))
                                                <option value="{{$inst[$answers[$key]]['id']}}">{{$inst[$answers[$key]]['name']}}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            @endforeach

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
            var number = $('.bests-from select').filter(function () {
                return this.value != "";
            }).length;
            if (number < 10) {
                e.preventDefault();
                toastr.error('حداقل ۱۰ ترین انتخاب کنید');
            }
        })
    })

    $('select.user-bests.select2').select2({
        dir: "rtl",
        theme: "bootstrap",
        ajax: {
            url: '{{route('select.allInst')}}',
            dataType: 'json',
            delay: 250,
            processResults: function (data, params) {
                params.page = params.page || 1;
                return {
                    results: data
                };
            },
            cache: true
        }
    });
</script>
@endpush

