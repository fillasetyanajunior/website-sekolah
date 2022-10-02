@extends('layouts.base_home',['title' => $title])
@section('title',$title)
@section('content')
<div class="all-title-box">
    <div class="container text-center">
        <h1>{{$title}}</h1>
    </div>
</div>
<div id="overviews" class="section wb">
    <div class="container">
        <div class="card">
            <div class="card-header">
                Prestasi Akademik
            </div>
            @foreach ($akademik as $showakademik)
                @php
                    $detail1 = App\Models\Achievement::groupBy('tahun')->where('tingkatan',$showakademik->tingkatan)->get('tahun');
                @endphp
                @foreach ($detail1 as $showdetail1)
                @php
                    $detail2 = App\Models\Achievement::where('tingkatan',$showakademik->tingkatan)->where('tahun',$showdetail1->tahun)->get();
                @endphp
                    <div class="card-body">
                        <h3>{{$showakademik->tingkatan . ' ' . $showdetail1->tahun}}</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Uraian Kegiatan</th>
                                    <th scope="col">Penyelenggara</th>
                                    <th scope="col">Juara</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;?>
                                @foreach ($detail2 as $showdetail2)
                                    <tr>
                                        <th scope="row">{{$i++}}</th>
                                        <td>{{$showdetail2->kegiatan}}</td>
                                        <td>{{$showdetail2->penyelenggara}}</td>
                                        <td>{{$showdetail2->juara}}</td>
                                        <td>{{$showdetail2->keterangan}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            @endforeach
        </div>
        <div class="card my-3">
            <div class="card-header">
                Prestasi Non-Akademik
            </div>
            @foreach ($non_akademik as $shownon_akademik)
                @php
                    $detail1 = App\Models\Achievement::groupBy('tahun')->where('tingkatan',$shownon_akademik->tingkatan)->get('tahun');
                @endphp
                @foreach ($detail1 as $showdetail1)
                @php
                    $detail2 = App\Models\Achievement::where('tingkatan',$shownon_akademik->tingkatan)->where('tahun',$showdetail1->tahun)->get();
                @endphp
                    <div class="card-body">
                        <h3>{{$shownon_akademik->tingkatan . ' ' . $showdetail1->tahun}}</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Uraian Kegiatan</th>
                                    <th scope="col">Penyelenggara</th>
                                    <th scope="col">Juara</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;?>
                                @foreach ($detail2 as $showdetail2)
                                    <tr>
                                        <th scope="row">{{$i++}}</th>
                                        <td>{{$showdetail2->kegiatan}}</td>
                                        <td>{{$showdetail2->penyelenggara}}</td>
                                        <td>{{$showdetail2->juara}}</td>
                                        <td>{{$showdetail2->keterangan}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</div>
@endsection
