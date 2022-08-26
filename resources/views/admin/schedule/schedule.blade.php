@extends('layouts.base_dashboard')
@section('title', $title)
@section('content')
<div class="page">
    <x-sliderbar-admin></x-sliderbar-admin>
    <div class="page-wrapper">
        <div class="page-wrapper">
            <div class="container-xl">
                <div class="page-header d-print-none">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <div class="page-pretitle">
                                Management Sekolah
                            </div>
                            <h2 class="page-title">
                                {{$title}}
                            </h2>
                        </div>
                        <div class="col-12 col-md-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                    data-bs-target="#JadwalModal" id="tambahjadwal">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    Tambah Jadwal
                                </a>
                                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#JadwalModal" id="tambahjadwal" aria-label="Tambah Jadwal">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                </a>
                            </div>
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
                                    <h3 class="card-title">{{$title}}</h3>
                                </div>
                                <div class="card-body border-bottom py-3">
                                    <div class="d-flex">
                                        <div class="ms-auto text-muted">
                                            Search:
                                            <div class="ms-2 d-inline-block">
                                                <input type="text" class="form-control form-control-sm"
                                                    aria-label="Search invoice">
                                            </div>
                                        </div>
                                    </div>
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
                                                <th>Tahun</th>
                                                <th>Jurusan</th>
                                                <th>Kelas</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($schedule as $showschedule)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td class="text-capitalize">{{$showschedule->hari}}</td>
                                                    <td>{{$showschedule->jam_start . ' - ' . $showschedule->jam_end}}</td>
                                                    <td>{{App\Models\Subject::find($showschedule->matapelajaran)->matapelajaran}}</td>
                                                    <td>{{App\Models\TeacherDetail::find($showschedule->guru)->name}}</td>
                                                    <td>{{App\Models\Year::find($showschedule->tahun)->tahun}}</td>
                                                    <td>{{App\Models\Department::find($showschedule->jurusan)->jurusan}}</td>
                                                    <td>{{$showschedule->kelas}}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-warning" id="editjadwal" data-bs-toggle="modal" data-bs-target="#JadwalModal" data-id="{{$showschedule->id}}">Ubah</button>
                                                        <form action="{{route('admin.schedule.destroy', $showschedule->id)}}" method="post" class="d-inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-sm btn-primary">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer d-flex align-items-center">
                                    {{$schedule->links()}}
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
<div class="modal modal-blur fade" id="JadwalModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Large modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body_jadwal">
                <form action="" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="hari">Hari</label>
                            <select class="form-select @error('hari') is-invalid @enderror" id="hari" name="hari">
                                <option value="">-- Pilih --</option>
                                <option value="1">Senin</option>
                                <option value="2">Selasa</option>
                                <option value="3">Rabu</option>
                                <option value="4">Kamis</option>
                                <option value="5">Jum'at</option>
                                <option value="6">Sabtu</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="jam">Jam Pelajaran</label>
                            <select class="form-select @error('jam') is-invalid @enderror" id="jam" name="jam">
                                <option value="">-- Pilih --</option>
                                <option value="1">1 Jam Pelajaran</option>
                                <option value="2">2 Jam Pelajaran</option>
                                <option value="3">3 Jam Pelajaran</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="matapelajaran">Mata Pelajaran</label>
                            <select class="form-select @error('matapelajaran') is-invalid @enderror" id="matapelajaran" name="matapelajaran">
                                <option value="">-- Pilih --</option>
                                @foreach ($subject as $showsubject)
                                    <option value="{{$showsubject->id}}">{{$showsubject->matapelajaran}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="guru">Guru</label>
                            <select class="form-select @error('guru') is-invalid @enderror" id="guru" name="guru">
                                <option value="">-- Pilih --</option>
                                @foreach ($teacher as $showteacher)
                                    <option value="{{$showteacher->id}}">{{$showteacher->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="tahun">Tahun Pelajaran</label>
                            <select class="form-select @error('tahun') is-invalid @enderror" id="tahun" name="tahun">
                                <option value="">-- Pilih --</option>
                                @foreach ($year as $showyear)
                                    <option value="{{$showyear->id}}">{{$showyear->tahun}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="jurusan">Jurusan</label>
                            <select class="form-select @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan">
                                <option value="">-- Pilih --</option>
                                @foreach ($department as $showdepartment)
                                    <option value="{{$showdepartment->id}}">{{$showdepartment->jurusan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="kelas">Kelas</label>
                            <select class="form-select @error('kelas') is-invalid @enderror" id="kelas" name="kelas">
                                <option value="">-- Pilih --</option>
                                <option value="1">10</option>
                                <option value="2">11</option>
                                <option value="3">12</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#tambahjadwal').on('click', function () {
                $('.body_jadwal button[type=submit]').text('Add');
                $('.modal-title').text('Tambah Jadwal Pelajaran');
                $('.body_jadwal form').attr('action', '{{route("admin.schedule.store")}}');
                $('.body_jadwal form').attr('method', 'post');

                $("#hari").val('');
                $("#jam").val('');
                $("#matapelajaran").val('');
                $("#guru").val('');
                $("#tahun").val('');
                $("#jurusan").val('');
                $("#kelas").val('');
            });
            $('#editjadwal*').on('click', function () {
                const id = $(this).data('id');
                let _url = '{{route("admin.schedule.edit",":id")}}'.replace(':id', id);

                $('.body_jadwal button[type=submit]').text('Edit');
                $('.modal-title').text('Edit Jadwal Pelajaran');
                $('.body_jadwal form').attr('action', '{{route("admin.schedule.update",":id")}}'.replace(':id', id));
                $('.body_jadwal form').attr('method', 'post');

                $.ajax({
                    type: 'POST',
                    url: _url,
                    data: {
                        _token: '{{csrf_token()}}',
                    },
                    success: function (hasil) {
                        $('#hari').val(hasil.hari)
                        $('#jam').val(hasil.jam)
                        $('#matapelajaran').val(hasil.schedule.matapelajaran)
                        $('#guru').val(hasil.schedule.guru)
                        $('#tahun').val(hasil.schedule.tahun)
                        $('#jurusan').val(hasil.schedule.jurusan)
                        $('#kelas').val(hasil.kelas)
                    }
                });
            });
        });
    </script>
@endpush
