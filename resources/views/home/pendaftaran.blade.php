@extends('layouts.base_dashboard',['layout' => 'dashboard'])
@section('title', $title)
@section('content')
<div class="page">
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="page-header d-print-none">
                <h1 class="page-title mb-4">{{$title}}</h1>
                <div class="alert alert-important alert-success alert-dismissible" role="alert">Selamat Datang Kepada
                    Calon Siswa Baru, Isi Data Dengan SEBENAR - BENARNYA</div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-fluid">
                <form action="{{route('regisration.store')}}" method="post">
                    @csrf
                    <div class="row row-deck row-cards">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Diri Anda</h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label" for="nik">NIK</label>
                                        <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" placeholder="NIK" name="nik"
                                            value="{{old('nik')}}">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="nama">Nama Lengkap</label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                                id="nama" placeholder="Full Name" name="nama" value="{{old('nama')}}">
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="nisn">NISN</label>
                                            <input type="text" class="form-control @error('nisn') is-invalid @enderror"
                                                id="nisn" placeholder="NISN" name="nisn" value="{{old('nisn')}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text"
                                                class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                id="tempat_lahir" placeholder="Place Of Birth" name="tempat_lahir"
                                                value="{{old('tempat_lahir')}}">
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date"
                                                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                id="tanggal_lahir" placeholder="Date Of Birth" name="tanggal_lahir"
                                                value="{{old('tanggal_lahir')}}">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                            <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                                id="jenis_kelamin" name="jenis_kelamin">
                                                <option value="">-- Pilih --</option>
                                                <option value="1">Laki-laki</option>
                                                <option value="2">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="agama">Agama</label>
                                            <select class="form-control @error('agama') is-invalid @enderror" id="agama"
                                                name="agama">
                                                <option value="">-- Pilih --</option>
                                                <option value="1">Islam</option>
                                                <option value="2">Hindu</option>
                                                <option value="3">Budha</option>
                                                <option value="4">Kristen</option>
                                                <option value="5">Katolik</option>
                                                <option value="6">Kong Hu Cu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="nomerhp">Nomer Hp Siswa</label>
                                            <input type="text" class="form-control @error('nomer_hp') is-invalid @enderror"
                                                id="nomerhp" placeholder="Phone Number" name="nomer_hp"
                                                value="{{old('nomer_hp')}}">
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="email">E-mail</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" placeholder="E-mail" name="email" value="{{old('email')}}">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="nik_ibu">NIK Ibu</label>
                                            <input type="text" class="form-control @error('nik_ibu') is-invalid @enderror"
                                                id="nik_ibu" placeholder="Mother's Name" name="nik_ibu"
                                                value="{{old('nik_ibu')}}">
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="nik_bapak">NIK Bapak</label>
                                            <input type="text"
                                                class="form-control @error('nik_bapak') is-invalid @enderror"
                                                id="nik_bapak" placeholder="Father's Name" name="nik_bapak"
                                                value="{{old('nik_bapak')}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="nama_ibu">Nama Ibu</label>
                                            <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror"
                                                id="nama_ibu" placeholder="Mother's Name" name="nama_ibu"
                                                value="{{old('nama_ibu')}}">
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="nama_bapak">Nama Bapak</label>
                                            <input type="text"
                                                class="form-control @error('nama_bapak') is-invalid @enderror"
                                                id="nama_bapak" placeholder="Father's Name" name="nama_bapak"
                                                value="{{old('nama_bapak')}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="pendidikan_ibu">Pendidikan Ibu</label>
                                            <select class="form-control @error('pendidikan_ibu') is-invalid @enderror"
                                                id="pendidikan_ibu" name="pendidikan_ibu">
                                                <option value="">-- Pilih --</option>
                                                <option value="1">SD/MI</option>
                                                <option value="2">SMP/MTs</option>
                                                <option value="3">SMA/SMU/MA</option>
                                                <option value="4">D1/D2/D3/D4</option>
                                                <option value="5">S1/S2/S3</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="pendidikan_bapak">Pendidikan Bapak</label>
                                            <select class="form-control @error('pendidikan_bapak') is-invalid @enderror"
                                                id="pendidikan_bapak" name="pendidikan_bapak">
                                                <option value="">-- Pilih --</option>
                                                <option value="1">SD/MI</option>
                                                <option value="2">SMP/MTs</option>
                                                <option value="3">SMA/SMU/MA</option>
                                                <option value="4">D1/D2/D3/D4</option>
                                                <option value="5">S1/S2/S3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="pekerjaan_ibu">Pekerjaan Ibu</label>
                                            <select class="form-control @error('pekerjaan_ibu') is-invalid @enderror"
                                                id="pekerjaan_ibu" name="pekerjaan_ibu">
                                                <option value="">-- Pilih --</option>
                                                @foreach ($employment as $showemployment)
                                                    <option value="{{$showemployment->nama}}">{{$showemployment->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="pekerjaan_bapak">Pekerjaan Bapak</label>
                                            <select class="form-control @error('pekerjaan_bapak') is-invalid @enderror"
                                                id="pekerjaan_bapak" name="pekerjaan_bapak">
                                                <option value="">-- Pilih --</option>
                                                @foreach ($employment as $showemployment)
                                                    <option value="{{$showemployment->nama}}">{{$showemployment->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="penghasilan_ibu">Penghasilan Ibu</label>
                                            <select class="form-control @error('penghasilan_ibu') is-invalid @enderror"
                                                id="penghasilan_ibu" name="penghasilan_ibu">
                                                <option value="">-- Pilih --</option>
                                                <option value="1">500.000 < </option> <option value="2">500.000 > 1.000.000</option>
                                                <option value="2">1.000.000 > 5.000.000</option>
                                                <option value="2">5.000.000 > 10.000.000</option>
                                                <option value="2">10.000.000 ></option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="penghasilan_bapak">Penghasilan Bapak</label>
                                            <select class="form-control @error('penghasilan_bapak') is-invalid @enderror"
                                                id="penghasilan_bapak" name="penghasilan_bapak">
                                                <option value="">-- Pilih --</option>
                                                <option value="1">500.000 < </option> <option value="2">500.000 > 1.000.000</option>
                                                <option value="2">1.000.000 > 5.000.000</option>
                                                <option value="2">5.000.000 > 10.000.000</option>
                                                <option value="2">10.000.000 ></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="nomer_hp_wali">Nomer Hp Orang Tua</label>
                                        <input type="text" class="form-control" name="nomer_hp_wali" id="nomer_hp_wali">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Alamat</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="provinsi">Provinsi</label>
                                            <select class="form-control @error('provinsi') is-invalid @enderror"
                                                id="provinsi" name="provinsi">
                                                <option value="">-- Pilih --</option>
                                                @foreach ($province as $showprovince)
                                                    <option value="{{$showprovince->id}}">{{$showprovince->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="kabupaten">Kabupaten</label>
                                            <select class="form-control @error('kabupaten') is-invalid @enderror"
                                                id="kabupaten" name="kabupaten">
                                                <option value="">-- Pilih --</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="kecamatan">Kecamatan</label>
                                            <select class="form-control @error('kecamatan') is-invalid @enderror"
                                                id="kecamatan" name="kecamatan">
                                                <option value="">-- Pilih --</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="desa">Desa</label>
                                            <select class="form-control @error('desa') is-invalid @enderror"
                                                id="desa" name="desa">
                                                <option value="">-- Pilih --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="dusun">Dusun</label>
                                            <input type="text" class="form-control @error('dusun') is-invalid @enderror"
                                                id="dusun" placeholder="DUSUN" name="dusun" value="{{old('dusun')}}">
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="rw">RW</label>
                                            <input type="text" class="form-control @error('rw') is-invalid @enderror"
                                                id="rw" placeholder="RW" name="rw" value="{{old('rw')}}">
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="rt">RT</label>
                                            <input type="text" class="form-control @error('rt') is-invalid @enderror"
                                                id="rt" placeholder="RT" name="rt" value="{{old('rt')}}">
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label" for="alamat">Nama Jalan/Gang</label>
                                            <input type="text"
                                                class="form-control @error('nama_jalan') is-invalid @enderror" id="alamat"
                                                placeholder="Street Name/Alley" name="nama_jalan"
                                                value="{{old('nama_jalan')}}">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"> Kode Pos</label>
                                        <input type="text" class="form-control @error('kode_pos') is-invalid @enderror"
                                            placeholder="Kode Pos" name="kode_pos" value="{{old('kode_pos')}}">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Pendidikan</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label" for="pendidikan">Pendidikan Terakhir</label>
                                        <select class="form-control @error('pendidikan') is-invalid @enderror"
                                            id="pendidikan" name="pendidikan">
                                            <option value="">-- Pilih --</option>
                                            <option value="1">SMP</option>
                                            <option value="2">MTs</option>
                                        </select>
                                    </div>
                                    <div class="form-group mt-4">
                                        <label class="form-label" for="nama_sekolah">Nama Sekolah</label>
                                        <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror"
                                            id="nama_sekolah" placeholder="School Name" name="nama_sekolah"
                                            value="{{old('nama_sekolah')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Pilihan Jurusan MAN BULELENG</h3>
                                </div>
                                <div class="card-body">
                                    {{-- <div class="row">
                                        <div class="col-lg-6">
                                            <label class="form-label" for="pilihan_1">Pilihan 1</label>
                                            <select class="form-control @error('pilihan_1') is-invalid @enderror"
                                                id="pilihan_1" name="pilihan_1">
                                                <option value="">--Pilih Utama--</option>
                                                @foreach ($department_first as $department_first)
                                                    <option value="{{$department_first->kode}}">{{$department_first->jurusan}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label" for="pilihan_2">Pilihan 2</label>
                                            <select class="form-control @error('pilihan_2') is-invalid @enderror"
                                                id="pilihan_2" name="pilihan_2">
                                                <option value="">-- Pilih --</option>
                                                @foreach ($department_second as $department_second)
                                                    <option value="{{$department_second->kode}}">{{$department_second->jurusan}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="form-group mt-4">
                                        <label class="form-label" for="info">Info Pendaftaran MAN BULELENG</label>
                                        <select class="form-control @error('info') is-invalid @enderror" id="info"
                                            name="info">
                                            <option value="">-- Pilih --</option>
                                            <option value="1">Brosur</option>
                                            <option value="2">Teman</option>
                                            <option value="3">Saudara</option>
                                            <option value="4">Internet</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mt-3">
                        <div class="ms-auto">
                            <a href="{{route('home')}}" class="btn btn-warning">Back</a>
                            <button class="btn btn-primary">Daftar</button>
                        </div>
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
            // ambil data kabupaten ketika data memilih provinsi
            $('#provinsi').change( function () {
                var id      = $(this).val();
                let _url    = '{{route("api.kabupaten.get",":id")}}'.replace(':id',id);
                $.ajax({
                    type: 'POST',
                    url : _url,
                    data: {
                        id: id,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (hasil) {
                        $("#kabupaten").removeAttr('disabled')
                        $("#kabupaten").empty()
                        $("#kabupaten").show();
                        $("#kabupaten").append('<option value="">-- Pilih --</option>');
                        $.each(hasil,function (index,kebupaten){
                            $("#kabupaten").append('<option value="' + kebupaten.id + '"' +  '>' + kebupaten.name + '</option>');
                        })
                    }
                });
            });
            $('#kabupaten').change( function () {
                var id      = $(this).val();
                let _url    = '{{route("api.kecamatan.get",":id")}}'.replace(':id',id);
                $.ajax({
                    type: 'POST',
                    url : _url,
                    data: {
                        id: id,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (hasil) {
                        $("#kecamatan").removeAttr('disabled')
                        $("#kecamatan").empty()
                        $("#kecamatan").show();
                        $("#kecamatan").append('<option value="">-- Pilih --</option>');
                        $.each(hasil,function (index,kecamatan){
                            $("#kecamatan").append('<option value="' + kecamatan.id + '"' +  '>' + kecamatan.name + '</option>');
                        })
                    }
                });
            });
            $('#kecamatan').change( function () {
                var id      = $(this).val();
                let _url    = '{{route("api.desa.get",":id")}}'.replace(':id',id);
                $.ajax({
                    type: 'POST',
                    url : _url,
                    data: {
                        id: id,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (hasil) {
                        $("#desa").removeAttr('disabled')
                        $("#desa").empty()
                        $("#desa").show();
                        $("#desa").append('<option value="">-- Pilih --</option>');
                        $.each(hasil,function (index,desa){
                            $("#desa").append('<option value="' + desa.id + '"' +  '>' + desa.name + '</option>');
                        })
                    }
                });
            });

        });
    </script>
@endpush
