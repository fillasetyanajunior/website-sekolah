<nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="dark">
            <i class="fe fe-sun fe-16"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="avatar avatar-sm mt-2">
                @if (Auth::user()->avatar == null)
                    <img src="{{url('assets/dashboard/assets/default.jpg')}}" alt="..." class="avatar-img rounded-circle">
                @else
                    <img src="{{asset('profile/' . Auth::user()->avatar)}}" alt="..." class="avatar-img rounded-circle">
                @endif
            </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="/profile">Profile</a>
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="#">Activities</a>
            </div>
        </li>
    </ul>
</nav>
<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
    <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
            <img src="{{url('assets/login/images/avatar-01.png')}}" alt="" class="navbar-brand-img" width="100px">
            {{-- <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                <g>
                <polygon class="st0" points="78,105 15,105 24,87 87,87" />
                <polygon class="st0" points="96,69 33,69 42,51 105,51" />
                <polygon class="st0" points="78,33 15,33 24,15 87,15" />
                </g>
            </svg> --}}
            </a>
        </div>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown mb-2">
                <a href="#home" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fas fa-home fe-16"></i>
                    <span class="ml-3 item-text">Home</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="home">
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{route('admin.dashboard')}}">
                            <i class="fas fa-home fe-16"></i>
                            <span class="ml-1 item-text">Home</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown mb-2">
                <a href="#sekolah" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fas fa-school fe-16"></i>
                    <span class="ml-3 item-text">Management Sekolah</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="sekolah">
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{route('admin.schedule')}}">
                            <i class="fas fa-calendar-alt fe-16"></i>
                            <span class="ml-1 item-text">Jadwal Pelajaran</span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{route('admin.deuteronomi')}}">
                            <i class="fas fa-clock fe-16"></i>
                            <span class="ml-1 item-text">Jadwal Ulangan</span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{route('admin.department')}}">
                            <i class="fas fa-laptop-code fe-16"></i>
                            <span class="ml-1 item-text">Jurusan</span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{route('admin.subject')}}">
                            <i class="fas fa-chalkboard-teacher fe-16"></i>
                            <span class="ml-1 item-text">Mata Pelajaran</span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{route('admin.year')}}">
                            <i class="fas fa-file-signature fe-16"></i>
                            <span class="ml-1 item-text">Tahun Pelajaran</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown mb-2">
                <a href="#user" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fas fa-user-tie fe-16"></i>
                    <span class="ml-3 item-text">Management User</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="user">
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{route('admin.teacher')}}">
                            <i class="fas fa-address-card fe-16"></i>
                            <span class="ml-1 item-text">Management Guru</span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="{{route('admin.student')}}">
                            <i class="fas fa-address-card fe-16"></i>
                            <span class="ml-1 item-text">Management Siswa</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown mb-2">
                <a href="#pendaftaran" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fas fa-list fe-16"></i>
                    <span class="ml-3 item-text">Data Pendaftaran</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="pendaftaran">
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="">
                        <i class="fas fa-bars fe-16"></i>
                        <span class="ml-1 item-text">Data Pendaftaran</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown mb-2">
                <a href="#materi" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fas fa-upload fe-16"></i>
                    <span class="ml-3 item-text">Upload Materi</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="materi">
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="">
                        <i class="fas fa-upload fe-16"></i>
                        <span class="ml-1 item-text">Upload Materi</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown mb-2">
                <a href="#nilai" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fas fa-file-import fe-16"></i>
                    <span class="ml-3 item-text">Upload Nilai</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="nilai">
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="">
                        <i class="fas fa-file-import fe-16"></i>
                        <span class="ml-1 item-text">Upload Nilai</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown mb-2">
                <a href="#berita" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fas fa-newspaper fe-16"></i>
                    <span class="ml-3 item-text">Upload Berita</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="berita">
                    <li class="nav-item active">
                        <a class="nav-link pl-3" href="">
                        <i class="fas fa-newspaper fe-16"></i>
                        <span class="ml-1 item-text">Upload Berita</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown mb-2">
                <a class="nav-link" href="" content="{{'logout'}}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt  fe-16"></i>
                    <span class="ml-3 item-text">{{ __('Logout') }}</span>
                </a>
                <form id="logout-form" action="" method="POST">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
</aside>
