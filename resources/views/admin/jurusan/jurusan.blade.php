@extends('layouts.base_dashboard')
@section('title',$title)
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
                                <a href="" class="btn mb-2 btn-primary " id="tambahjurusan" data-toggle="modal" data-target="#jurusanModal"><i class="fas fa-plus"></i><span>&nbsp; Tambah Jurusan</span></a>
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
                                            <th>Jurusan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($jurusan as $showjurusan)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$showjurusan->jurusan}}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm dropdown-toggle more-vertical" type="button" id="dr1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="text-muted sr-only">Action</span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1">
                                                            <a class="dropdown-item" href="" id="editjurusan" data-toggle="modal" data-target="#jurusanModal" data-id="{{$showjurusan->id}}">Edit</a>
                                                            <form action="{{route('admin.department.destroy', $showjurusan->id)}}" method="post" >
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
                                {{$jurusan->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<div class="modal fade" id="jurusanModal" tabindex="-1" aria-labelledby="ModalJurusanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalJurusanLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="body_jurusan">
                <form action="" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="IPA">
                        </div>
                    </div>
                    <div class="modal-footer footer_jurusan">
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
        $(document).ready(function () {
            $('#tambahjurusan').on('click', function () {
                $('.footer_jurusan button[type=submit]').html('Add');
                $('#ModalJurusanLabel').html('Tambah Jurusan');
                $('.body_jurusan form').attr('action', '{{route("admin.department.store")}}');
                $('.body_jurusan form').attr('method', 'post');

                $("#jurusan").val('');
            });
            $('#editjurusan*').on('click', function () {
                const id = $(this).data('id');
                let _url = '{{route("admin.department.edit",":id")}}'.replace(':id', id);

                $('.footer_jurusan* button[type=submit]').html('Edit');
                $('#ModalJurusanLabel*').html('Edit Jurusan');
                $('.body_jurusan form*').attr('action', '{{route("admin.department.update",":id")}}'.replace(':id', id));
                $('.body_jurusan form*').attr('method', 'post');

                $.ajax({
                    type: 'POST',
                    url: _url,
                    data: {
                        _token: '{{csrf_token()}}',
                    },
                    success: function (hasil) {
                        $('#jurusan').val(hasil.jurusan)
                    }
                });
            });
        });
    </script>
@endpush
