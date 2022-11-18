@extends('layouts.base_dashboard',['layout' => 'dashboard'])
@section('title', $title)
@section('content')
<div class="page">
    <x-sliderbar-student></x-sliderbar-student>
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
                    <form action="{{route('student.profile.update', Crypt::encrypt($student->id))}}" method="POST" class="row row-deck row-cards">
                        @csrf
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Biodata</h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label" for="nama">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama" value="{{$student->nama}}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="nisn">NISN</label>
                                        <input type="text" class="form-control" id="nisn" name="nisn" value="{{$student->nisn}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="tempat_lahir">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{$student->tempat_lahir}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{$student->tanggal_lahir}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                        <input type="text" class="form-control" id="jenis_kelamin" value="{{$student->jenis_kelamin}}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="agama">Agama</label>
                                        <input type="text" class="form-control" id="agama" value="{{$student->agama}}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="nomerhp">Nomer Hp</label>
                                        <input type="text" class="form-control" id="nomerhp" value="{{$student->nomer_hp}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="email">E-mail</label>
                                        <input type="email" class="form-control" id="email" value="{{$student->email}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Biodata Orang Tua</h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label" for="nama_bapak">Nama Bapak</label>
                                        <input type="text" class="form-control" id="nama_bapak" name="nama_bapak" value="{{$student->nama_bapak}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="pendidikan_bapak">Pendidikan Bapak</label>
                                        <select class="form-control" id="pendidikan_bapak" name="pendidikan_bapak">
                                            <option value="">-- Pilih --</option>
                                            <option value="1" {{$student->pendidikan_bapak == 1 ? 'selected' : ''}}>SD/MI</option>
                                            <option value="2" {{$student->pendidikan_bapak == 2 ? 'selected' : ''}}>SMP/MTs</option>
                                            <option value="3" {{$student->pendidikan_bapak == 3 ? 'selected' : ''}}>SMA/SMU/MA</option>
                                            <option value="4" {{$student->pendidikan_bapak == 4 ? 'selected' : ''}}>D1/D2/D3/D4</option>
                                            <option value="5" {{$student->pendidikan_bapak == 5 ? 'selected' : ''}}>S1/S2/S3</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="pekerjaan_bapak">Pekerjaan Bapak</label>
                                        <select class="form-control" id="pekerjaan_bapak" name="pekerjaan_bapak">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($job as $showjob)
                                                <option value="{{$showjob->id}}" {{$student->pekerjaan_bapak == $showjob->id ? 'selected' : ''}}>{{$showjob->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="penghasilan_bapak">Penghasilan Bapak</label>
                                        <select class="form-control" id="penghasilan_bapak" name="penghasilan_bapak">
                                            <option value="">-- Pilih --</option>
                                            <option value="1" {{$student->penghasilan_bapak == 1 ? 'selected' : ''}}>500.000 < </option>
                                            <option value="2" {{$student->penghasilan_bapak == 2 ? 'selected' : ''}}>500.000 > 1.000.000</option>
                                            <option value="3" {{$student->penghasilan_bapak == 3 ? 'selected' : ''}}>1.000.000 > 5.000.000</option>
                                            <option value="4" {{$student->penghasilan_bapak == 4 ? 'selected' : ''}}>5.000.000 > 10.000.000</option>
                                            <option value="5" {{$student->penghasilan_bapak == 5 ? 'selected' : ''}}>10.000.000 ></option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="nama_ibu">Nama Ibu</label>
                                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="{{$student->nama_ibu}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="pendidikan_ibu">Pendidikan Ibu</label>
                                        <select class="form-control" id="pendidikan_ibu" name="pendidikan_ibu">
                                            <option value="">-- Pilih --</option>
                                            <option value="1" {{$student->pendidikan_ibu == 1 ? 'selected' : ''}}>SD/MI</option>
                                            <option value="2" {{$student->pendidikan_ibu == 2 ? 'selected' : ''}}>SMP/MTs</option>
                                            <option value="3" {{$student->pendidikan_ibu == 3 ? 'selected' : ''}}>SMA/SMU/MA</option>
                                            <option value="4" {{$student->pendidikan_ibu == 4 ? 'selected' : ''}}>D1/D2/D3/D4</option>
                                            <option value="5" {{$student->pendidikan_ibu == 5 ? 'selected' : ''}}>S1/S2/S3</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="pekerjaan_ibu">Pekerjaan Ibu</label>
                                        <select class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($job as $showjob)
                                                <option value="{{$showjob->id}}" {{$student->pekerjaan_ibu == $showjob->id ? 'selected' : ''}}>{{$showjob->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="penghasilan_ibu">Penghasilan Ibu</label>
                                        <select class="form-control" id="penghasilan_ibu" name="penghasilan_ibu">
                                            <option value="">-- Pilih --</option>
                                            <option value="1" {{$student->penghasilan_ibu == 1 ? 'selected' : ''}}>500.000 < </option>
                                            <option value="2" {{$student->penghasilan_ibu == 2 ? 'selected' : ''}}>500.000 > 1.000.000</option>
                                            <option value="3" {{$student->penghasilan_ibu == 3 ? 'selected' : ''}}>1.000.000 > 5.000.000</option>
                                            <option value="4" {{$student->penghasilan_ibu == 4 ? 'selected' : ''}}>5.000.000 > 10.000.000</option>
                                            <option value="5" {{$student->penghasilan_ibu == 5 ? 'selected' : ''}}>10.000.000 ></option>
                                        </select>
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
                                        <div class="mb-3">
                                            <label class="form-label" for="provinsi">Provinsi</label>
                                            <select class="form-control" id="provinsi" name="provinsi">
                                                <option value="">-- Pilih --</option>
                                                @foreach ($province as $showprovince)
                                                    <option value="{{$showprovince->id}}" {{$student->provinsi_id == $showprovince->id ? 'selected' : ''}}>{{$showprovince->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="kabupaten">Kabupaten</label>
                                            <select class="form-control" id="kabupaten" name="kabupaten">
                                                <option value="">-- Pilih --</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="kecamatan">Kecamatan</label>
                                            <select class="form-control" id="kecamatan" name="kecamatan">
                                                <option value="">-- Pilih --</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="desa">Desa</label>
                                            <select class="form-control" id="desa" name="desa">
                                                <option value="">-- Pilih --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3">
                                            <label class="form-label" for="dusun">Dusun</label>
                                            <input type="text" class="form-control" id="dusun" name="dusun" value="{{$student->dusun}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="rw">RW</label>
                                            <input type="text" class="form-control" id="rw" name="rw" value="{{$student->rw}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="rt">RT</label>
                                            <input type="text" class="form-control" id="rt" name="rt" value="{{$student->rt}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="alamat">Alamat</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{$student->alamat}}">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"> Kode Pos</label>
                                        <input type="text" class="form-control" name="kode_pos" value="{{$student->kode_pos}}">
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
                                        <select class="form-control" id="pendidikan" name="pendidikan">
                                            <option value="">-- Pilih --</option>
                                            <option value="1" {{$student->pendidikan == 1 ? 'selected' : ''}}>SMP</option>
                                            <option value="2" {{$student->pendidikan == 2 ? 'selected' : ''}}>MTs</option>
                                        </select>
                                    </div>
                                    <div class="form-group mt-4">
                                        <label class="form-label" for="nama_sekolah">Nama Sekolah</label>
                                        <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" value="{{$student->nama_sekolah}}">
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
            <x-footer></x-footer>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#provinsi').change(function () {
                var id = $(this).val();
                let _url = '{{route("api.kabupaten.get",":id")}}'.replace(':id', id);
                $.ajax({
                    type: 'POST',
                    url: _url,
                    data: {
                        _token: '{{csrf_token()}}'
                    },
                    success: function (hasil) {
                        $('#kabupaten').empty()
                        $('#kabupaten').append('<option value="">-- Pilih --</option>');
                        $.each(hasil, function (index, kebupaten) {
                            $('#kabupaten').append('<option value="' + kebupaten.id +
                                '"' + '>' + kebupaten.name + '</option>');
                        });
                        $('#kabupaten').val({{$student->kabupaten_id}});
                        $('#kabupaten').trigger("change");
                    }
                });
            });
            $('#kabupaten').change(function () {
                var id = $(this).val();
                let _url = '{{route("api.kecamatan.get",":id")}}'.replace(':id', id);
                $.ajax({
                    type: 'POST',
                    url: _url,
                    data: {
                        _token: '{{csrf_token()}}'
                    },
                    success: function (hasil) {
                        $('#kecamatan').empty()
                        $('#kecamatan').append('<option value="">-- Pilih --</option>');
                        $.each(hasil, function (index, kecamatan) {
                            $('#kecamatan').append('<option value="' + kecamatan.id +
                                '"' + '>' + kecamatan.name + '</option>');
                        });
                        $('#kecamatan').val({{ $student->kecamatan_id}});
                        $('#kecamatan').trigger("change");
                    }
                });
            });
            $('#kecamatan').change(function () {
                var id = $(this).val();
                let _url = '{{route("api.desa.get",":id")}}'.replace(':id', id);
                $.ajax({
                    type: 'POST',
                    url: _url,
                    data: {
                        _token: '{{csrf_token()}}'
                    },
                    success: function (hasil) {
                        $('#desa').empty()
                        $('#desa').append('<option value="">-- Pilih --</option>');
                        $.each(hasil, function (index, desa) {
                            $("#desa").append('<option value="' + desa.id + '"' + '>' +
                                desa.name + '</option>');
                        });
                        $('#desa').val({{$student->desa_id}});
                        $('#desa').trigger("change");
                    }
                });
            });
            $('#provinsi').trigger('change');
        });

    </script>
@endpush
