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
                                Management Blog
                            </div>
                            <h2 class="page-title">
                                {{$title}}
                            </h2>
                        </div>
                        <div class="col-12 col-md-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                    data-bs-target="#PrestasiModal" id="tambahprestasi">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    Tambah Prestasi
                                </a>
                                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#PrestasiModal" id="tambahprestasi" aria-label="Tambah Prestasi">
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
                                                <th>Kegiatan</th>
                                                <th>Penyelenggara</th>
                                                <th>Juara</th>
                                                <th>Keterangan</th>
                                                <th>Tahun</th>
                                                <th>Tingkatan</th>
                                                <th>Prestasi</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($achievement as $showachievement)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$showachievement->kegiatan}}</td>
                                                    <td>{{$showachievement->penyelenggara}}</td>
                                                    <td>{{$showachievement->juara}}</td>
                                                    <td>{{$showachievement->keterangan}}</td>
                                                    <td>{{$showachievement->tahun}}</td>
                                                    <td>{{$showachievement->tingkatan}}</td>
                                                    <td>{{$showachievement->prestasi}}</td>
                                                    <td width="100px">
                                                        <button type="button" class="btn btn-sm btn-warning" id="editprestasi" data-bs-toggle="modal" data-bs-target="#PrestasiModal" data-id="{{$showachievement->id}}">Ubah</button>
                                                        <form action="{{route('admin.achievement.destroy', $showachievement->id)}}" method="post" class="d-inline">
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
                                    {{$achievement->links()}}
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
<div class="modal modal-blur fade" id="PrestasiModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Large modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body_prestasi">
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="kegiatan">Kegiatan</label>
                            <input type="text" class="form-control" id="kegiatan" name="kegiatan">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="penyelenggara">Penyelenggara</label>
                            <input type="text" class="form-control" id="penyelenggara" name="penyelenggara">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="juara">Juara</label>
                            <input type="text" class="form-control" id="juara" name="juara">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="keterangan">Nama Perwakilan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="tahun">Tahun</label>
                            <input type="text" class="form-control" id="tahun" name="tahun">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="tingkatan">Tingkatan</label>
                            <input type="text" class="form-control" id="tingkatan" name="tingkatan">
                        </div>
                        <div class="mb-3">
                            <label for="prestasi" class="form-label">Prestasi</label>
                            <select name="prestasi" id="prestasi" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="1">Akademik</option>
                                <option value="2">Non-Akademik</option>
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
            $('#tambahprestasi').on('click', function () {
                $('.body_prestasi button[type=submit]').html('Add');
                $('.modal-title').html('Tambah Prestasi');
                $('.body_prestasi form').attr('action', '{{route("admin.achievement.store")}}');
                $('.body_prestasi form').attr('method', 'post');

                $('#title').val('')
                $('#description').val('')
                $('#thumnail').val('')
            });
            $('#editprestasi*').on('click', function () {
                const id = $(this).data('id');
                let _url = '{{route("admin.achievement.edit",":id")}}'.replace(':id', id);

                $('.body_prestasi button[type=submit]').html('Edit');
                $('.modal-title').html('Edit Prestasi');
                $('.body_prestasi form').attr('action', '{{route("admin.achievement.update",":id")}}'.replace(':id', id));
                $('.body_prestasi form').attr('method', 'post');

                $.ajax({
                    type: 'POST',
                    url: _url,
                    data: {
                        _token: '{{csrf_token()}}',
                    },
                    success: function (hasil) {
                        $('#kegiatan').val(hasil.kegiatan)
                        $('#penyelenggara').val(hasil.penyelenggara)
                        $('#juara').val(hasil.juara)
                        $('#keterangan').val(hasil.keterangan)
                        $('#tahun').val(hasil.tahun)
                        $('#tingkatan').val(hasil.tingkatan)
                        if (hasil.prestasi == 'Akademik') {
                            $('#prestasi').val(1)
                        } else {
                            $('#prestasi').val(2)
                        }
                    }
                });
            });
        });
    </script>
@endpush

