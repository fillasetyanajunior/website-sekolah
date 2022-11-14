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
                                Rekap Absen
                            </div>
                            <h2 class="page-title">
                                {{$title}}
                            </h2>
                        </div>
                        <div class="col-12 col-md-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                    data-bs-target="#AbsenModal" id="tambahabsen">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    Tambah Absen
                                </a>
                                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#AbsenModal" id="tambahabsen" aria-label="Tambah Absen">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                </a>
                                <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                    data-bs-target="#RekapAbsenModal" id="rekapbasen">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    Export Absen
                                </a>
                                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#RekapAbsenModal" id="rekapbasen" aria-label="Export Absen">
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
                <div class="container-fluid">
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
                                                <th>Nama</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Kelas</th>
                                                <th>Jurusan/Bagian Kelas</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($attendance as $showattendance)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{App\Models\StudentDetail::find($showattendance->id_siswa)->nama}}</td>
                                                    <td>{{App\Models\Subject::find($showattendance->matapelajaran)->matapelajaran}}</td>
                                                    <td>{{$showattendance->kelas}}</td>
                                                    <td>{{$showattendance->kelas == 'X' ? $showattendance->no_kelas : App\Models\Department::find($showattendance->jurusan)->jurusan}}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-warning" id="editmateri" data-bs-toggle="modal" data-bs-target="#AbsenModal" data-id="{{Crypt::encrypt($showattendance->id)}}">Ubah</button>
                                                        <form action="{{route('teacher.attendance.destroy', Crypt::encrypt($showattendance->id))}}" method="post" class="d-inline">
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
                                    {{$attendance->links()}}
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
<div class="modal modal-blur fade" id="RekapAbsenModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Large modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body_export">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="mapel">Mata Pelajaran</label>
                            <select class="form-control" id="mapel" name="mapel">
                                <option value="">-- Pilih --</option>
                                @foreach ($subject as $showsubject)
                                    <option value="{{$showsubject->matapelajaran}}">{{$showsubject->matapelajaran}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="kelas">Kelas</label>
                            <select class="form-control" id="kelas" name="kelas">
                                <option value="">-- Pilih --</option>
                                @foreach ($class as $showclass)
                                    <option value="{{$showclass->kelas}}">{{$showclass->kelas}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 jurusan">
                            <label class="form-label" for="jurusan">Jurusan</label>
                            <select class="form-select @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan">
                                <option value="">-- Pilih --</option>
                                @foreach ($department as $showdepartment)
                                    @if ($showdepartment->jurusan != null)
                                        <option value="{{gettype($showdepartment->jurusan) == 'integer' ? App\Models\Department::find($showdepartment->jurusan)->jurusan : $showdepartment->jurusan}}">{{gettype($showdepartment->jurusan) == 'integer' ? App\Models\Department::find($showdepartment->jurusan)->jurusan : $showdepartment->jurusan}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 bagian_kelas">
                            <label class="form-label" for="no_kelas">Bagian Kelas</label>
                            <select class="form-select @error('no_kelas') is-invalid @enderror" id="no_kelas" name="no_kelas">
                                <option value="">-- Pilih --</option>
                                @foreach ($no_class as $showno_class)
                                    @if ($showno_class->no_kelas != null)
                                        <option value="{{$showno_class->no_kelas}}">{{$showno_class->no_kelas}}</option>
                                    @endif
                                @endforeach
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
<div class="modal modal-blur fade" id="AbsenModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Large modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body_absen">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="matapelajaran">Mata Pelajaran</label>
                            <select class="form-control" id="matapelajaran" name="matapelajaran">
                                <option value="">-- Pilih --</option>
                                @foreach ($subject as $showsubject)
                                    <option value="{{App\Models\Subject::find($showsubject->matapelajaran)->matapelajaran}}">{{App\Models\Subject::find($showsubject->matapelajaran)->matapelajaran}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="kelas_add">Kelas</label>
                            <select class="form-control" id="kelas_add" name="kelas">
                                <option value="">-- Pilih --</option>
                                @foreach ($class as $showclass)
                                    <option value="{{$showclass->kelas}}">{{$showclass->kelas}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 jurusan_add">
                            <label class="form-label" for="jurusan_add">Jurusan</label>
                            <select class="form-select @error('jurusan') is-invalid @enderror" id="jurusan_add" name="jurusan">
                                <option value="">-- Pilih --</option>
                                @foreach ($department as $showdepartment)
                                    @if ($showdepartment->jurusan != null)
                                        <option value="{{gettype($showdepartment->jurusan) == 'integer' ? App\Models\Department::find($showdepartment->jurusan)->jurusan : $showdepartment->jurusan}}">{{gettype($showdepartment->jurusan) == 'integer' ? App\Models\Department::find($showdepartment->jurusan)->jurusan : $showdepartment->jurusan}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 bagian_kelas_add">
                            <label class="form-label" for="no_kelas_add">Bagian Kelas</label>
                            <select class="form-select @error('no_kelas') is-invalid @enderror" id="no_kelas_add" name="no_kelas">
                                <option value="">-- Pilih --</option>
                                @foreach ($no_class as $showno_class)
                                    @if ($showno_class->no_kelas != null)
                                        <option value="{{$showno_class->no_kelas}}">{{$showno_class->no_kelas}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="siswa">Siswa</label>
                            <select class="form-control" id="siswa" name="siswa">
                                <option value="">-- Pilih --</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="keterangan">Keterangan</label>
                            <select class="form-control" id="keterangan" name="keterangan">
                                <option value="">-- Pilih --</option>
                                <option value="1">Hadir</option>
                                <option value="2">Sakit</option>
                                <option value="3">Izin</option>
                                <option value="4">Tanpa Keterangan</option>
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
        $(document).ready(function(){
            $('.jurusan').hide()
            $('.bagian_kelas').hide()
            $('.jurusan_add').hide()
            $('.bagian_kelas_add').hide()

            $('#tambahabsen').on('click', function () {
                $('.body_absen button[type=submit]').text('Add');
                $('.modal-title').text('Tambah Absen');
                $('.body_absen form').attr('action', '{{route("teacher.attendance.store")}}');
                $('.body_absen form').attr('method', 'post');

                $("#mapel").val('');
                $("#jurusan_add").val('');
                $("#no_kelas_add").val('');
                $("#siswa").val('');
            });

            $('#kelas').change(function (){
                let id = $(this).val();
                if (id == 'X') {
                    $('.jurusan').hide();
                    $('.bagian_kelas').show();
                }else if(id == 'XI' || id == 'XII'){
                    $('.jurusan').show();
                    $('.bagian_kelas').hide();
                }else{
                    $('.jurusan').hide();
                    $('.bagian_kelas').hide();
                }
            });

            $('#kelas_add').change(function (){
                let id = $(this).val();
                if (id == 'X') {
                    $('.jurusan_add').hide();
                    $('.bagian_kelas_add').show();
                }else if(id == 'XI' || id == 'XII'){
                    $('.jurusan_add').show();
                    $('.bagian_kelas_add').hide();
                }else{
                    $('.jurusan_add').hide();
                    $('.bagian_kelas_add').hide();
                }
            });

            $('#jurusan_add').change(function(){
                 $.ajax({
                    type: 'POST',
                    url: '{{route("teacher.attendance.getstudent")}}',
                    data: {
                        _token: '{{csrf_token()}}',
                        kelas: $('#kelas_add').val(),
                        jurusan: $(this).val(),
                    },
                    success: function (hasil) {
                        $('#siswa').empty()
                        $('#siswa').append('<option value="">-- Pilih --</option>')
                        $.each(hasil, function(index, nama){
                            $('#siswa').append('<option value=":id">' + nama.nama + '</option>'.replace(':id', nama.nama))
                        });
                    }
                });
            });

            $('#no_kelas_add').change(function(){
                 $.ajax({
                    type: 'POST',
                    url: '{{route("teacher.attendance.getstudent")}}',
                    data: {
                        _token: '{{csrf_token()}}',
                        kelas: $('#kelas_add').val(),
                        no_kelas: $(this).val(),
                    },
                    success: function (hasil) {
                        $('#siswa').empty()
                        $('#siswa').append('<option value="">-- Pilih --</option>')
                        $.each(hasil, function(index, nama){
                            $('#siswa').append('<option value=":id">' + nama.nama + '</option>'.replace(':id', nama.nama))
                        });
                    }
                });
            });

            $('#editmateri*').on('click', function () {
                const id = $(this).data('id');
                let _url = '{{route("teacher.attendance.edit",":id")}}'.replace(':id', id);

                $('.body_absen button[type=submit]').text('Edit');
                $('.modal-title').text('Edit Materi');
                $('.body_absen form').attr('action', '{{route("teacher.attendance.update",":id")}}'.replace(':id', id));
                $('.body_absen form').attr('method', 'post');

                $.ajax({
                    type: 'POST',
                    url: _url,
                    data: {
                        _token: '{{csrf_token()}}',
                    },
                    success: function (hasil) {
                        $('#mapel').val(hasil.mapel)
                        $('#judul').val(hasil.judul)
                        $('#kelas').val(hasil.kelas)
                    }
                });
            });
        });
    </script>
@endpush
