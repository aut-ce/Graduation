<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="favicon.ico">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/material-kit.css">
    <link href="/assets/css/demo.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/toastr.css">
    @stack('styles')
    <!-- Styles -->



</head>
<body>
    <div id="app" class="index-page">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/assets/js/jquery.min.js" type="text/javascript"></script>
    <script>
        window.Laravel = $('meta[name="csrf-token"]').attr('content');
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/assets/js/material.min.js"></script>
    <script src="/assets/js/nouislider.min.js" type="text/javascript"></script>
    <script src="/assets/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="/assets/js/material-kit.js" type="text/javascript"></script>

    @include('includes.toasts')
    @stack('scripts')
</body>
</html>
