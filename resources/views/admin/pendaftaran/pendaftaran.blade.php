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
                                <input type="text" class="form-control" id="search" placeholder="Search">
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
                                        @foreach ($registration as $showpendaftaran)
                                            @php
                                                $detail = App\Models\RegistrationDetail::find($showpendaftaran->id_siswa);
                                            @endphp
                                            <tr>
                                                <th>{{$i++}}</th>
                                                <td>{{$detail->nama}}</td>
                                                <td>{{$detail->nisn}}</td>
                                                <td>{{$showpendaftaran->kode}}</td>
                                                <td>
                                                    @if ($showpendaftaran->is_active == 1)
                                                        Belum Test
                                                    @elseif ($showpendaftaran->is_active == 2)
                                                        Sedang Test
                                                    @else
                                                        Lulus
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm dropdown-toggle more-vertical" type="button" id="dr1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="text-muted sr-only">Action</span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1">
                                                            <a class="dropdown-item" href="" id="editpendaftaran" data-toggle="modal" data-target="#PendaftaranModal" data-id="{{$showpendaftaran->id}}">Edit</a>
                                                            <form action="/pendaftaran/{{$showpendaftarans->id}}" method="post" >
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
                                {{$registration->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<div class="modal fade" id="PendaftaranModal" tabindex="-1" aria-labelledby="ModalPendaftaranLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalPendaftaranLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
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
                                @foreach ($jurusan as $jurusan)
                                    <option value="{{$jurusan->kode}}">{{$jurusan->jurusan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="active">Status</label>
                            <select class="form-control" id="active" name="active">
                                <option value="">-- Pilih --</option>
                                <option value="1">Belum Test</option>
                                <option value="2">Sedang Test</option>
                                <option value="3">Lulus</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer footer_pendaftaran">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
