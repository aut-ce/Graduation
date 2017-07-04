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
    <a href="{{ route('landing') }}" class="btn btn-danger return-home">{{'بازگشت'}}</a>
    <div class="wrapper home">
        <div class="header header-filter">
            <div class="container">

                <div class="row sharing-area text-center">
                    <h3 class="brand">{{'پنل ادمین تحریریه'}}</h3>
                    <a href="{{route('journal.cover')}}" class="btn btn-raised btn-google-plus sharrre">
                        {{'کاور'}}
                    </a>
                    <a href="{{route('journal.articles')}}?for=1" class="btn btn-raised btn-facebook sharrre">
                        {{'متن ها بچه ها '}}
                    </a>
                    <a href="{{route('journal.mini')}}" id="twitter" class="btn btn-raised btn-twitter sharrre">
                        {{'کوتاه پاسخ'}}
                    </a>

                    <a href="{{route('journal.questions')}}" id="twitter" class="btn btn-warning">
                        {{'بلند پاسخ'}}
                    </a>
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