@extends('layouts.app')

@push('styles')
<style>
    body {
        background: url('/img/6.jpg') no-repeat fixed;
        background-size: cover;
    }
</style>
@endpush

@section('content')
    <a href="{{route('landing')}}" class="btn btn-danger return-home">{{'بازگشت'}}</a>
    <div class="wrapper home">
        <div class="header header-filter">
            <div class="container">

                <div class="row sharing-area text-center">
                    <h3 class="brand">{{'پنل ادمین سیاه'}}</h3>
                    <a href="{{route('admin.written')}}" class="btn btn-raised btn-google-plus sharrre">
                        {{'کیا چقد نوشتن'}}
                    </a>
                    <a href="{{route('admin.writtenFor')}}?for=1" class="btn btn-raised btn-facebook sharrre">
                        {{'واسه هر کی چقد نوشته شده'}}
                    </a>
                    <a href="{{route('admin.bests')}}" id="twitter" class="btn btn-raised btn-twitter sharrre">
                        {{'ترین ها'}}
                    </a>
                    <a href="{{route('admin.instBests')}}" class="btn btn-raised btn-facebook sharrre">
                        {{'ترین اساتید'}}
                    </a>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="description">
                            <h3>{{'سلام'}}</h3>
                            <h4>{{'بزغاله هاااااا'}}</h4>
                            <p>{{'فقط عده‌ی کمی هستن که میتونن ادمین باشن:دی'}}</p>
                            <ul>
                                <li>{{'سجاد'}}</li>
                                <li>{{'سپهر'}}</li>
                                <li>{{'رستا'}}</li>
                                <li>{{'مبینا'}}</li>
                                <li>{{'ممد'}}</li>
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