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
                                <a href="" class="btn mb-2 btn-primary " id="tambahguru" data-toggle="modal" data-target="#GuruModal"><i class="fas fa-plus"></i><span>&nbsp; Tambah Guru</span></a>
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
                                            <th>Username</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($teacher as $showteacher)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$showteacher->name}}</td>
                                                <td>{{$showteacher->username}}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm dropdown-toggle more-vertical" type="button" id="dr1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="text-muted sr-only">Action</span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1">
                                                            <a class="dropdown-item" href="" id="editguru" data-toggle="modal" data-target="#GuruModal" data-id="{{$showteacher->id}}">Edit</a>
                                                            <form action="{{route('admin.teacher.destroy', $showteacher->id)}}" method="post" >
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
                                {{$teacher->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<div class="modal fade" id="GuruModal" tabindex="-1" aria-labelledby="ModalGuruLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalGuruLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="body_guru">
                <form action="" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name">Name Guru</label>
                            <select class="form-control" id="name" name="name">
                                <option value="">-- Pilih --</option>
                                @foreach ($guru as $guru)
                                    <option value="{{$guru->nama}}">{{$guru->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                         <div class="form-group mb-3 username">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group mb-3 password">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <div class="modal-footer footer_guru">
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
            $('#tambahguru').on('click', function () {
                $('.footer_guru button[type=submit]').html('Add');
                $('#ModalGuruLabel').html('Tambah User Guru');
                $('.body_guru form').attr('action', '{{route("admin.teacher.store")}}');
                $('.body_guru form').attr('method', 'post');

                $('.username').hide()
                $('.password').hide()

                $('#name').val('')
                $('#username').val('')
                $('#password').val('')
            });
            $('#editguru*').on('click', function () {
                const id = $(this).data('id');
                let _url = '{{route("admin.teacher.edit",":id")}}'.replace(':id', id);

                $('.footer_guru button[type=submit]').html('Edit');
                $('#ModalGuruLabel').html('Edit User Guru');
                $('.body_guru form').attr('action', '{{route("admin.teacher.update",":id")}}'.replace(':id', id));
                $('.body_guru form').attr('method', 'post');

                $('.username').show()
                $('.password').show()


                $.ajax({
                    type: 'POST',
                    url: _url,
                    data: {
                        _token: '{{csrf_token()}}',
                    },
                    success: function (hasil) {
                        $('#name').val(hasil.teacher.name)
                        $('#username').val(hasil.teacher.username)
                        $('#password').val(hasil.password_encrypted)
                    }
                });
            });
        });
    </script>
@endpush
