@extends('layouts.base_dashboard',['layout' => 'dashboard'])
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
                                    data-bs-target="#UjianModal" id="tambahujian">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    Tambah Jadwal Ujian
                                </a>
                                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#UjianModal" id="tambahujian" aria-label="Tambah Jadwal Ujian">
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
                                                <th>Tanggal</th>
                                                <th>Jam</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Jurusan</th>
                                                <th>Ujian</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($exam as $showexam)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$showexam->tanggal}}</td>
                                                    <td>{{$showexam->jam}}</td>
                                                    <td>{{App\Models\Subject::find($showexam->matapelajaran)->matapelajaran}}</td>
                                                    <td>{{App\Models\Department::find($showexam->jurusan)->jurusan}}</td>
                                                    <td>{{$showexam->tipe_ujian}}</td>
                                                    <td width="100px">
                                                        <button type="button" class="btn btn-sm btn-warning" href="" id="editujian" data-bs-toggle="modal" data-bs-target="#UjianModal" data-id="{{$showexam->id}}">Ubah</button>
                                                        <form action="{{route('admin.exam.destroy', $showexam->id)}}" method="post" class="d-inline" >
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
                                    {{$exam->links()}}
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
<div class="modal modal-blur fade" id="UjianModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Large modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body_ujian">
                <form action="" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="jam">Jam Ulangan</label>
                            <input type="text" class="form-control" id="jam" name="jam" placeholder="08:00 - 09:00">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="matapelajaran">Mata Pelajaran</label>
                            <select class="form-control" id="matapelajaran" name="matapelajaran">
                                <option value="">-- Pilih --</option>
                                @foreach ($subject as $subject)
                                    <option value="{{$subject->id}}">{{$subject->matapelajaran}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="jurusan">Jurusan</label>
                            <select class="form-control" id="jurusan" name="jurusan">
                                <option value="">-- Pilih --</option>
                                @foreach ($department as $department)
                                    <option value="{{$department->id}}">{{$department->jurusan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="tipe_ujian">Tipe Ujian</label>
                            <select class="form-control" id="tipe_ujian" name="tipe_ujian">
                                <option value="">-- Pilih --</option>
                                <option value="1">Tertulis</option>
                                <option value="1">Praktikum</option>
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
            $('#tambahujian').click(function () {
                $('.body_ujian button[type=submit]').html('Add');
                $('.modal-title').html('Tambah Jadwal Ujian');
                $('.body_ujian form').attr('action', '{{route("admin.exam.store")}}');
                $('.body_ujian form').attr('method', 'post');

                $("#tanggal").val('');
                $("#jam").val('');
                $("#matapelajaran").val('');
                $("#jurusan").val('');
                $("#tipe_ujian").val('');
            });
            $('#editujian*').click(function () {
                const id = $(this).data('id');
                let _url = '{{route("admin.exam.edit",":id")}}'.replace(':id', id);

                $('.body_ujian button[type=submit]').html('Edit');
                $('.modal-title').html('Edit Jadwal Ujian');
                $('.body_ujian form').attr('action', '{{route("admin.exam.update",":id")}}'.replace(':id', id));
                $('.body_ujian form').attr('method', 'post');

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
                        $('#jurusan').val(hasil.jurusan)
                        if (hasil.tipe_ujian == 'Tertulis') {
                            $('#tipe_ujian').val(1)
                        } else {
                            $('#tipe_ujian').val(2)
                        }
                    }
                });
            });
        });
    </script>
@endpush
