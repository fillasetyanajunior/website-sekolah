@extends('layouts.base_home',['siswa' => $title])
@section('title',$title)
@section('content')
<div class="all-title-box">
    <div class="container text-center">
        <h1>Guru dan Pegawai</h1>
    </div>
</div>
<div id="teachers" class="section wb">
    <div class="container">
        <div class="row">
            @foreach ($guru as $showguru)
                @php
                    $teaching   = App\Models\Teaching::where('id_guru',$showguru->id)->first();
                    $teachings  = App\Models\Teaching::groupBy('matapelajaran')->where('id_guru',$showguru->id)->get('matapelajaran');
                @endphp
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="our-team">
                        <div class="team-img">
                            <img src="{{$showguru->avatar == 'default.jpg' ? url('assets/dashboard/dist/img/default.png') : Storage::url($showguru->avatar)}}">
                            <div class="social">
                                <ul>
                                    <li><a href="#" class="fa fa-facebook"></a></li>
                                    <li><a href="#" class="fa fa-twitter"></a></li>
                                    <li><a href="#" class="fa fa-linkedin"></a></li>
                                    <li><a href="#" class="fa fa-skype"></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-content">
                            <h3 class="title">{{$showguru->nama}}</h3>
                            @if ($showguru->jabatan != null)
                                <span class="post">{{$showguru->jabatan}}</span>
                            @endif
                            @if ($teaching != null)
                                @foreach ($teachings as $showteachings)
                                    <span class="post">{{App\Models\Subject::find($showteachings->matapelajaran)->matapelajaran}}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
