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
                                    data-bs-target="#JadwalModal" id="tambahjadwal">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    Tambah Jadwal
                                </a>
                                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#JadwalModal" id="tambahjadwal" aria-label="Tambah Jadwal">
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
            @livewire('schedule-livewire', ['title' => $title])
            <x-footer></x-footer>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="JadwalModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Large modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body_jadwal">
                <form action="" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="hari">Hari</label>
                            <select class="form-select @error('hari') is-invalid @enderror" id="hari" name="hari">
                                <option value="">-- Pilih --</option>
                                <option value="1">Senin</option>
                                <option value="2">Selasa</option>
                                <option value="3">Rabu</option>
                                <option value="4">Kamis</option>
                                <option value="5">Jum'at</option>
                                <option value="6">Sabtu</option>
                            </select>
                        </div>
                        <div class="update">
                            <div class="mb-3">
                                <label class="form-label" for="jam">Jam Pelajaran</label>
                                <select class="form-select @error('jam') is-invalid @enderror" id="jam" name="jam_edit">
                                    <option value="">-- Pilih --</option>
                                    <option value="1">1 Jam Pelajaran</option>
                                    <option value="2">2 Jam Pelajaran</option>
                                    <option value="3">3 Jam Pelajaran</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="matapelajaran">Mata Pelajaran</label>
                                <select class="form-select @error('matapelajaran') is-invalid @enderror" id="matapelajaran" name="matapelajaran_edit">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($subject as $showsubject)
                                        <option value="{{$showsubject->matapelajaran}}">{{$showsubject->matapelajaran}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="guru">Guru</label>
                                <select class="form-select @error('guru') is-invalid @enderror" id="guru" name="guru_edit">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($teacher as $showteacher)
                                        <option value="{{$showteacher->name}}">{{$showteacher->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row create">
                            <div class="col-lg-3 mb-3">
                                <label class="form-label" for="jam">Jam Pelajaran</label>
                                <select class="form-select @error('jam') is-invalid @enderror" id="jam" name="jam[]">
                                    <option value="">-- Pilih --</option>
                                    <option value="1">1 Jam Pelajaran</option>
                                    <option value="2">2 Jam Pelajaran</option>
                                    <option value="3">3 Jam Pelajaran</option>
                                </select>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label class="form-label" for="matapelajaran">Mata Pelajaran</label>
                                <select class="form-select @error('matapelajaran') is-invalid @enderror" id="matapelajaran" name="matapelajaran[]">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($subject as $showsubject)
                                        <option value="{{$showsubject->matapelajaran}}">{{$showsubject->matapelajaran}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label class="form-label" for="guru">Guru</label>
                                <select class="form-select @error('guru') is-invalid @enderror" id="guru" name="guru[]">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($teacher as $showteacher)
                                        <option value="{{$showteacher->name}}">{{$showteacher->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-1 mb-3">
                                <label class="form-label" for="">&nbsp;</label>
                                <button type="button" class="btn btn-icon btn-primary add">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="form2"></div>
                        <div class="mb-3">
                            <label class="form-label" for="kelas">Kelas</label>
                            <select class="form-select @error('kelas') is-invalid @enderror" id="kelas" name="kelas">
                                <option value="">-- Pilih --</option>
                                <option value="1">10</option>
                                <option value="2">11</option>
                                <option value="3">12</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="tahun">Tahun Pelajaran</label>
                            <select class="form-select @error('tahun') is-invalid @enderror" id="tahun" name="tahun">
                                <option value="">-- Pilih --</option>
                                @foreach ($year as $showyear)
                                    <option value="{{$showyear->tahun . '/' . $showyear->semester}}">{{$showyear->tahun . ' - ' . $showyear->semester}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 jurusan">
                            <label class="form-label" for="jurusan">Jurusan</label>
                            <select class="form-select @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan">
                                <option value="">-- Pilih --</option>
                                @foreach ($department as $showdepartment)
                                    <option value="{{$showdepartment->jurusan}}">{{$showdepartment->jurusan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 bagian_kelas">
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
            $('.jurusan').hide()
            $('.bagian_kelas').hide()

            $('#tambahjadwal').click(function () {
                $('.body_jadwal button[type=submit]').text('Add');
                $('.modal-title').text('Tambah Jadwal Pelajaran');
                $('.body_jadwal form').attr('action', '{{route("admin.schedule.store")}}');
                $('.body_jadwal form').attr('method', 'post');

                $("#hari").val('');
                $("#jam").val('');
                $("#matapelajaran").val('');
                $("#guru").val('');
                $("#tahun").val('');
                $("#jurusan").val('');
                $("#kelas").val('');

                $('.update').hide()
                $('.create').show()
            });

            $('#kelas').change(function (){
                let id = $(this).val();
                if (id == 1) {
                    $('.jurusan').hide();
                    $('.bagian_kelas').show();
                }else if(id == 2 || id == 3){
                    $('.jurusan').show();
                    $('.bagian_kelas').hide();
                }else{
                    $('.jurusan').hide();
                    $('.bagian_kelas').hide();
                }
            });

            $('#editjadwal*').click(function () {
                $('.update').show()
                $('.create').hide()
                const id = $(this).data('id');
                let _url = '{{route("admin.schedule.edit",":id")}}'.replace(':id', id);

                $('.body_jadwal button[type=submit]').text('Edit');
                $('.modal-title').text('Edit Jadwal Pelajaran');
                $('.body_jadwal form').attr('action', '{{route("admin.schedule.update",":id")}}'.replace(':id', id));
                $('.body_jadwal form').attr('method', 'post');

                $.ajax({
                    type: 'POST',
                    url: _url,
                    data: {
                        _token: '{{csrf_token()}}',
                    },
                    success: function (hasil) {
                        $('#hari').val(hasil.hari)
                        $('#jam').val(hasil.jam)
                        $('#matapelajaran').val(hasil.matapelajaran)
                        $('#guru').val(hasil.guru)
                        $('#tahun').val(hasil.tahun)
                        $('#jurusan').val(hasil.jurusan)
                        $('#no_kelas').val(hasil.no_kelas)
                        $('#kelas').val(hasil.kelas)
                        $('#kelas').trigger('change');
                    }
                });
            });

            var maxField = 10;
            var addButtonfont = $('.add');
            var font = $('.form2');
            var fieldHTMLfont = '<div class="row">' +
                '<div class="col-lg-3 mb-3">' +
                    '<label class="form-label" for="jam">Jam Pelajaran</label>' +
                    '<select class="form-select @error("jam") is-invalid @enderror" id="jam" name="jam[]">' +
                        '<option value="">-- Pilih --</option>' +
                        '<option value="1">1 Jam Pelajaran</option>' +
                        '<option value="2">2 Jam Pelajaran</option>' +
                        '<option value="3">3 Jam Pelajaran</option>' +
                    '</select>' +
                '</div>' +
                '<div class="col-lg-4 mb-3">' +
                    '<label class="form-label" for="matapelajaran">Mata Pelajaran</label>' +
                    '<select class="form-select @error("matapelajaran") is-invalid @enderror" id="matapelajaran" name="matapelajaran[]">' +
                        '<option value="">-- Pilih --</option>' +
                        '@foreach ($subject as $showsubject)' +
                        '<option value="{{$showsubject->id}}">{{$showsubject->matapelajaran}}</option>' +
                        '@endforeach' +
                    '</select>' +
                '</div>' +
                '<div class="col-lg-4 mb-3">' +
                    '<label class="form-label" for="guru">Guru</label>' +
                    '<select class="form-select @error("guru") is-invalid @enderror" id="guru" name="guru[]">' +
                        '<option value="">-- Pilih --</option>' +
                        '@foreach ($teacher as $showteacher)' +
                        '<option value="{{$showteacher->id}}">{{$showteacher->name}}</option>' +
                        '@endforeach' +
                    '</select>' +
                '</div>' +
                '<button type="button" class="btn btn-icon btn-primary remove mb-3 col" style="flex: 0 0 auto; width: 5.4%; height:7%; margin-top:1.7rem; margin-left:0.4rem;">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-minus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">' +
                        '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>' +
                        '<line x1="5" y1="12" x2="19" y2="12"></line>' +
                    '</svg>' +
                '</button>' +
            '</div>';
            var x = 1;
            $(addButtonfont).click(function () {
                if (x < maxField) {
                    x++;
                    $(font).append(fieldHTMLfont);
                }
            });
            $(font).click('.remove' , function (e) {
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            });
        });
    </script>
@endpush
