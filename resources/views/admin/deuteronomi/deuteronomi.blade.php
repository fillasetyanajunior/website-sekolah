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
                                    data-bs-target="#UlanganModal" id="tambahulangan">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    Tambah Jadwal Ulangan
                                </a>
                                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#UlanganModal" id="tambahulangan" aria-label="Tambah Jadwal Ulangan">
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
                                                <th>Tanggal</th>
                                                <th>Jam</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Tahun</th>
                                                <th>Kelas</th>
                                                <th>Jurusan</th>
                                                <th>Bagian Kelas</th>
                                                <th>Ruangan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($deuteronomi as $showdeuteronomi)
                                                @php
                                                    $detail = App\Models\Deuteronomi::where('kelas', $showdeuteronomi->kelas)->first();
                                                @endphp
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$detail->tanggal}}</td>
                                                    <td>{{$detail->jam}}</td>
                                                    <td>{{App\Models\Subject::find($detail->matapelajaran)->matapelajaran}}</td>
                                                    <td>{{App\Models\Year::find($detail->tahun)->tahun . ' - ' . App\Models\Year::find($detail->tahun)->semester}}</td>
                                                    <td>{{$detail->kelas}}</td>
                                                    <td>{{$detail->jurusan != null ? App\Models\Department::find($detail->jurusan)->jurusan : ''}}</td>
                                                    <td>{{$detail->no_kelas}}</td>
                                                    <td>Ruangan {{$detail->ruangan}}</td>
                                                    <td width="100px">
                                                        <button type="button" class="btn btn-sm btn-warning" href="" id="editulangan" data-bs-toggle="modal" data-bs-target="#UlanganModal" data-id="{{Crypt::encrypt($detail->id)}}">Ubah</button>
                                                        <form action="{{route('admin.deuteronomi.destroy', Crypt::encrypt($detail->id))}}" method="post" class="d-inline" >
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
                                    {{$deuteronomi->links()}}
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
<div class="modal modal-blur fade" id="UlanganModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Large modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body_ulangan">
                <form action="" method="POST" class="needs-validation" novalidate>
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="tanggal">Tanggal</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="jam">Jam Ulangan</label>
                            <input type="text" class="form-control @error('jam') is-invalid @enderror" id="jam" name="jam" placeholder="08:00 - 09:00">
                        </div>
                        <div class="mb-3 kursi">
                            <label class="form-label" for="kursi">Jumlah Kursi</label>
                            <input type="text" class="form-control @error('kursi') is-invalid @enderror" id="kursi" name="kursi" placeholder="40">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="ruangan">Ruangan</label>
                            <select class="form-control @error('ruangan') is-invalid @enderror" id="ruangan" name="ruangan">
                                <option value="">-- Pilih --</option>
                                @for ($i = 1; $i <= 18; $i++)
                                    <option value="{{$i}}">Ruangan {{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="tahun">Tahun Pelajaran</label>
                            <select class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun">
                                <option value="">-- Pilih --</option>
                                @foreach ($year as $year)
                                    <option value="{{$year->tahun . '/' . $year->semester}}">{{$year->tahun . ' - ' . $year->semester}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="update">
                            <div class="mb-3">
                                <label class="form-label" for="kelas">Kelas</label>
                                <select class="form-control @error('kelas') is-invalid @enderror" id="kelas" name="kelas">
                                    <option value="">-- Pilih --</option>
                                    <option value="1">10</option>
                                    <option value="2">11</option>
                                    <option value="3">12</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="matapelajaran">Mata Pelajaran</label>
                                <select class="form-control @error('matapelajaran') is-invalid @enderror" id="matapelajaran" name="matapelajaran">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($subject as $showsubject)
                                        <option value="{{$showsubject->matapelajaran}}">{{$showsubject->matapelajaran}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="jurusan">Jurusan</label>
                                <select class="form-select @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($department as $showdepartment)
                                        <option value="{{$showdepartment->jurusan}}">{{$showdepartment->jurusan}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="no_kelas">Bagian Kelas</label>
                                <select class="form-select @error('no_kelas') is-invalid @enderror" id="no_kelas" name="no_kelas">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($class as $showclass)
                                        @if ($showclass->no_kelas != null)
                                            <option value="{{$showclass->no_kelas}}">{{$showclass->no_kelas}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="create">
                            <div class="row">
                                <div class="col-lg-4 col-lg-6" id="kelas_pertama_div">
                                    <div class="mb-3">
                                        <label class="form-label" for="kelas_pertama">Kelas Pertama</label>
                                        <select class="form-control @error('kelas_pertama') is-invalid @enderror" id="kelas_pertama" name="kelas_pertama">
                                            <option value="">-- Pilih --</option>
                                            <option value="1">10</option>
                                            <option value="2">11</option>
                                            <option value="3">12</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-lg-6" id="matapelajaran_pertama_div">
                                    <div class="mb-3">
                                        <label class="form-label" for="matapelajaran_pertama">Mata Pelajaran</label>
                                        <select class="form-control @error('matapelajaran_pertama') is-invalid @enderror" id="matapelajaran_pertama" name="matapelajaran_pertama">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($subject as $showsubject)
                                                <option value="{{$showsubject->matapelajaran}}">{{$showsubject->matapelajaran}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 jurusan_pertama">
                                    <div class="mb-3">
                                        <label class="form-label" for="jurusan_pertama">Jurusan</label>
                                        <select class="form-select @error('jurusan_pertama') is-invalid @enderror" id="jurusan_pertama" name="jurusan_pertama">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($department as $showdepartment)
                                                <option value="{{$showdepartment->jurusan}}">{{$showdepartment->jurusan}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 bagian_kelas_pertama">
                                    <div class="mb-3">
                                        <label class="form-label" for="no_kelas_pertama">Bagian Kelas</label>
                                        <select class="form-select @error('no_kelas_pertama') is-invalid @enderror" id="no_kelas_pertama" name="no_kelas_pertama">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($class as $showclass)
                                                @if ($showclass->no_kelas != null)
                                                    <option value="{{$showclass->no_kelas}}">{{$showclass->no_kelas}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-lg-6" id="kelas_kedua_div">
                                    <div class="mb-3">
                                        <label class="form-label" for="kelas_kedua">Kelas Kedua</label>
                                        <select class="form-control @error('kelas_kedua') is-invalid @enderror" id="kelas_kedua" name="kelas_kedua">
                                            <option value="">-- Pilih --</option>
                                            <option value="1">10</option>
                                            <option value="2">11</option>
                                            <option value="3">12</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-lg-6" id="matapelajaran_kedua_div">
                                    <div class="mb-3">
                                        <label class="form-label" for="matapelajaran_kedua">Mata Pelajaran</label>
                                        <select class="form-control @error('matapelajaran_kedua') is-invalid @enderror" id="matapelajaran_kedua" name="matapelajaran_kedua">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($subject as $showsubject)
                                                <option value="{{$showsubject->id}}">{{$showsubject->matapelajaran}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 jurusan_kedua">
                                    <div class="mb-3">
                                        <label class="form-label" for="jurusan_kedua">Jurusan</label>
                                        <select class="form-select @error('jurusan_kedua') is-invalid @enderror" id="jurusan_kedua" name="jurusan_kedua">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($department as $showdepartment)
                                                <option value="{{$showdepartment->id}}">{{$showdepartment->jurusan}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 bagian_kelas_kedua">
                                    <div class="mb-3">
                                        <label class="form-label" for="no_kelas_kedua">Bagian Kelas</label>
                                        <select class="form-select @error('no_kelas_kedua') is-invalid @enderror" id="no_kelas_kedua" name="no_kelas_kedua">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($class as $showclass)
                                                @if ($showclass->no_kelas != null)
                                                    <option value="{{$showclass->no_kelas}}">{{$showclass->no_kelas}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
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
            $('.jurusan_pertama').hide()
            $('.bagian_kelas_pertama').hide()

            $('.jurusan_kedua').hide()
            $('.bagian_kelas_kedua').hide()

            $('#update').hide();
            $('#create').hide();

            $('#tambahulangan').click(function () {
                $('.body_ulangan button[type=submit]').html('Add');
                $('.modal-title').html('Tambah Jadwal Ulangan');
                $('.body_ulangan form').attr('action', '{{route("admin.deuteronomi.store")}}');
                $('.body_ulangan form').attr('method', 'post');

                $("#tanggal").val('');
                $("#jam").val('');
                $("#tahun").val('');
                $("#jurusan").val('');
                $("#kursi").val('');
                $("#ruangan").val('');
                $("#kelas_pertama").val('');
                $("#jurusan_pertama").val('');
                $("#matapelajaran_pertama").val('');
                $("#no091_kelas_pertama").val('');
                $("#kelas_kedua").val('');
                $("#jurusan_kedua").val('');
                $("#matapelajaran_kedua").val('');
                $("#no091_kelas_kedua").val('');

                $('.kursi').show()
                $('#create').show();
                $('#update').hide();
            });

            $('#kelas_pertama').change(function (){
                let id = $(this).val();
                if (id != '') {
                    $('#matapelajaran_pertama_div').removeClass("col-lg-6")
                    $('#kelas_pertama_div').removeClass("col-lg-6")
                }else{
                    $('#matapelajaran_pertama_div').addClass("col-lg-6")
                    $('#kelas_pertama_div').addClass("col-lg-6")
                }

                if (id == 1) {
                    $('.jurusan_pertama').hide();
                    $('.bagian_kelas_pertama').show();
                }else if(id == 2 || id == 3){
                    $('.jurusan_pertama').show();
                    $('.bagian_kelas_pertama').hide();
                }else{
                    $('.jurusan_pertama').hide();
                    $('.bagian_kelas_pertama').hide();
                }
            });

            $('#kelas_kedua').change(function (){
                let id = $(this).val();
                if (id != '') {
                    $('#matapelajaran_kedua_div').removeClass("col-lg-6")
                    $('#kelas_kedua_div').removeClass("col-lg-6")
                }else{
                    $('#matapelajaran_kedua_div').addClass("col-lg-6")
                    $('#kelas_kedua_div').addClass("col-lg-6")
                }

                if (id == 1) {
                    $('.jurusan_kedua').hide();
                    $('.bagian_kelas_kedua').show();
                }else if(id == 2 || id == 3){
                    $('.jurusan_kedua').show();
                    $('.bagian_kelas_kedua').hide();
                }else{
                    $('.jurusan_kedua').hide();
                    $('.bagian_kelas_kedua').hide();
                }
            });

            $('#editulangan*').click(function () {
                $('#update').show();
                $('#create').hide();

                const id = $(this).data('id');
                let _url = '{{route("admin.deuteronomi.edit",":id")}}'.replace(':id', id);

                $('.body_ulangan button[type=submit]').html('Edit');
                $('.modal-title').html('Edit Jadwal Ulangan');
                $('.body_ulangan form').attr('action', '{{route("admin.deuteronomi.update",":id")}}'.replace(':id', id));
                $('.body_ulangan form').attr('method', 'post');

                $.ajax({
                    type: 'POST',
                    url: _url,
                    data: {
                        _token: '{{csrf_token()}}',
                    },
                    success: function (hasil) {
                        $('#tanggal').val(hasil.tanggal)
                        $('#jam').val(hasil.jam)
                        $('#matapelajaran').val(hasil.matapelajaran)
                        $('#tahun').val(hasil.tahun)
                        $('#jurusan').val(hasil.jurusan)
                        $('.kursi').hide()
                        $('#ruangan').val(hasil.ruangan)

                        var kelas = 0;

                        if (hasil.kelas == 'X') {
                            kelas = 1;
                        }else if(hasil.kelas == 'XI'){
                            kelas = 2;
                        } else {
                            kelas = 3;
                        }
                        $("#kelas").val(kelas);
                        $("#no_kelas").val(hasil.no_kelas);
                    }
                });
            });
        });
    </script>
@endpush
