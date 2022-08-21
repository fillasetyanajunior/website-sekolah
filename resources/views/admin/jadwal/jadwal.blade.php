@extends('layouts.base_dashboard')
@section('title', $title)
@section('content')
<x-sliderbar-admin></x-sliderbar-admin>
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center mb-2">
                    <div class="col">
                        <h2 class="h5 page-title">{{$title}}</h2>
                    </div>
                    <div class="col-auto">
                        <div class="d-flex flex-row-reverse bd-highlight">
                            <div class="p-2 bd-highlight">
                                <a href="" class="btn mb-2 btn-primary " id="tambahjadwal" data-toggle="modal" data-target="#JadwalModal"><i class="fas fa-plus"></i><span>&nbsp; Tambah Jadwal</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <strong class="card-title">{{$title}}</strong>
                            </div>
                            <div class="card-body my-n2">
                                <table class="table table-striped table-hover table-borderless">
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
                                            @php
                                                $mapel      = App\Models\Subject::find($showschedule->matapelajaran);
                                                $tahun      = App\Models\Year::find($showschedule->tahun);
                                                $jurusan    = App\Models\Department::find($showschedule->jurusan);
                                                $guru       = App\Models\Teacher::find($showschedule->guru);
                                            @endphp
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td class="text-capitalize">{{$showschedule->hari}}</td>
                                                <td>{{$showschedule->jam}} Pelajaran</td>
                                                <td>{{$mapel->matapelajaran}}</td>
                                                <td>{{$guru->name}}</td>
                                                <td>{{$tahun->tahun}}</td>
                                                <td>{{$jurusan->jurusan}}</td>
                                                <td>{{$showschedule->kelas}}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm dropdown-toggle more-vertical" type="button" id="dr1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="text-muted sr-only">Action</span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1">
                                                            <a class="dropdown-item" href="" id="editjadwal" data-toggle="modal" data-target="#JadwalModal" data-id="{{$showschedule->id}}">Edit</a>
                                                            <form action="/jadwal/delete/{{$showschedule->id}}" method="post" >
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="dropdown-item">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$schedule->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<div class="modal fade" id="JadwalModal" tabindex="-1" aria-labelledby="ModalJadwalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalJadwalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="body_jadwal">
                <form action="" method="POST" class="needs-validation" novalidate>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="hari">Hari</label>
                            <select class="form-control" id="hari" name="hari">
                                <option value="">-- Pilih --</option>
                                <option value="1">Senin</option>
                                <option value="2">Selasa</option>
                                <option value="3">Rabu</option>
                                <option value="4">Kamis</option>
                                <option value="5">Jum'at</option>
                                <option value="6">Sabtu</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jam">Jam Pelajaran</label>
                            <select class="form-control" id="jam" name="jam">
                                <option value="">-- Pilih --</option>
                                <option value="1">1 Jam Pelajaran</option>
                                <option value="2">2 Jam Pelajaran</option>
                                <option value="3">3 Jam Pelajaran</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="matapelajaran">Mata Pelajaran</label>
                            <select class="form-control" id="matapelajaran" name="matapelajaran">
                                <option value="">-- Pilih --</option>
                                @foreach ($subject as $showsubject)
                                    <option value="{{$showsubject->id}}">{{$showsubject->matapelajaran}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="guru">Guru</label>
                            <select class="form-control" id="guru" name="guru">
                                <option value="">-- Pilih --</option>
                                @foreach ($teacher as $showteacher)
                                    <option value="{{$showteacher->id}}">{{$showteacher->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tahun">Tahun Pelajaran</label>
                            <select class="form-control" id="tahun" name="tahun">
                                <option value="">-- Pilih --</option>
                                @foreach ($year as $showyear)
                                    <option value="{{$showyear->id}}">{{$showyear->tahun}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jurusan">Jurusan</label>
                            <select class="form-control" id="jurusan" name="jurusan">
                                <option value="">-- Pilih --</option>
                                @foreach ($department as $showdepartment)
                                    <option value="{{$showdepartment->id}}">{{$showdepartment->jurusan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="kelas">Kelas</label>
                            <select class="form-control" id="kelas" name="kelas">
                                <option value="">-- Pilih --</option>
                                <option value="1">10</option>
                                <option value="2">11</option>
                                <option value="3">12</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer footer_jadwal">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#tambahjadwal').on('click', function () {
                $('.footer_jadwal button[type=submit]').html('Add');
                $('#ModalJadwalLabel').html('Tambah Jadwal Pelajaran');
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

                $('.footer_jadwal* button[type=submit]').html('Edit');
                $('#ModalJadwalLabel*').html('Edit Jadwal Pelajaran');
                $('.body_jadwal form*').attr('action', '{{route("admin.schedule.update",":id")}}'.replace(':id', id));
                $('.body_jadwal form*').attr('method', 'post');

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
