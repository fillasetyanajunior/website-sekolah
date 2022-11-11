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
                                Nilai
                            </div>
                            <h2 class="page-title">
                                {{$title}}
                            </h2>
                        </div>
                        <div class="col-12 col-md-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                    data-bs-target="#NilaiModal" id="tambahnilai">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    Mengunggah Nilai
                                </a>
                                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#NilaiModal" id="tambahnilai" aria-label="Mengunggah Nilai">
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
                                                <th>Angka</th>
                                                <th>Huruf</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i=1;
                                            @endphp
                                            @foreach ($grade as $showgrade)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{App\Models\StudentDetail::find($showgrade->id_siswa)->nama}}</td>
                                                    <td>{{App\Models\Subject::find($showgrade->matapelajaran)->matapelajaran}}</td>
                                                    <td>{{$showgrade->angka}}</td>
                                                    <td>{{$showgrade->huruf}}</td>
                                                    <td width="100px">
                                                        <button type="button" class="btn btn-sm btn-warning" id="editnilai" data-bs-toggle="modal" data-bs-target="#NilaiModal" data-id="{{Crypt::encrypt($showgrade->id)}}">Ubah</button>
                                                        <form action="{{route('admin.grade.destroy', Crypt::encrypt($showgrade->id))}}" method="post" class="d-inline">
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
                                    {{$grade->links()}}
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
<div class="modal modal-blur fade" id="NilaiModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Large modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body_nilai">
                <form action="" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 angka">
                            <label class="form-label" for="angka">Nilai Angka</label>
                            <input type="text" class="form-control" id="angka" name="angka">
                        </div>
                        <div class="mb-3 huruf">
                            <label class="form-label" for="huruf">Nilai Huruf</label>
                            <input type="text" class="form-control" id="huruf" name="huruf">
                        </div>
                        <div class="mb-3 guru">
                            <label class="form-label" for="guru">Guru Pengampu</label>
                            <select class="form-control" id="guru" name="guru">
                                <option value="">-- Pilih --</option>
                                @foreach ($teacher as $showteacher)
                                    <option value="{{$showteacher->id}}">{{$showteacher->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 import_excel">
                            <label class="form-label" for="import_excel">Import File Nilai Excel</label>
                            <input type="file" class="form-control" id="import_excel" name="import_excel">
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
            $('#tambahnilai').click(function () {
                $('.body_nilai button[type=submit]').text('Add');
                $('.modal-title').text('Tambah Nilai');
                $('.body_nilai form').attr('action', '{{route("admin.grade.store")}}');
                $('.body_nilai form').attr('method', 'post');

                $('.angka').hide()
                $('.huruf').hide()
                $('.import_excel').show()
                $('.guru').show()
            });
            $('#editnilai*').click(function () {
                const id = $(this).data('id');
                let _url = '{{route("admin.grade.edit",":id")}}'.replace(':id', id);

                $('.body_nilai button[type=submit]').text('Edit');
                $('.modal-title').text('Edit Nilai');
                $('.body_nilai form').attr('action', '{{route("admin.grade.update",":id")}}'.replace(':id', id));
                $('.body_nilai form').attr('method', 'post');

                $('.angka').show()
                $('.huruf').show()
                $('.import_excel').hide()
                $('.guru').hide()

                $.ajax({
                    type: 'POST',
                    url: _url,
                    data: {
                        _token: '{{csrf_token()}}',
                    },
                    success: function (hasil) {
                        $('#angka').val(hasil.angka)
                        $('#huruf').val(hasil.huruf)
                    }
                });
            });
        });
    </script>
@endpush
