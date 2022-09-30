@extends('layouts.base_home',['siswa' => $title])
@section('title',$title)
@section('content')
<div class="all-title-box">
    <div class="container text-center">
        <h1>Siswa</h1>
    </div>
</div>
<div id="teachers" class="section wb">
    <div class="container">
        <div class="row">
            @foreach ($siswa as $showsiswa)
                @php
                    $jurusan = App\Models\StudentDetail::groupBy('jurusan')->where('kelas',$showsiswa->kelas)->get('jurusan');
                @endphp
                @foreach ($jurusan as $showjurusan)
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="our-team">
                        <div class="team-content">
                            <h3 class="title">Kelas {{$showsiswa->kelas . ' ' . App\Models\Department::find($showjurusan->jurusan)->jurusan}}</h3>
                            <span class="post">Siswa {{App\Models\StudentDetail::where('kelas',$showsiswa->kelas)->where('jurusan',$showjurusan->jurusan)->where('jenis_kelamin','Laki-laki')->count()}}</span>
                            <span class="post">Siswi {{App\Models\StudentDetail::where('kelas',$showsiswa->kelas)->where('jurusan',$showjurusan->jurusan)->where('jenis_kelamin','Perempuan')->count()}}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            @endforeach
        </div>
    </div>
</div>
@endsection
