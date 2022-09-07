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
                                Upload Materi
                            </div>
                            <h2 class="page-title">
                                {{$title}}
                            </h2>
                        </div>
                        <div class="col-12 col-md-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                    data-bs-target="#MateriModal" id="tambahmateri">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    Tambah Materi
                                </a>
                                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#MateriModal" id="tambahmateri" aria-label="Tambah Materi">
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
                                                <th>Mata Pelajaran</th>
                                                <th>Judul Materi</th>
                                                <th>Kelas</th>
                                                <th>Guru</th>
                                                <th>File Materi</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($material as $showmaterial)
                                                @php
                                                    $path = explode('/', $showmaterial->path);
                                                @endphp
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{App\Models\Subject::find($showmaterial->matapelajaran)->matapelajaran}}</td>
                                                    <td>{{$showmaterial->judul}}</td>
                                                    <td>{{$showmaterial->kelas}}</td>
                                                    <td>{{App\Models\TeacherDetail::find($showmaterial->id_guru)->nama}}</td>
                                                    <td>{{$path[1]}}</td>
                                                    <td width="100px">
                                                        <button type="button" class="btn btn-sm btn-warning" id="editmateri" data-bs-toggle="modal" data-bs-target="#MateriModal" data-id="{{$showmaterial->id}}">Ubah</button>
                                                        <form action="{{route('admin.material.destroy', $showmaterial->id)}}" method="post" class="d-inline">
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
                                    {{$material->links()}}
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
<div class="modal modal-blur fade" id="MateriModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Large modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body_materi">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="mapel">Mata Pelajaran</label>
                            <select class="form-control" id="mapel" name="mapel">
                                <option value="">-- Pilih --</option>
                                @foreach ($subject as $showsubject)
                                    <option value="{{$showsubject->id}}">{{$showsubject->matapelajaran}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="guru">Guru</label>
                            <select class="form-control" id="guru" name="guru">
                                <option value="">-- Pilih --</option>
                                @foreach ($teacher as $showteacher)
                                    <option value="{{$showteacher->id}}">{{$showteacher->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="judul">Judul</label>
                            <input type="text" id="judul" class="form-control" name="judul">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="kelas">Kelas</label>
                            <select class="form-control" id="kelas" name="kelas">
                                <option value="">-- Pilih --</option>
                                <option value="1">10</option>
                                <option value="2">11</option>
                                <option value="3">12</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="file">File Materi</label>
                            <input type="file" class="form-control" id="file" name="file">
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
            $('#tambahmateri').on('click', function () {
                $('.body_materi button[type=submit]').text('Add');
                $('.modal-title').text('Tambah Materi');
                $('.body_materi form').attr('action', '{{route("admin.material.store")}}');
                $('.body_materi form').attr('method', 'post');

                $("#mapel").val('');
                $("#judul").val('');
                $("#kelas").val('');
            });
            $('#editmateri*').on('click', function () {
                const id = $(this).data('id');
                let _url = '{{route("admin.material.edit",":id")}}'.replace(':id', id);

                $('.body_materi button[type=submit]').text('Edit');
                $('.modal-title').text('Edit Materi');
                $('.body_materi form').attr('action', '{{route("admin.material.update",":id")}}'.replace(':id', id));
                $('.body_materi form').attr('method', 'post');

                $.ajax({
                    type: 'POST',
                    url: _url,
                    data: {
                        _token: '{{csrf_token()}}',
                    },
                    success: function (hasil) {
                        $('#mapel').val(hasil.matapelajaran)
                        $('#judul').val(hasil.judul)
                        $('#kelas').val(hasil.kelas)
                    }
                });
            });
        });
    </script>
@endpush
