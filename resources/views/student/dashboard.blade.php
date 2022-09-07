@extends('layouts.base_dashboard',['layout' => 'dashboard'])
@section('title', $title)
@section('content')
<div class="page">
    <x-sliderbar-student></x-sliderbar-student>
    <div class="page-wrapper">
        <div class="page-wrapper">
            <div class="container-xl">
                <div class="page-header d-print-none">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <div class="page-pretitle">
                                Home
                            </div>
                            <h2 class="page-title">
                                {{$title}}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Jadwal Pelajaran</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Hari</th>
                                                <th>Jam</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Guru</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($schedule as $showschedule)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td class="text-capitalize">{{$showschedule->hari}}</td>
                                                    <td>{{$showschedule->jam_start . ' - ' . $showschedule->jam_end}}</td>
                                                    <td>{{App\Models\Subject::find($showschedule->matapelajaran)->matapelajaran}}</td>
                                                    <td>{{App\Models\TeacherDetail::find($showschedule->guru)->name}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Jadwal Ulangan</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tanggal</th>
                                                <th>Jam</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Ruangan</th>
                                                <th>Kursi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($deuteronomi as $showdeuteronomi)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$showdeuteronomi->tanggal}}</td>
                                                    <td>{{$showdeuteronomi->jam}}</td>
                                                    <td>{{App\Models\Subject::find($showdeuteronomi->matapelajaran)->matapelajaran}}</td>
                                                    <td>{{'Ruangan ' . $showdeuteronomi->ruangan}}</td>
                                                    <td>{{$showdeuteronomi->kursi}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footer></x-footer>
        </div>
    </div>
</div>
@endsection
