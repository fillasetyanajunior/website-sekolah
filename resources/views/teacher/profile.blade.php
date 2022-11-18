@extends('layouts.base_dashboard',['layout' => 'dashboard'])
@section('title', $title)
@section('content')
<div class="page">
    <x-sliderbar-teacher></x-sliderbar-teacher>
    <div class="page-wrapper">
        <div class="page-wrapper">
            <div class="container-fluid">
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
                <div class="container-fluid">
                    <div class="row row-deck row-cards">
                        <form action="" method="post">
                            @csrf
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>{{$title}}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Nama</label>
                                            <input type="text" name="nama" class="form-control" value="{{$teacher->nama}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">NUPTK/NPK</label>
                                            <input type="text" name="nuptk" class="form-control" value="{{$teacher->nuptk}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Alamat</label>
                                            <input type="text" name="alamat" class="form-control" value="{{$teacher->alamat}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Nomer Hp</label>
                                            <input type="text" name="nomer" class="form-control" value="{{$teacher->nomer}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="text" name="email" class="form-control" value="{{$teacher->email}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Jenjang Pendidikan</label>
                                            <input type="text" name="lulusan" class="form-control" value="{{$teacher->lulusan}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Wali Kelas</label>
                                            <input type="text" class="form-control" value="{{$teacher->wali_kelas}}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Wali Jurusan</label>
                                            <input type="text" class="form-control" value="{{$teacher->wali_jurusan != null ? App\Models\Department::find($teacher->wali_jurusan)->jurusan : ''}}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Status Guru</label>
                                            <input type="text" class="form-control" value="{{$teacher->status}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <button type="submit" class="btn btn-primary ms-auto">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <x-footer></x-footer>
        </div>
    </div>
</div>
@endsection
