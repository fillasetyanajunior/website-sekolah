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
                                PSB
                            </div>
                            <h2 class="page-title">
                                {{$title}}
                            </h2>
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
                                                <th>Nama</th>
                                                <th>NISN</th>
                                                <th>Kode</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($registration as $showregistration)
                                                @php
                                                    $detail = App\Models\RegistrationDetail::find($showregistration->id_siswa);
                                                @endphp
                                                <tr>
                                                    <th>{{$i++}}</th>
                                                    <td>{{$detail->nama}}</td>
                                                    <td>{{$detail->nisn}}</td>
                                                    <td>{{$showregistration->kode}}</td>
                                                    <td class="text-capitalize">{{$showregistration->is_active}}</td>
                                                    <td width="100px">
                                                        <button type="button" class="btn btn-sm btn-warning" id="editpendaftaran" data-bs-toggle="modal" data-bs-target="#PendaftaranModal" data-id="{{$showregistration->id}}">Edit</button>
                                                        <form action="/pendaftaran/{{$showregistration->id}}" method="post" class="d-inline">
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
                                    {{$registration->links()}}
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
<div class="modal modal-blur fade" id="PendaftaranModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Large modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body_pendaftaran">
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="nisn">NISN</label>
                            <input type="text" class="form-control" id="nisn" name="nisn">
                        </div>
                        <div class="form-group">
                            <label for="kode">Kode Pendaftaran</label>
                            <input type="text" class="form-control" id="kode" name="kode">
                        </div>
                        <div class="form-group mb-3">
                            <label for="jurusan">Jurusan</label>
                            <select class="form-control" id="jurusan" name="jurusan">
                                <option value="">-- Pilih --</option>
                                @foreach ($department as $department)
                                    <option value="{{$department->kode}}">{{$department->jurusan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="active">Status</label>
                            <select class="form-control" id="active" name="active">
                                <option value="">-- Pilih --</option>
                                <option value="1">Belum Test</option>
                                <option value="2">Sudah Test</option>
                                <option value="3">Lulus</option>
                                <option value="4">Tolak</option>
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
            $('#editpendaftaran*').on('click', function () {
                const id = $(this).data('id');
                let _url = '{{route("admin.registration.edit",":id")}}'.replace(':id',id);

                $('.body_pendaftaran button[type=submit]').html('Edit');
                $('.modal-title').html('Edit Pendaftaran');
                $('.body_pendaftaran form').attr('action', '{{route("admin.registration.update",":id")}}'.replace(':id',id));
                $('.body_pendaftaran form').attr('method', 'post');

                $.ajax({
                    type: 'POST',
                    url: _url,
                    data: {
                        _token: '{{csrf_token()}}',
                    },
                    success: function (hasil) {
                        $('#name').val(hasil.detail.nama)
                        $('#nisn').val(hasil.detail.nisn)
                        $('#kode').val(hasil.registration.kode)
                        if (hasil.registration.is_active == 'belum test') {
                            $('#active').val(1)
                        } else if (hasil.registration.is_active == 'sudah test') {
                            $('#active').val(2)
                        } else if (hasil.registration.is_active == 'lulus') {
                            $('#active').val(3)
                        }else{
                            $('#active').val(4)
                        }
                    }
                });
            });
        })
    </script>
@endpush
