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
                                    data-bs-target="#UlanganModal" id="tambahulangan">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    Tambah Jadwal Ulangan
                                </a>
                                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#UlanganModal" id="tambahulangan" aria-label="Tambah Jadwal Ulangan">
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
                                                <th>Tahun</th>
                                                <th>Jurusan</th>
                                                <th>Kelas</th>
                                                <th>Ruangan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($deuteronomi as $showdeuteronomi)
                                                @php
                                                    $detail = App\Models\Deuteronomi::where('kelas', $showdeuteronomi->kelas)->first();
                                                @endphp
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$detail->tanggal}}</td>
                                                    <td>{{$detail->jam}}</td>
                                                    <td>{{App\Models\Subject::find($detail->matapelajaran)->matapelajaran}}</td>
                                                    <td>{{App\Models\Year::find($detail->tahun)->tahun}}</td>
                                                    <td>{{App\Models\Department::find($detail->jurusan)->jurusan}}</td>
                                                    <td>{{$detail->kelas}}</td>
                                                    <td>Ruangan {{$detail->ruangan}}</td>
                                                    <td width="100px">
                                                        <button type="button" class="btn btn-sm btn-warning" href="" id="editulangan" data-bs-toggle="modal" data-bs-target="#UlanganModal" data-id="{{$detail->id}}">Ubah</button>
                                                        <form action="{{route('admin.deuteronomi.destroy', $detail->id)}}" method="post" class="d-inline" >
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
                                    {{$deuteronomi->links()}}
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
<div class="modal modal-blur fade" id="UlanganModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Large modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body_ulangan">
                <form action="" method="POST" class="needs-validation" novalidate>
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
                            <label class="form-label" for="tahun">Tahun Pelajaran</label>
                            <select class="form-control" id="tahun" name="tahun">
                                <option value="">-- Pilih --</option>
                                @foreach ($year as $year)
                                    <option value="{{$year->id}}">{{$year->tahun}}</option>
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
                            <label class="form-label" for="kursi">Jumlah Kursi</label>
                            <input type="text" class="form-control" id="kursi" name="kursi" placeholder="40">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="ruangan">Ruangan</label>
                            <select class="form-control" id="ruangan" name="ruangan">
                                <option value="">-- Pilih --</option>
                                @for ($i = 1; $i <= 18; $i++)
                                    <option value="{{$i}}">Ruangan {{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="kelas_pertama">Kelas Pertama</label>
                            <select class="form-control" id="kelas_pertama" name="kelas_pertama">
                                <option value="">-- Pilih --</option>
                                <option value="1">10</option>
                                <option value="2">11</option>
                                <option value="3">12</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="kelas_kedua">Kelas Kedua</label>
                            <select class="form-control" id="kelas_kedua" name="kelas_kedua">
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
            $('#tambahulangan').on('click', function () {
                $('.body_ulangan button[type=submit]').html('Add');
                $('.modal-title').html('Tambah Jadwal Ulangan');
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

                $('.body_ulangan button[type=submit]').html('Edit');
                $('.modal-title').html('Edit Jadwal Ulangan');
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
