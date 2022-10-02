@extends('layouts.base_home',['siswa' => $title])
@section('title',$title)
@section('content')
<div id="carouselExampleControls" class="carousel slide bs-slider box-slider" data-ride="carousel" data-pause="hover" data-interval="false">
    <ol class="carousel-indicators">
        @for ($i = 0; $i < count($berita); $i++)
            <li data-target="#carouselExampleControls" data-slide-to="{{$i}}"></li>
        @endfor
    </ol>
    <div class="carousel-inner" role="listbox">
        @foreach ($berita as $showberita)
        <div class="carousel-item active">
            <div id="home" class="first-section"
                style="background-image:url({{Storage::url($showberita->thumnail)}});">
                <div class="dtab">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 text-right">
                                <div class="big-tagline">
                                    @php
                                        $titlecount = Str::wordCount($showberita->title);
                                        $title      = explode(' ', $showberita->title);
                                    @endphp
                                    @if ($titlecount > 2)
                                        <h2>
                                            <strong>{{$title[0] . ' ' . $title[1]}} </strong>
                                            @for ($i = 2; $i < count($title); $i++)
                                                {{$title[$i]}}&nbsp;
                                            @endfor
                                        </h2>
                                    @else
                                        <h2><strong>{{$showberita->title}}</strong></h2>
                                    @endif
                                    <p class="lead">{{Str::limit($showberita->description,200,'')}}</p>
                                    <a href="{{route('home.newsmain',Crypt::encrypt($showberita->id))}}" class="hover-btn-new"><span>Read More</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <a class="new-effect carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="fa fa-angle-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="new-effect carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="fa fa-angle-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<div id="overviews" class="section wb">
    <div class="container">
        {{-- <div class="section-title row text-center">
            <div class="col-md-8 offset-md-2">
                <h3>About</h3>
                <p class="lead">Lorem Ipsum dolroin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem
                    quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem!</p>
            </div>
        </div> --}}
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="message-box">
                    <h4>SAMBUTAN KEPALA MAN</h4>
                    <h2>Markhaban, S.Pd., M.Pd.I</h2>
                    <p><b>Assalamualaikum Warahmatullahi Wabarokaatuh.</b></p>

                    <p>Puji syukur kami panjatkan kehadirat Allah SWT. atas karunia-Nya kami berhasil menyusun website resmi sekolah sebagai
                    gambaran kegiatan dalam berbagai bidang yang mudah-mudahan dapat bermanfaat bagi kita semua.</p>
                    <p>Kepala Madrasah</p>
                    <p><b>Markhaban, S.Pd., M.Pd.I</b></p>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="post-media wow fadeIn">
                    <img src="{{url('assets/home/images/kepala-man-patas.jpg')}}" alt="" class="img-fluid img-rounded">
                </div>
            </div>
        </div>
    </div>
</div>
<section class="section lb page-section">
    <div class="container">
        <div class="section-title row text-center">
            <div class="col-md-8 offset-md-2">
                <h3>Our history</h3>
                <p class="lead">Lorem Ipsum dolroin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem
                    quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem!</p>
            </div>
        </div>
        <div class="timeline">
            <div class="timeline__wrap">
                <div class="timeline__items">
                    <div class="timeline__item">
                        <div class="timeline__content img-bg-01">
                            <h2>2018</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dignissim neque
                                condimentum lacus dapibus. Lorem
                                ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                    <div class="timeline__item">
                        <div class="timeline__content img-bg-02">
                            <h2>2015</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dignissim neque
                                condimentum lacus dapibus. Lorem
                                ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                    <div class="timeline__item">
                        <div class="timeline__content img-bg-03">
                            <h2>2014</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dignissim neque
                                condimentum lacus dapibus. Lorem
                                ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                    <div class="timeline__item">
                        <div class="timeline__content img-bg-04">
                            <h2>2012</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dignissim neque
                                condimentum lacus dapibus. Lorem
                                ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                    <div class="timeline__item">
                        <div class="timeline__content img-bg-01">
                            <h2>2010</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dignissim neque
                                condimentum lacus dapibus. Lorem
                                ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                    <div class="timeline__item">
                        <div class="timeline__content img-bg-02">
                            <h2>2007</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dignissim neque
                                condimentum lacus dapibus. Lorem
                                ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                    <div class="timeline__item">
                        <div class="timeline__content img-bg-03">
                            <h2>2004</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dignissim neque
                                condimentum lacus dapibus. Lorem
                                ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                    <div class="timeline__item">
                        <div class="timeline__content img-bg-04">
                            <h2>2002</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dignissim neque
                                condimentum lacus dapibus. Lorem
                                ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="section cl">
    <div class="container">
        <div class="row text-left stat-wrap">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <span data-scroll class="global-radius icon_wrap effect-1 alignleft">
                    <i class="flaticon-study"></i></span>
                <p class="stat_count">{{App\Models\StudentDetail::count()}}</p>
                <h3>Students</h3>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <span data-scroll class="global-radius icon_wrap effect-1 alignleft">
                    <i class="flaticon-online"></i></span>
                <p class="stat_count">{{App\Models\TeacherDetail::count()}}</p>
                <h3>Teacher</h3>
            </div>
            {{-- <div class="col-md-4 col-sm-4 col-xs-12">
                <span data-scroll class="global-radius icon_wrap effect-1 alignleft"><i
                        class="flaticon-years"></i></span>
                <p class="stat_count">55</p>
                <h3>Years Completed</h3>
            </div> --}}
        </div>
    </div>
</div>
<div id="overviews" class="section wb">
    <div class="container">
        <div class="section-title row text-center">
            <div class="col-md-8 offset-md-2">
                <h3>Berita</h3>
            </div>
        </div>
        <hr class="invis">
        <div class="row">
            @foreach ($berita as $showberita)
                <a href="{{route('home.newsmain',Crypt::encrypt($showberita->id))}}">
                    <div class="col-lg-3 col-md-6 col-12 my-2">
                        <div class="course-item">
                            <div class="image-blog">
                                <img src="{{Storage::url($showberita->thumnail)}}" alt="" class="img-fluid">
                            </div>
                            <div class="course-br">
                                <div class="course-title">
                                    <h2>{{$showberita->title}}</h2>
                                </div>
                                <div class="course-desc" style="text-align: justify;">
                                    <p>{{Str::limit($showberita->description,200,'....')}}</p>
                                </div>
                            </div>
                            <div class="course-meta-bot">
                                <ul>
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i> {{date('d M y',strtotime($showberita->created_at))}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
<div id="overviews" class="section wb">
    <div class="container">
        <div class="section-title row text-center">
            <div class="col-md-8 offset-md-2">
                <h3>Info Sekolah</h3>
            </div>
        </div>
        <hr class="invis">
        <div class="row">
            @foreach ($info as $showinfo)
                <a href="{{route('home.info',Crypt::encrypt($showinfo->id))}}">
                    <div class="col-lg-3 col-md-6 col-12 my-3">
                        <div class="course-item">
                            <div class="course-br">
                                <div class="course-title">
                                    <h2>{{$showinfo->title}}</h2>
                                </div>
                                <div class="course-desc">
                                    <p>{{Str::limit($showinfo->description, 200 ,'....')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
