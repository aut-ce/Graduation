@extends('layouts.app')

@push('styles')
<style>
    body {
        background: url('/img/5.jpg') no-repeat fixed;
        background-size: cover;
    }
</style>
@endpush

@section('content')
    <div class="wrapper home">
        <div class="header header-filter">
            <div class="container">

                <div class="row sharing-area text-center">
                    <h3 class="brand">{{'ورودی‌های ۹۲ دانشکده کامپیوتر'}}</h3>
                    <a href="{{route('personal.main')}}" id="twitter" class="btn btn-raised btn-twitter sharrre">
                        {{'صفحه شخصی'}}
                    </a>
                    <a href="{{route('content.main')}}" class="btn btn-raised btn-google-plus sharrre">
                        {{'ارسال محتوا'}}
                    </a>
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