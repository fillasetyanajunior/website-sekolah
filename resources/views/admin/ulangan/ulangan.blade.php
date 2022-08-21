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
                                <a href="" class="btn mb-2 btn-primary " id="tambahulangan" data-toggle="modal" data-target="#UlanganModal"><i class="fas fa-plus"></i><span>&nbsp; Tambah Jadwal</span></a>
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
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Tahun</th>
                                            <th>Jurusan</th>
                                            <th>Kursi</th>
                                            <th>Kelas</th>
                                            <th>Ruangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($deuteronomi as $showdeuteronomi)
                                            @php
                                                $matapelajaran  = App\Models\Subject::find($showdeuteronomi->matapelajaran);
                                                $jurusan        = App\Models\Department::find($showdeuteronomi->jurusan);
                                                $tahun          = App\Models\Year::find($showdeuteronomi->tahun);
                                                $kelas          = explode('/', $showdeuteronomi->kelas);
                                            @endphp
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$showdeuteronomi->tanggal}}</td>
                                                <td>{{$showdeuteronomi->jam}}</td>
                                                <td>{{$matapelajaran->matapelajaran}}</td>
                                                <td>{{$tahun->tahun}}</td>
                                                <td>{{$jurusan->jurusan}}</td>
                                                <td>{{$showdeuteronomi->kursi}}</td>
                                                <td>
                                                    @if ($kelas[0] == 1)
                                                        X
                                                    @elseif ($kelas[0] == 2)
                                                        XI
                                                    @else
                                                        XII
                                                    @endif
                                                    /
                                                    @if ($kelas[1] == 1)
                                                        X
                                                    @elseif ($kelas[1] == 2)
                                                        XI
                                                    @else
                                                        XII
                                                    @endif
                                                </td>
                                                <td>Ruangan {{$showdeuteronomi->ruangan}}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm dropdown-toggle more-vertical" type="button" id="dr1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="text-muted sr-only">Action</span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1">
                                                            <a class="dropdown-item" href="" id="editulangan" data-toggle="modal" data-target="#UlanganModal" data-id="{{$showdeuteronomi->id}}">Edit</a>
                                                            <form action="{{route('admin.deuteronomi.destroy', $showdeuteronomi->id)}}" method="post" >
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
                                {{$deuteronomi->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<div class="modal fade" id="UlanganModal" tabindex="-1" aria-labelledby="ModalUlanganLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalUlanganLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="body_ulangan">
                <form action="" method="POST" class="needs-validation" novalidate>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                        </div>
                        <div class="form-group mb-3">
                            <label for="jam">Jam Ulangan</label>
                            <input type="text" class="form-control" id="jam" name="jam" placeholder="08:00 - 09:00">
                        </div>
                        <div class="form-group mb-3">
                            <label for="matapelajaran">Mata Pelajaran</label>
                            <select class="form-control" id="matapelajaran" name="matapelajaran">
                                <option value="">-- Pilih --</option>
                                @foreach ($subject as $subject)
                                    <option value="{{$subject->id}}">{{$subject->matapelajaran}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tahun">Tahun Pelajaran</label>
                            <select class="form-control" id="tahun" name="tahun">
                                <option value="">-- Pilih --</option>
                                @foreach ($year as $year)
                                    <option value="{{$year->id}}">{{$year->tahun}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jurusan">Jurusan</label>
                            <select class="form-control" id="jurusan" name="jurusan">
                                <option value="">-- Pilih --</option>
                                @foreach ($department as $department)
                                    <option value="{{$department->id}}">{{$department->jurusan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="kursi">Jumlah Kursi</label>
                            <input type="text" class="form-control" id="kursi" name="kursi" placeholder="40">
                        </div>
                        <div class="form-group mb-3">
                            <label for="ruangan">Ruangan</label>
                            <select class="form-control" id="ruangan" name="ruangan">
                                <option value="">-- Pilih --</option>
                                @for ($i = 1; $i <= 18; $i++)
                                    <option value="{{$i}}">Ruangan {{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="kelas_pertama">Kelas Pertama</label>
                            <select class="form-control" id="kelas_pertama" name="kelas_pertama">
                                <option value="">-- Pilih --</option>
                                <option value="1">10</option>
                                <option value="2">11</option>
                                <option value="3">12</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="kelas_kedua">Kelas KEdua</label>
                            <select class="form-control" id="kelas_kedua" name="kelas_kedua">
                                <option value="">-- Pilih --</option>
                                <option value="1">10</option>
                                <option value="2">11</option>
                                <option value="3">12</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer footer_ulangan">
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
            $('#tambahulangan').on('click', function () {
                $('.footer_ulangan button[type=submit]').html('Add');
                $('#ModalUlanganLabel').html('Tambah Jadwal Ulangan');
                $('.body_ulangan form').attr('action', '{{route("admin.deuteronomi.store")}}');
                $('.body_ulangan form').attr('method', 'post');

                $("#tanggal").val('');
                $("#jam").val('');
                $("#matapelajaran").val('');
                $("#tahun").val('');
                $("#jurusan").val('');
                $("#kursi").val('');
                $("#ruangan").val('');
                $("#kelas_pertama").val('');
                $("#kelas_kedua").val('');
            });
            $('#editulangan*').on('click', function () {
                const id = $(this).data('id');
                let _url = '{{route("admin.deuteronomi.edit",":id")}}'.replace(':id', id);

                $('.footer_ulangan button[type=submit]').html('Edit');
                $('#ModalUlanganLabel').html('Edit Jadwal Ulangan');
                $('.body_ulangan form').attr('action', '{{route("admin.deuteronomi.update",":id")}}'.replace(':id', id));
                $('.body_ulangan form').attr('method', 'post');

                $.ajax({
                    type: 'POST',
                    url: _url,
                    data: {
                        _token: '{{csrf_token()}}',
                    },
                    success: function (hasil) {
                        $('#tanggal').val(hasil.tanggal)
                        $('#jam').val(hasil.jam)
                        $('#matapelajaran').val(hasil.matapelajaran)
                        $('#tahun').val(hasil.tahun)
                        $('#jurusan').val(hasil.jurusan)
                        $('#kursi').val(hasil.kursi)
                        $('#ruangan').val(hasil.ruangan)

                        var kelas = hasil.kelas.split('/');

                        $("#kelas_pertama").val(kelas[0]);
                        $("#kelas_kedua").val(kelas[1]);
                    }
                });
            });
        });
    </script>
@endpush
