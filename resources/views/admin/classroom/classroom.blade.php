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
                                Management Blog
                            </div>
                            <h2 class="page-title">
                                {{$title}}
                            </h2>
                        </div>
                        <div class="col-12 col-md-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                    data-bs-target="#ClassroomModal" id="tambahclassroom">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    Tambah Ruang Kelas
                                </a>
                                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#ClassroomModal" id="tambahclassroom" aria-label="Tambah Ruang Kelas">
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
                                                <th>Guru</th>
                                                <th>Kelas Jurusan/Bagian Kelas</th>
                                                <th>Nama Ruang Kelas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($classroom as $showclassroom)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{App\Models\TeacherDetail::find($showclassroom->id_guru)->nama}}</td>
                                                    <td>{{$showclassroom->jurusan != null ? $showclassroom->kelas . ' ' . App\Models\Department::find($showclassroom->jurusan)->jurusan : $showclassroom->kelas . ' ' . $showclassroom->no_kelas}}</td>
                                                    <td>{{App\Models\Subject::find($showclassroom->nama)->matapelajaran}}</td>
                                                    <td width="100px">
                                                        <button type="button" class="btn btn-sm btn-warning" id="editclassroom" data-bs-toggle="modal" data-bs-target="#ClassroomModal" data-id="{{Crypt::encrypt($showclassroom->id)}}">Ubah</button>
                                                        <form action="{{route('admin.classroom.destroy', Crypt::encrypt($showclassroom->id))}}" method="post" class="d-inline">
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
                                    {{$classroom->links()}}
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
<div class="modal modal-blur fade" id="ClassroomModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Large modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body_ruangkelas">
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="kelas">Kelas</label>
                            <select class="form-control" id="kelas" name="kelas">
                                <option value="">-- Pilih --</option>
                                <option value="1">10</option>
                                <option value="2">11</option>
                                <option value="3">12</option>
                            </select>
                        </div>
                        <div class="update">
                            <div class="mb-3">
                                <label class="form-label" for="matapelajaran">Mata Pelajaran</label>
                                <select class="form-control" id="matapelajaran" name="matapelajaran">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($subject as $showsubject)
                                        <option value="{{$showsubject->matapelajaran}}">{{$showsubject->matapelajaran}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="guru">Guru</label>
                                <select class="form-control" id="guru" name="guru">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($teacher as $showteacher)
                                        <option value="{{$showteacher->nama}}">{{$showteacher->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 jurusan">
                                <label class="form-label" for="jurusan">Jurusan</label>
                                <select class="form-control" id="jurusan" name="jurusan">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($department as $showdepartment)
                                        <option value="{{$showdepartment->jurusan}}">{{$showdepartment->jurusan}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 no_kelas">
                                <label class="form-label" for="no_kelas">Bagian Kelas</label>
                                <select class="form-control" id="no_kelas" name="no_kelas">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($no_kelas as $showno_kelas)
                                        <option value="{{$showno_kelas->no_kelas}}">{{$showno_kelas->no_kelas}}</option>
                                    @endforeach
                                </select>
                            </div>
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
            $('#tambahclassroom').click(function () {
                $('.body_ruangkelas button[type=submit]').html('Add');
                $('.modal-title').html('Tambah Ruang Kelas');
                $('.body_ruangkelas form').attr('action', '{{route("admin.classroom.store")}}');
                $('.body_ruangkelas form').attr('method', 'post');

                $('#title').val('')
                $('#thumnail').val('')
                $('#file').val('')

                $('.update').hide();
            });
            $('#editclassroom*').click(function () {
                $('.update').show();
                const id = $(this).data('id');
                let _url = '{{route("admin.classroom.edit",":id")}}'.replace(':id', id);

                $('.body_ruangkelas button[type=submit]').html('Edit');
                $('.modal-title').html('Edit Ruang Kelas');
                $('.body_ruangkelas form').attr('action', '{{route("admin.classroom.update",":id")}}'.replace(':id', id));
                $('.body_ruangkelas form').attr('method', 'post');

                $.ajax({
                    type: 'POST',
                    url: _url,
                    data: {
                        _token: '{{csrf_token()}}',
                    },
                    success: function (hasil) {
                        $('#matapelajaran').val(hasil.nama)
                        $('#jurusan').val(hasil.jurusan)
                        if (hasil.kelas == 'X') {
                            var kelas = 1;
                        }else if (hasil.kelas == 'XI') {
                            var kelas = 2;
                        } else {
                            var kelas = 3;
                        }
                        $('#kelas').val(kelas)
                        $('#no_kelas').val(hasil.no_kelas);
                        $('#guru').val(hasil.id_guru);
                        if (hasil.kelas == 'X') {
                            $('.jurusan').hide();
                            $('.no_kelas').show();
                        } else {
                            $('.jurusan').show();
                            $('.no_kelas').hide();
                        }
                    }
                });
            });
        });
    </script>
@endpush

