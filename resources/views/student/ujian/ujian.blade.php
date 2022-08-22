@extends('layouts.base_dashboard')
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
                                Ujian Akhir
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
                                    <h3 class="card-title">{{$title}} Tertulis</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tanggal Ujian</th>
                                                <th>Jam</th>
                                                <th>Ruangan</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Kursi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($writtenexamination as $showwrittenexamination)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$showwrittenexamination->tanggal_ujian}}</td>
                                                    <td>{{$showwrittenexamination->jam}}</td>
                                                    <td>{{$showwrittenexamination->ruangan}}</td>
                                                    <td>{{App\Models\Subject::find($showwrittenexamination->mapel)}}</td>
                                                    <td>{{$showwrittenexamination->kursi}}</td>
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
                                    <h3 class="card-title">{{$title}} Praktikum</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tanggal Ujian</th>
                                                <th>Jam</th>
                                                <th>Ruangan</th>
                                                <th>Mata Pelajaran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $j = 1;
                                            @endphp
                                            @foreach ($practicalexam as $showpracticalexam)
                                                <tr>
                                                    <td>{{$j++}}</td>
                                                    <td>{{$showpracticalexam->tanggal_ujian}}</td>
                                                    <td>{{$showpracticalexam->jam}}</td>
                                                    <td>{{$showpracticalexam->ruangan}}</td>
                                                    <td>{{App\Models\Subject::find($showpracticalexam->mapel)}}</td>
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
