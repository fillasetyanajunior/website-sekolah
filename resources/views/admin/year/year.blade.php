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
                                Management Sekolah
                            </div>
                            <h2 class="page-title">
                                {{$title}}
                            </h2>
                        </div>
                        <div class="col-12 col-md-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                    data-bs-target="#TahunModal" id="tambahtahun">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    Tambah Tahun
                                </a>
                                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#TahunModal" id="tambahtahun" aria-label="Tambah Tahun">
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
                                                <th>Tahun</th>
                                                <th>Semester</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($year as $showyear)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$showyear->tahun}}</td>
                                                <td>{{$showyear->semester}}</td>
                                                <td width="100px">
                                                    <button type="button" class="btn btn-sm btn-warning" id="edittahun" data-bs-toggle="modal" data-bs-target="#TahunModal" data-id="{{Crypt::encrypt($showyear->id)}}">Edit</button>
                                                    <form action="{{route('admin.year.destroy',Crypt::encrypt($showyear->id))}}" method="post" class="d-inline">
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
                                    {{$year->links()}}
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
<div class="modal modal-blur fade" id="TahunModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Large modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body_tahun">
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="tahun">Tahun Ajaran</label>
                            <input type="text" class="form-control" id="tahun" name="tahun" placeholder="2021/2022">
                        </div>
                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select name="semester" id="semester" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="1">Ganjil</option>
                                <option value="2">Ganap</option>
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
            $('#tambahtahun').click(function () {
                $('.body_tahun button[type=submit]').html('Add');
                $('.modal-title').html('Tambah Tahun Ajaran');
                $('.body_tahun form').attr('action', '{{route("admin.year.store")}}');
                $('.body_tahun form').attr('method', 'post');

                $("#tahun").val('');
                $("#semester").val('');
            });
            $('#edittahun*').click(function () {
                const id = $(this).data('id');
                let _url = '{{route("admin.year.edit",":id")}}'.replace(':id', id);

                $('.body_tahun button[type=submit]').html('Edit');
                $('.modal-title').html('Edit Tahun Ajaran');
                $('.body_tahun form').attr('action', '{{route("admin.year.update",":id")}}'.replace(':id', id));
                $('.body_tahun form').attr('method', 'post');

                $.ajax({
                    type: 'POST',
                    url: _url,
                    data: {
                        _token: '{{csrf_token()}}',
                    },
                    success: function (hasil) {
                        $('#tahun').val(hasil.tahun)
                        if (hasil.semester == 'Ganjil') {
                            $('#semester').val(1);
                        } else {
                            $('#semester').val(2);
                        }
                    }
                });
            });
        });
    </script>
@endpush
