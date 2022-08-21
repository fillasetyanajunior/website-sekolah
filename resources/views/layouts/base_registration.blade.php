<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{env('APP_NAME')}} - @yield('title')</title>
    <!-- CSS files -->
    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{url('assets/auth/images/avatar-01.png')}}" type="image/x-icon" />
    <link href="{{url('assets/pendaftaran/dist/css/tabler.min.css')}}" rel="stylesheet" />
    <link href="{{url('assets/pendaftaran/dist/css/tabler-flags.min.css')}}" rel="stylesheet" />
    <link href="{{url('assets/pendaftaran/dist/css/tabler-payments.min.css')}}" rel="stylesheet" />
    <link href="{{url('assets/pendaftaran/dist/css/tabler-vendors.min.css')}}" rel="stylesheet" />
    <link href="{{url('assets/pendaftaran/dist/css/demo.min.css')}}" rel="stylesheet" />
</head>

<body class="">

    @yield('content')
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{url('assets/pendaftaran/dist/js/tabler.min.js')}}"></script>
    <script src="{{url('assets/pendaftaran/dist/js/demo.min.js')}}"></script>

    @stack('scripts')
</body>

</html>
