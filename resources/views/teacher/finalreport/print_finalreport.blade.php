<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container-sm">
        <table class="table table-borderless mb-5">
            <tbody>
                <tr>
                    <td width="160px">Nama Peserta Didik</td>
                    <td>:</td>
                    <td>{{$student->nama}}</td>
                    <td width="160px">Kelas</td>
                    <td>:</td>
                    <td>{{$student->kelas}}({{$student->kelas == 'X' ? 'Sepuluh' : $student->kelas == 'XI' ? 'Sebelas' : 'Dua Belas'}})</td>
                </tr>
                <tr>
                    <td>NISN</td>
                    <td>:</td>
                    <td>{{$student->nisn}}</td>
                    <td>Fase</td>
                    <td>:</td>
                    <td>B</td>
                </tr>
                <tr>
                    <td>Sekolah</td>
                    <td>:</td>
                    <td>MAN Buleleng</td>
                    <td>Semester</td>
                    <td>:</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{$student->alamat}}</td>
                    <td>Tahun Pelajaran</td>
                    <td>:</td>
                    <td>2022/2023</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered mb-5">
            <thead class="text-center align-middle">
                <tr>
                    <th>No.</th>
                    <th>Mata Pelajaran</th>
                    <th>Nilai Akhir</th>
                    <th>Capaian Kompetensi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($grade as $showgrade)
                    <tr>
                        <td class="text-center" rowspan="2">{{$i++}}</td>
                        <td class="text-center" rowspan="2">{{App\Models\Subject::find($showgrade->matapelajaran)->matapelajaran}}</td>
                        <td class="text-center align-middle" rowspan="2">{{$showgrade->angka}}</td>
                        <td>Menunjukkan pemahaman terhadap Pancasila dan mampu menerapkan dalam kehidupan sehari-hari.</td>
                    </tr>
                    <tr>
                        <td>Perlu bantuan dalam membedakan hak dan kewajiban.</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="text-center">
                    <th>No.</th>
                    <th>Ektrakulikuler</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $j = 1;
                @endphp
                @foreach ($extra as $showextra)
                    <tr>
                        <td>{{$j++}}</td>
                        <td>{{$showextra->extra}}</td>
                        <td>Baik, mampu menerapkan Dwi Darma maupun Dasa Darma, cakap memahami sejarah dan teknik
                            kepramukaan.</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex">
            <div class="">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-center">Ketidakhadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="150px">Sakit</td>
                            <td width="100px">{{$hadir}} Hari</td>
                        </tr>
                        <tr>
                            <td>Izin</td>
                            <td>{{$izin}} Hari</td>
                        </tr>
                        <tr>
                            <td>Tanpa Keterangan</td>
                            <td>{{$tanpaket}} Hari</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="ms-auto">
                <div class="d-flex flex-column">
                    <div>
                        <b>Tempat, Tanggal rapor</b>
                    </div>
                    <div>
                        &nbsp;
                    </div>
                    <div>
                        &nbsp;
                    </div>
                    <div>
                        &nbsp;
                    </div>
                    <div>
                        &nbsp;
                    </div>
                    <div>
                        <b>TTD Wali Kelas</b>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="d-flex flex-column">
                <div>
                    <b>TTD Orang Tua Peserta Didik</b>
                </div>
                <div>
                    &nbsp;
                </div>
                <div>
                    &nbsp;
                </div>
                <div>
                    &nbsp;
                </div>
                <div>
                    &nbsp;
                </div>
                <div>
                    <b>.................................................</b>
                </div>
            </div>
            <div class="d-flex flex-column mt-5 mb-5">
                <div class="text-center">
                    <b>TTD Kepala Sekolah</b>
                </div>
                <div>
                    &nbsp;
                </div>
                <div>
                    &nbsp;
                </div>
                <div>
                    &nbsp;
                </div>
                <div>
                    &nbsp;
                </div>
                <div class="text-center">
                    <b>.................................................</b>
                </div>
            </div>
            <div>
                &nbsp;
            </div>
        </div>

        <script>
            // window.print();
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
