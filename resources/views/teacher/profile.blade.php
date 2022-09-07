@extends('layouts.base_dashboard',['layout' => 'dashboard'])
@section('title', $title)
@section('content')
<div class="page">
    <x-sliderbar-teacher></x-sliderbar-teacher>
    <div class="page-wrapper">
        <div class="page-wrapper">
            <div class="container-xl">
                <div class="page-header d-print-none">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <div class="page-pretitle">
                                Profile
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
                                    <h4>{{$title}}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control" value="{{$teacher->nama}}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">NUPTK</label>
                                        <input type="text" class="form-control" value="{{$teacher->nuptk}}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Alamat</label>
                                        <input type="text" class="form-control" value="{{$teacher->alamat}}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nomer Hp</label>
                                        <input type="text" class="form-control" value="{{$teacher->nomer}}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" value="{{$teacher->email}}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jenjang Pendidikan</label>
                                        <input type="text" class="form-control" value="{{$teacher->lulusan}}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Wali Kelas</label>
                                        <input type="text" class="form-control" value="{{$teacher->wali_kelas}}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Wali Jurusan</label>
                                        <input type="text" class="form-control" value="{{$teacher->wali_jurusan}}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Status Guru</label>
                                        <input type="text" class="form-control" value="{{$teacher->status}}" readonly>
                                    </div>
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
@endsection
