@extends('layouts.app')

@push('styles')
<style>
    body {
        background: url('/img/.jpg') no-repeat fixed;
        background-size: cover;
    }
</style>
@endpush

@section('content')
    <div class="wrapper home">
        <div class="header header-filter">
            <div class="container">

                <div class="row sharing-area text-center">
                    <h3 class="brand">{{'پنل ادمین تحریریه'}}</h3>
                    <a href="{{route('journal.cover')}}" class="btn btn-raised btn-google-plus sharrre">
                        {{'کاور'}}
                    </a>
                    {{--<a href="{{route('admin.writtenFor')}}?for=1" class="btn btn-raised btn-facebook sharrre">--}}
                        {{--{{'واسه هر کی چقد نوشته شده'}}--}}
                    {{--</a>--}}
                    {{--<a href="{{route('admin.bests')}}" id="twitter" class="btn btn-raised btn-twitter sharrre">--}}
                        {{--{{'ترین ها'}}--}}
                    {{--</a>--}}
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="description">
                            <h3>{{'سلام'}}</h3>
                            <h4>{{'تحریریه چی ها'}}</h4>
                            <ul>
                                <li>{{'هستی'}}</li>
                                <li>{{'فاطمه'}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(function () {
        $('.soon').click(function () {
            toastr.info('به زودی')
        })
    })
</script>
@endpush