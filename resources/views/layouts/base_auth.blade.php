<!DOCTYPE html>
<html lang="en">
<head>
	<title>{{env('APP_NAME')}} - Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
	<link rel="shortcut icon" href="{{url('assets/auth/images/avatar-01.png')}}" type="image/x-icon" />
    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('assets/auth/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('assets/auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('assets/auth/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('assets/auth/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('assets/auth/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('assets/auth/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('assets/auth/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('assets/auth/css/main.css')}}">
    <!--===============================================================================================-->
</head>
<body>

    @yield('content')

    <!--===============================================================================================-->
	<script src="{{url('assets/auth/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    <!--===============================================================================================-->
	<script src="{{url('assets/auth/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{url('assets/auth/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--===============================================================================================-->
	<script src="{{url('assets/auth/vendor/select2/select2.min.js')}}"></script>
    <!--===============================================================================================-->
	<script src="{{url('assets/auth/js/main.js')}}"></script>

</body>
</html>
