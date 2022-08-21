@extends('layouts.base_dashboard')
@section('title', $title)
@section('content')
<x-sliderbar-admin></x-sliderbar-admin>
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center mb-2">
                    <div class="col">
                        <h2 class="h5 page-title">{{$title}}</h2>
                    </div>
                    <div class="col-auto">
                        <div class="d-flex flex-row-reverse bd-highlight">
                            <div class="p-2 bd-highlight">
                                <a href="" class="btn mb-2 btn-primary" id="tambahnilai" data-toggle="modal" data-target="#NilaiModal" ><i class="fas fa-plus"></i><span>&nbsp; Tambah Nilai</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <strong class="card-title">{{$title}}</strong>
                            </div>
                            <div class="card-body my-n2">
                                <table class="table table-striped table-hover table-borderless">
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
                                            @php
                                                $mapel = App\Models\Subject::find($showgrade->mapel);
                                            @endphp
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$showgrade->nama}}</td>
                                                <td>{{$mapel->matapelajaran}}</td>
                                                <td>{{$showgrade->angka}}</td>
                                                <td>{{$showgrade->huruf}}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm dropdown-toggle more-vertical" type="button" id="dr1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="text-muted sr-only">Action</span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1">
                                                            <a class="dropdown-item" href="" id="editnilai" data-toggle="modal" data-target="#NilaiModal" data-id="{{$showgrade->id}}">Edit</a>
                                                            <form action="{{route('admin.grade.destroy', $showgrade->id)}}" method="post" >
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="dropdown-item">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$grade->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<div class="modal fade" id="NilaiModal" tabindex="-1" aria-labelledby="ModalNilaiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalNilaiLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="body_nilai">
                <form action="" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3 angka">
                            <label for="angka">Nilai Angka</label>
                            <input type="text" class="form-control" id="angka" name="angka">
                        </div>
                        <div class="form-group mb-3 huruf">
                            <label for="huruf">Nilai Huruf</label>
                            <input type="text" class="form-control" id="huruf" name="huruf">
                        </div>
                        <div class="form-group mb-3 guru">
                            <label for="guru">Guru Pengampu</label>
                            <select class="form-control" id="guru" name="guru">
                                <option value="">-- Pilih --</option>
                                @foreach ($teacher as $showteacher)
                                    <option value="{{$showteacher->id}}">{{$showteacher->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3 import_excel">
                            <label for="import_excel">Import File Nilai Excel</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="import_excel" name="import_excel">
                                <label class="custom-file-label" for="import_excel">Import File Nilai Excel</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer footer_nilai">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){$('#tambahnilai').on('click', function () {
            $('.footer_nilai button[type=submit]').html('Add');
                $('#ModalNilaiLabel').html('Tambah Nilai');
                $('.body_nilai form').attr('action', '{{route("admin.grade.store")}}');
                $('.body_nilai form').attr('method', 'post');

                $('.angka').hide()
                $('.huruf').hide()
                $('.import_excel').show()
                $('.guru').show()
            });
            $('#editnilai*').on('click', function () {
                const id = $(this).data('id');
                let _url = '{{route("admin.grade.edit",":id")}}'.replace(':id', id);

                $('.footer_nilai* button[type=submit]').html('Edit');
                $('#ModalNilaiLabel*').html('Edit Nilai');
                $('.body_nilai form*').attr('action', '{{route("admin.grade.update",":id")}}'.replace(':id', id));
                $('.body_nilai form*').attr('method', 'post');

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
