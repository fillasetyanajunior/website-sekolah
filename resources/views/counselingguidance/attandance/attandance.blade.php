@extends('layouts.base_dashboard', ['layout' => 'dashboard'])
@section('title', $title)
@section('content')
<div class="page">
    <x-sliderbar-bk></x-sliderbar-bk>
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-fluid">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Input Pelanggaran
                        </div>
                        <h2 class="page-title">
                            {{$title}}
                        </h2>
                    </div>
                    <div class="col-12 col-md-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                data-bs-target="#PelanggaranModal" id="tambahpelanggaran">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                                Tambah Pelanggaran
                            </a>
                            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                data-bs-target="#PelanggaranModal" id="tambahpelanggaran"
                                aria-label="Tambah Pelanggaran">
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
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th class="w-1">No.</th>
                                            <th>Nama</th>
                                            <th>Tanggal</th>
                                            <th>Jenis Pelanggaran</th>
                                            <th>Sekor</th>
                                            <th>Pembinaan</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;?>
                                        @foreach ($offensestudent as $showoffensestudent)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{App/Models/StudentDetail::find($showoffensestudent->id_siswa)->nama}}
                                            </td>
                                            <td>{{$showoffensestudent->tanggal}}</td>
                                            <td>{{App/Models/Offense::find($showoffensestudent->jenis_pelanggaran)->nama}}
                                            </td>
                                            <td>{{$showoffensestudent->sekor}}</td>
                                            <td>{{$showoffensestudent->pembinaan}}</td>
                                            <td>{{$showoffensestudent->keterangan}}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning"
                                                    id="editpelanggaran" data-bs-toggle="modal"
                                                    data-bs-target="#PelanggaranModal"
                                                    data-id="{{Crypt::encrypt($showoffensestudent->id)}}">Ubah</button>
                                                <form
                                                    action="{{route('counseling.offense.destroy', Crypt::encrypt($showoffensestudent->id))}}"
                                                    method="post" class="d-inline">
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
                                {{$offensestudent->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-footer></x-footer>
    </div>
</div>
<div class="modal modal-blur fade" id="PelanggaranModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body_pelanggaran">
                <form action="" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <select class="form-select" name="nama">
                                <option value="">-- Pilih --</option>
                                @foreach ($student as $showstudent)
                                <option value="{{$showstudent->id}}">{{$showstudent->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pelanggaran</label>
                            <select class="form-select" name="pelanggaran">
                                <option value="">-- Pilih --</option>
                                @foreach ($offense as $showoffense)
                                <option value="{{$showoffense->id}}">{{$showoffense->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-lg-12" id="pilihan">
                                <div class="mb-3">
                                    <label for="pilihan" class="form-label">Pilih Pelapor</label>
                                    <select name="pilihan" name="pilihan" id="pilihan" class="form-select">
                                        <option value="">-- Pilih --</option>
                                        <option value="1">Guru</option>
                                        <option value="2">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6" id="pelaporguru">
                                <div class="mb-3">
                                    <label for="pelapor" class="form-label">Pelapor</label>
                                    <select name="pelapor" id="pelapor" class="form-select">
                                        <option value="">-- Pilih --</option>
                                        @foreach ($teacher as $showteacher)
                                        <option value="{{$showteacher->nama}}">{{$showteacher->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6" id="pelaporother">
                                <div class="mb-3">
                                    <label for="pelapor" class="form-label">Pelapor</label>
                                    <input type="text" id="pelapor" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="pembinaan" class="form-label">Pembinaan</label>
                            <select class="form-select" id="pembinaan" name="pembinaan">
                                <option value="">-- Pilih --</option>
                                <option value="1">Lisan</option>
                                <option value="2">Penjanjian 1</option>
                                <option value="3">Penjanjian 2</option>
                                <option value="4">Panggilan Orang Tua</option>
                                <option value="5">Skorsing</option>
                                <option value="6">Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3" id="pembinaanshow">
                            <label for="pembinaan_lainnya" class="form-label">Pembinaan</label>
                            <input type="text" id="pembinaan_lainnya" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" id="keterangan" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Create new report</button>
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
            $('#pelaporguru').hide();
            $('#pelaporother').hide();
            $('#pembinaanshow').hide();

            $('#tambahpelanggaran').click(function () {
                $('.body_pelanggaran button[type=submit]').html('Add');
                $('.modal-title').html('Tambah Pelanggaran');
                $('.body_pelanggaran form').attr('action', '{{route("counseling.offense.store")}}');
                $('.body_pelanggaran form').attr('method', 'post');

                $('#nama').val('')
                $('#pilihan').val('')
                $('#pelanggaran').val('')
                $('#pelapor').val('')
                $('#pembinaan').val('')
                $('#keterangan').val('')
            });

            $('#pilihan').change(function(){
                var id = $(this).val();
                if (id == 1) {
                    $('#pelaporguru').show();
                    $('#pelaporother').hide();
                } else if(id == 2) {
                    $('#pelaporguru').hide();
                    $('#pelaporother').show();
                }else{
                    $('#pelaporguru').hide();
                    $('#pelaporother').hide();
                }
            });

            $('#pembinaan').change(function(){
                var id = $(this).val();
                if (id == 6) {
                    $('#pembinaanshow').show();
                }else{
                    $('#pembinaanshow').hide();
                }
            });

            $('#editpelanggaran*').click(function () {
                const id = $(this).data('id');
                let _url = '{{route("counseling.offense.edit",":id")}}'.replace(':id', id);

                $('.body_pelanggaran button[type=submit]').html('Edit');
                $('.modal-title').html('Edit Prestasi');
                $('.body_pelanggaran form').attr('action', '{{route("counseling.offense.update",":id")}}'.replace(':id', id));
                $('.body_pelanggaran form').attr('method', 'post');

                $.ajax({
                    type: 'POST',
                    url: _url,
                    data: {
                        _token: '{{csrf_token()}}',
                    },
                    success: function (hasil) {
                        $('#nama').val(hasil.id_siswa)
                        $('#pelanggaran').val(hasil.jenis_pelanggaran)

                        var pilihan = null;
                        if (hasil.pilihan == 'Guru') {
                            pilihan = 1;
                        } else {
                            pilihan = 2;
                        }
                        $('#pilihan').val(pilihan)
                        $('#pelapor').val(hasil.pelapor)

                        var pelapor = null;
                        if (hasil.pelapor == 'Lisan') {
                            pelapor = 1;
                        }else if (hasil.pelapor == 'Perjanjian 1') {
                            pelapor = 2;
                        }else if (hasil.pelapor == 'Perjanjian 2') {
                            pelapor = 3;
                        }else if (hasil.pelapor == 'Panggilan Orang Tua') {
                            pelapor = 4;
                        }else if (hasil.pelapor == 'Skorsing') {
                            pelapor = 5;
                        } else {
                            pelapor = 6;
                        }

                        $('#pembinaan').val(pelapor)
                        $('#pembinaanlainnya').val(hasil.pembinaan_lainnya)
                        $('#pembinaan').trigger('change')
                        $('#keterangan').val(keterangan)
                    }
                });
            });
        });
    </script>
@endpush
