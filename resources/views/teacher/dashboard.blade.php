@extends('layouts.base_dashboard',['layout' => 'dashboard'])
@section('title', $title)
@section('content')
<div class="page">
    <x-sliderbar-teacher></x-sliderbar-teacher>
    <div class="page-wrapper">
        <div class="page-wrapper">
            <div class="container-fluid">
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
                <div class="container-fluid">
                    <div class="row row-deck row-cards">
                        <div class="col-12">
                            <div class="row row-cards">
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-blue text-white avatar">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-stairs" width="24" height="24"
                                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M4 18h4v-4h4v-4h4v-4h4"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        Jumlah Kelas Mengajar
                                                    </div>
                                                    <div class="text-muted">
                                                        {{count(App\Models\Schedule::groupBy('kelas')->where('guru', Auth::user()->id_guru)->get('kelas')) . ' Kelas'}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-green text-white avatar">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building" width="24" height="24"
                                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <line x1="3" y1="21" x2="21" y2="21"></line>
                                                            <line x1="9" y1="8" x2="10" y2="8"></line>
                                                            <line x1="9" y1="12" x2="10" y2="12"></line>
                                                            <line x1="9" y1="16" x2="10" y2="16"></line>
                                                            <line x1="14" y1="8" x2="15" y2="8"></line>
                                                            <line x1="14" y1="12" x2="15" y2="12"></line>
                                                            <line x1="14" y1="16" x2="15" y2="16"></line>
                                                            <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        Jumlah Jurusan Mengajar
                                                    </div>
                                                    <div class="text-muted">
                                                        {{count(App\Models\Schedule::groupBy('jurusan')->groupBy('kelas')->where('guru', Auth::user()->id_guru)->get('jurusan')) . ' Jurusan'}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-twitter text-white avatar">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-hour-9" width="24" height="24"
                                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <circle cx="12" cy="12" r="9"></circle>
                                                            <path d="M12 12h-3.5"></path>
                                                            <path d="M12 7v5"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        Jumlah Jam Mengajar
                                                    </div>
                                                    <div class="text-muted">
                                                        {{App\Models\Schedule::where('guru', Auth::user()->id_guru)->count() . ' Jam'}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Jadwal Mengajar</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap datatable">
                                        <thead>
                                            <tr>
                                                <th>Hari</th>
                                                <th>Jam</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Kelas</th>
                                                <th>Jurusan</th>
                                                <th>Bagian Kelas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($schedule as $showschedule)
                                                <tr>
                                                    <td class="text-capitalize">{{$showschedule->hari}}</td>
                                                    <td>{{$showschedule->jam_start . ' - ' . $showschedule->jam_end}}</td>
                                                    <td>{{App\Models\Subject::find($showschedule->matapelajaran)->matapelajaran}}</td>
                                                    <td>{{$showschedule->kelas}}</td>
                                                    <td>{{$showschedule->jurusan != null ? App\Models\Department::find($showschedule->jurusan)->jurusan : '-'}}</td>
                                                    <td>{{$showschedule->no_kelas != null ? $showschedule->no_kelas : '-'}}</td>
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
                                    <h3 class="card-title">Reminder</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Judul</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Kelas</th>
                                                <th>Jurusan</th>
                                                <th>Bagian Kelas</th>
                                                <th>Dateline</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;?>
                                            @foreach ($classroom as $showclassroom)
                                                @php
                                                    $content = App\Models\Content::where('id_classroom', $showclassroom->id)->get();
                                                @endphp
                                                @foreach ($content as $showcontent)
                                                    <tr>
                                                        <td class="text-capitalize">{{$i++}}</td>
                                                        <td class="text-capitalize">{{$showcontent->judul}}</td>
                                                        <td>{{$showclassroom->nama}}</td>
                                                        <td>{{$showclassroom->kelas}}</td>
                                                        <td>{{$showclassroom->jurusan != null ? App\Models\Department::find($showclassroom->jurusan)->jurusan : ''}}</td>
                                                        <td>{{$showclassroom->no_kelas}}</td>
                                                        <td>{{$showcontent->dateline}}</td>
                                                    </tr>
                                                @endforeach
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
