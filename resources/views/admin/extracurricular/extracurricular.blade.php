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
                                    data-bs-target="#ExtraModal" id="tambahextra">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    Mengunggah Nilai Extra
                                </a>
                                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#ExtraModal" id="tambahextra" aria-label="Mengunggah Nilai Extra">
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
                                                <th>Ektrakulikuler</th>
                                                <th>Angka</th>
                                                <th>Huruf</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i=1;
                                            @endphp
                                            @foreach ($extra as $showextra)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{App\Models\StudentDetail::find($showextra->id_siswa)}}</td>
                                                    <td>{{$showextra->extra}}</td>
                                                    <td>{{$showextra->angka}}</td>
                                                    <td>{{$showextra->huruf}}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-warning" id="editextra" data-bs-toggle="modal" data-bs-target="#ExtraModal" data-id="{{Crypt::encrypt($showextra->id)}}">Ubah</button>
                                                        <form action="{{route('admin.extracurricular.destroy', Crypt::encrypt($showextra->id))}}" method="post" >
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
                                    {{$extra->links()}}
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
<div class="modal modal-blur fade" id="ExtraModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Large modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body_extra">
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
            $('#tambahextra').click(function () {
                $('.body_extra button[type=submit]').text('Add');
                $('.modal-title').text('Tambah Extra');
                $('.body_extra form').attr('action', '{{route("admin.extracurricular.store")}}');
                $('.body_extra form').attr('method', 'post');

                $('.angka').hide()
                $('.huruf').hide()
                $('.import_excel').show()
            });
            $('#editextra*').click(function () {
                const id = $(this).data('id');
                let _url = '{{route("admin.extracurricular.edit",":id")}}'.replace(':id', id);

                $('.body_extra button[type=submit]').text('Edit');
                $('.modal-title').text('Edit Extra');
                $('.body_extra form').attr('action', '{{route("admin.extracurricular.update",":id")}}'.replace(':id', id));
                $('.body_extra form').attr('method', 'post');

                $('.angka').show()
                $('.huruf').show()
                $('.import_excel').hide()

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
