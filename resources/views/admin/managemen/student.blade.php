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
                                Management User
                            </div>
                            <h2 class="page-title">
                                {{$title}}
                            </h2>
                        </div>
                        <div class="col-12 col-md-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                    data-bs-target="#SiswaModal" id="tambahsiswa">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    Tambah Siswa
                                </a>
                                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#SiswaModal" id="tambahsiswa" aria-label="Tambah Siswa">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                </a>
                                <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                    data-bs-target="#SiswaKelasModal" id="tambahsiswakelas">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    Tambah Siswa Dengan Kelas
                                </a>
                                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#SiswaKelasModal" id="tambahsiswakelas" aria-label="Tambah Siswa Dengan Kelas">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                </a>
                                <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                    data-bs-target="#ExportModal" id="exportdata">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    Export Username
                                </a>
                                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#ExportModal" id="exportdata" aria-label="Export Username">
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
                                                <th>Username</th>
                                                <th>Kelas</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($student as $showstudent)
                                                @php
                                                    $detail = App\Models\StudentDetail::find($showstudent->id_siswa);
                                                @endphp
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$showstudent->name}}</td>
                                                    <td>{{$showstudent->username}}</td>
                                                    @if ($detail->kelas == 'X')
                                                        <td>{{$detail->kelas . ' ' . $detail->no_kelas}}</td>
                                                    @else
                                                        <td>{{$detail->kelas . ' ' . App\Models\Department::find($detail->jurusan)->jurusan}}</td>
                                                    @endif
                                                    <td width="100px">
                                                        <button type="button" class="btn btn-sm btn-warning" id="editsiswa" data-bs-toggle="modal" data-bs-target="#SiswaModal" data-id="{{Crypt::encrypt($showstudent->id)}}">Ubah</button>
                                                        <form action="{{route('admin.student.destroy', Crypt::encrypt($showstudent->id))}}" method="post" class="d-inline">
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
                                    {{$student->links()}}
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
<div class="modal modal-blur fade" id="SiswaModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Large modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body_siswa">
                <form action="" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="name">Name Siswa</label>
                            <select class="form-control" id="name" name="name">
                                <option value="">-- Pilih --</option>
                                @foreach ($siswa as $siswa)
                                    <option value="{{$siswa->nama}}">{{$siswa->kelas == 'X' ? $siswa->nama . ' - ' . $siswa->kelas . ' ' . $siswa->no_kelas : $siswa->nama . ' - ' . $siswa->kelas . ' ' .  App\Models\Department::find($siswa->jurusan)->jurusan}}</option>
                                @endforeach
                            </select>
                        </div>
                         <div class="mb-3 username">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="mb-3 password">
                            <label class="form-label" for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password">
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
<div class="modal modal-blur fade" id="SiswaKelasModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Large modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body_siswa_kelas">
                <form action="" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="kelas">Kelas</label>
                            <select class="form-control @error('kelas') is-invalid @enderror" id="kelas" name="kelas">
                                <option value="">-- Pilih --</option>
                                <option value="1">X</option>
                                <option value="2">XI</option>
                                <option value="3">XII</option>
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
<div class="modal modal-blur fade" id="ExportModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Large modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body_export">
                <form action="" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="kelasexport">Kelas</label>
                            <select class="form-control @error('kelas') is-invalid @enderror" id="kelasexport" name="kelas">
                                <option value="">-- Pilih --</option>
                                <option value="1">X</option>
                                <option value="2">XI</option>
                                <option value="3">XII</option>
                            </select>
                        </div>
                        <div class="mb-3 jurusanexport">
                            <label class="form-label" for="jurusanexport">Jurusan</label>
                            <select class="form-select @error('jurusan') is-invalid @enderror" id="jurusanexport" name="jurusan">
                                <option value="">-- Pilih --</option>
                                @foreach ($department as $showdepartment)
                                    <option value="{{$showdepartment->jurusan}}">{{$showdepartment->jurusan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 bagian_kelasexport">
                            <label class="form-label" for="no_kelasexport">Bagian Kelas</label>
                            <select class="form-select @error('no_kelas') is-invalid @enderror" id="no_kelasexport" name="no_kelas">
                                <option value="">-- Pilih --</option>
                                @foreach ($class as $showclass)
                                    @if ($showclass->no_kelas != null)
                                        <option value="{{$showclass->no_kelas}}">{{$showclass->no_kelas}}</option>
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
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.jurusanexport').hide()
            $('.bagian_kelasexport').hide()

            $('#tambahsiswa').click(function () {
                $('.body_siswa button[type=submit]').text('Add');
                $('.modal-title').text('Tambah User Siswa');
                $('.body_siswa form').attr('action', '{{route("admin.student.store")}}');
                $('.body_siswa form').attr('method', 'post');

                $('.username').hide()
                $('.password').hide()

                $('#name').val('')
                $('#username').val('')
                $('#password').val('')
            });

            $('#exportdata').click(function () {
                $('.body_export button[type=submit]').text('Export');
                $('.modal-title').text('Export Username Siswa');
                $('.body_export form').attr('action', '{{route("admin.student.show")}}');
                $('.body_export form').attr('method', 'post');

                $('#kelasexport').val('');
                $('#jurusanexport').val('');
                $('#no_kelasexport').val('');

                $('#kelasexport').trigger('change');
            });

            $('#kelasexport').change(function (){
                let id = $(this).val();
                if (id == 1) {
                    $('.jurusanexport').hide();
                    $('.bagian_kelasexport').show();
                }else if(id == 2 || id == 3){
                    $('.jurusanexport').show();
                    $('.bagian_kelasexport').hide();
                }else{
                    $('.jurusanexport').hide();
                    $('.bagian_kelasexport').hide();
                }
            });

            $('#tambahsiswakelas').click(function () {
                $('.body_siswa_kelas button[type=submit]').text('Add');
                $('.modal-title').text('Tambah User Siswa');
                $('.body_siswa_kelas form').attr('action', '{{route("admin.student.store")}}');
                $('.body_siswa_kelas form').attr('method', 'post');

                $('#kelas').val('')
                $('#jurusan').val('')
                $('#no_kelas').val('')
            });

            $('#editsiswa*').click(function () {
                const id = $(this).data('id');
                let _url = '{{route("admin.student.edit",":id")}}'.replace(':id', id);

                $('.body_siswa button[type=submit]').text('Edit');
                $('.modal-title').text('Edit User Siswa');
                $('.body_siswa form').attr('action', '{{route("admin.student.update",":id")}}'.replace(':id', id));
                $('.body_siswa form').attr('method', 'post');

                $('.username').show()
                $('.password').show()


                $.ajax({
                    type: 'POST',
                    url: _url,
                    data: {
                        _token: '{{csrf_token()}}',
                    },
                    success: function (hasil) {
                        $('#name').val(hasil.student.name)
                        $('#username').val(hasil.student.username)
                        $('#password').val(hasil.password_encrypted)
                    }
                });
            });
        });
    </script>
@endpush
