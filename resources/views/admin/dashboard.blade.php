@extends('layouts.base_dashboard',['layout' => 'dashboard'])
@section('title', $title)
@section('content')
<div class="page">
    <x-sliderbar-admin></x-sliderbar-admin>
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
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24"
                                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <circle cx="9" cy="7" r="4"></circle>
                                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        {{App\Models\StudentDetail::count() . ' Siswa'}}
                                                    </div>
                                                    <div class="text-muted">
                                                        {{App\Models\StudentDetail::where('jenis_kelamin', 'Laki-laki')->count() . ' Laki-laki ' . App\Models\StudentDetail::where('jenis_kelamin', 'Perempuan')->count() . ' Perempuan '}}
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
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-friends" width="24" height="24"
                                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <circle cx="7" cy="5" r="2"></circle>
                                                            <path d="M5 22v-5l-1 -1v-4a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4l-1 1v5"></path>
                                                            <circle cx="17" cy="5" r="2"></circle>
                                                            <path d="M15 22v-4h-2l2 -6a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1l2 6h-2v4"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        {{App\Models\TeacherDetail::count() . ' Guru dan Paramubakti'}}
                                                    </div>
                                                    <div class="text-muted">
                                                        {{App\Models\TeacherDetail::where('jenis_kelamin', 'Laki-laki')->count() . ' Laki-laki ' . App\Models\TeacherDetail::where('jenis_kelamin', 'Perempuan')->count() . ' Perempuan '}}
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
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24"
                                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <circle cx="12" cy="7" r="4"></circle>
                                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        {{App\Models\RegistrationDetail::count() . ' Siswa Baru'}}
                                                    </div>
                                                    <div class="text-muted">
                                                        {{App\Models\RegistrationDetail::where('jenis_kelamin', 'Laki-laki')->count() . ' Laki-laki ' . App\Models\RegistrationDetail::where('jenis_kelamin', 'Perempuan')->count() . ' Perempuan '}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Pendaftaran Siswa Baru</h3>
                                    <div id="chart-mentions" class="chart-lg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Siswa Baru Belum Test</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap datatable">
                                        <thead>
                                            <tr>
                                                <th class="w-1">#</th>
                                                <th>Nama</th>
                                                <th>Kode</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;?>
                                            @foreach ($register as $showregister)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{App\Models\RegistrationDetail::find($showregister->id_registration)->nama}}</td>
                                                    <td>{{$showregister->kode}}</td>
                                                    <td class="text-capitalize">{{$showregister->is_active}}</td>
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
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var laki_lakijson   = null
        var perempuanjson   = null
        var tanggaljson     = null
        var request = new XMLHttpRequest();
        request.open('POST', '{{route("admin.testdata")}}', false);
        request.onreadystatechange = function(){
            if (this.status == 200 && this.readyState == 4) {
                var data    = JSON.parse(request.responseText);
                laki_lakijson   = data.laki_laki;
                perempuanjson   = data.perempuan;
                tanggaljson     = data.tanggal;
            }
        }

        var form = new FormData();
        form.append('_token', '{{csrf_token()}}')
        request.send(form);

        var laki_laki = [];
        laki_lakijson.forEach(element => {
            laki_laki.push(element);
        });
        var perempuan = [];
        perempuanjson.forEach(element => {
            perempuan.push(element);
        });
        var tanggal = [];
        tanggaljson.forEach(element => {
            tanggal.push(element);
        });

        document.addEventListener("DOMContentLoaded", function () {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-mentions'), {
                chart: {
                    type: "bar",
                    fontFamily: 'inherit',
                    height: 500,
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false,
                    },
                    animations: {
                        enabled: false
                    },
                    stacked: true,
                },
                plotOptions: {
                    bar: {
                        columnWidth: '50%',
                    }
                },
                dataLabels: {
                    enabled: false,
                },
                fill: {
                    opacity: 1,
                },
                series: [{
                    name: "Laki-Laki",
                    data: laki_laki
                },{
                    name: "Perempuan",
                    data: perempuan
                }],
                grid: {
                    padding: {
                        top: -20,
                        right: 0,
                        left: -4,
                        bottom: -4
                    },
                    strokeDashArray: 4,
                    xaxis: {
                        lines: {
                            show: true
                        }
                    },
                },
                xaxis: {
                    labels: {
                        padding: 0,
                    },
                    tooltip: {
                        enabled: false
                    },
                    axisBorder: {
                        show: false,
                    },
                    type: 'datetime',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                labels: tanggal,
                colors: ["#206bc4", "#79a6dc"],
                legend: {
                    show: false,
                },
            })).render();
        });
    </script>
@endpush
