<!DOCTYPE html>
<html lang="en">
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- Site Metas -->
    <title>@yield('title') - {{env('APP_NAME')}}</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{url('assets/auth/images/avatar-01.png')}}" type="image/x-icon" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url('assets/home/css/bootstrap.min.css')}}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{url('assets/home/style.css')}}">
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="{{url('assets/home/css/versions.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{url('assets/home/css/responsive.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{url('assets/home/css/custom.css')}}">
    <!-- Modernizer for Portfolio -->
    <script src="{{url('assets/home/js/modernizer.js')}}"></script>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="host_version">
	<div id="preloader">
		<div class="loader-container">
			<div class="progress-br float shadow">
				<div class="progress__item"></div>
			</div>
		</div>
	</div>
    <header class="top-navbar">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img src="{{url('assets/auth/images/avatar-01.png')}}" width="60" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-host"
                    aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbars-host">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item {{$title == 'Man Buleleng' ? 'active' : ''}}"><a class="nav-link" href="/">Home</a></li>
                        <li class="nav-item {{$title == 'Profile' ? 'active' : ''}}"><a class="nav-link" href="about.html">Profile Sekolah</a></li>
                        <li class="nav-item {{$title == 'Guru dan Pegawai' ? 'active' : ''}}"><a class="nav-link" href="{{route('home.teacher')}}">Guru dan Pegawai</a></li>
                        <li class="nav-item {{$title == 'Siswa' ? 'active' : ''}}"><a class="nav-link" href="{{route('home.student')}}">Siswa</a></li>
                        <li class="nav-item {{$title == 'Prestasi' ? 'active' : ''}}"><a class="nav-link" href="{{route('home.achievement')}}">Prestasi Siswa</a></li>
                        <li class="nav-item {{$title == 'Majalah' ? 'active' : ''}}"><a class="nav-link" href="about.html">Majalah MADANI</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('regisration')}}">PSM</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('student.login.form')}}">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
	@yield('content')
    <footer class="footer">
        <div class="container">
            <div class="row">
				<div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>Information Link</h3>
                        </div>
                        <ul class="footer-links">
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><a href="about.html">Profile Sekolah</a></li>
                            <li><a href="{{route('home.teacher')}}">Guru dan Pegawai</a></li>
                            <li><a href="{{route('home.student')}}">Siswa</a></li>
                            <li><a href="{{route('home.achievement')}}">Prestasi Siswa</a></li>
                            <li><a href="about.html">Majalah MADANI</a></li>
                            <li><a href="{{route('regisration')}}">PSM</a></li>
                            <li><a href="{{route('student.login.form')}}">Login</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>Contact</h3>
                        </div>
                        <ul class="footer-links">
                            <li><a href="mailto:#">manpatas@kemenag.go.id | man_patas2009@yahoo.com</a></li>
                            <li><a href="#">www.manbuleleng.sch.id</a></li>
                            <li>Jl. Raya Seririt - Gilimanuk KM. 15 Desa Patas Kec. Gerokgak Kab. Buleleng Bali.</li>
                            <li>0362 - 3361846</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="copyrights">
        <div class="container">
            <div class="footer-distributed">
                <div class="footer-center">
                    <p class="footer-company-name">All Rights Reserved. &copy; <script> document.write(new Date().getFullYear());</script> {{env('APP_NAME')}}</p>
                </div>
            </div>
        </div>
    </div>
    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>
    <!-- ALL JS FILES -->
    <script src="{{url('assets/home/js/all.js')}}"></script>
    <!-- ALL PLUGINS -->
    <script src="{{url('assets/home/js/custom.js')}}"></script>
	<script src="{{url('assets/home/js/timeline.min.js')}}"></script>
	<script>
		timeline(document.querySelectorAll('.timeline'), {
			forceVerticalMode: 700,
			mode: 'horizontal',
			verticalStartPosition: 'left',
			visibleItems: 4
		});
	</script>
</body>
</html>
