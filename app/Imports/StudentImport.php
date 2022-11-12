<?php

namespace App\Imports;

use App\Models\Department;
use App\Models\District;
use App\Models\Employment;
use App\Models\Province;
use App\Models\Regency;
use App\Models\StudentDetail;
use App\Models\Village;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class StudentImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if ($row['jenis_kelamin'] == 'L') {
            $jenis_kelamin = 'Laki-laki';
        } else {
            $jenis_kelamin = 'Perempuan';
        }

        if ($row['pendidikan_ibu'] == 'SD' || $row['pendidikan_ibu'] == 'MI') {
            $pendidikan_ibu = 1;
        }elseif ($row['pendidikan_ibu'] == 'SMP' || $row['pendidikan_ibu'] == 'MTs') {
            $pendidikan_ibu = 2;
        }elseif ($row['pendidikan_ibu'] == 'SMA' || $row['pendidikan_ibu'] == 'MA'|| $row['pendidikan_ibu'] == 'SMK'|| $row['pendidikan_ibu'] == 'SMU') {
            $pendidikan_ibu = 3;
        }elseif ($row['pendidikan_ibu'] == 'D1' || $row['pendidikan_ibu'] == 'D2'|| $row['pendidikan_ibu'] == 'D3'|| $row['pendidikan_ibu'] == 'D4') {
            $pendidikan_ibu = 4;
        }elseif ($row['pendidikan_ibu'] == 'S1' || $row['pendidikan_ibu'] == 'S2'|| $row['pendidikan_ibu'] == 'S3') {
            $pendidikan_ibu = 5;
        } else {
            $pendidikan_ibu = 0;
        }

        if ($row['pendidikan_bapak'] == 'SD' || $row['pendidikan_bapak'] == 'MI') {
            $pendidikan_bapak = 1;
        }elseif ($row['pendidikan_bapak'] == 'SMP' || $row['pendidikan_bapak'] == 'MTs') {
            $pendidikan_bapak = 2;
        }elseif ($row['pendidikan_bapak'] == 'SMA' || $row['pendidikan_bapak'] == 'MA'|| $row['pendidikan_bapak'] == 'SMK'|| $row['pendidikan_bapak'] == 'SMU') {
            $pendidikan_bapak = 3;
        }elseif ($row['pendidikan_bapak'] == 'D1' || $row['pendidikan_bapak'] == 'D2'|| $row['pendidikan_bapak'] == 'D3'|| $row['pendidikan_bapak'] == 'D4') {
            $pendidikan_bapak = 4;
        }elseif ($row['pendidikan_bapak'] == 'S1' || $row['pendidikan_bapak'] == 'S2'|| $row['pendidikan_bapak'] == 'S3') {
            $pendidikan_bapak = 5;
        } else {
            $pendidikan_bapak = 0;
        }

        if ($row['pekerjaan_ibu'] == '-') {
            $pekerjaan_ibu = 0;
        } else {
            $pekerjaan_ibu = Employment::where('nama', Str::upper($row['pekerjaan_ibu']))->first()->id;
        }

        if ($row['pekerjaan_bapak'] == '-') {
            $pekerjaan_bapak = 0;
        } else {
            $pekerjaan_bapak = Employment::where('nama', Str::upper($row['pekerjaan_bapak']))->first()->id;
        }

        if ($row['provinsi'] == '-') {
            $provinsi = 0;
        }else {
            $provinsi = Province::where('name', Str::upper($row['provinsi']))->first()->id;
        }

        if ($row['kabupaten'] == '-') {
            $kabupaten = 0;
        }else {
            $kabupatencek = Regency::where('province_id', $provinsi)->where('name','KABUPATEN ' . Str::upper($row['kabupaten']))->first();
            if ($kabupatencek != null) {
                $kabupaten = $kabupatencek->id;
            } else {
                $kabupaten = Regency::where('province_id', $provinsi)->where('name', 'KOTA ' . Str::upper($row['kabupaten']))->first()->id;
            }
        }

        if ($row['kecamatan'] == '-') {
            $kecamatan = 0;
        }else {
            $kecamatan = District::where('regency_id', $kabupaten)->where('name', Str::upper($row['kecamatan']))->first()->id;
        }

        if ($row['desa'] == '-') {
            $desa = 0;
        }else {
            $desa = Village::where('district_id', $kecamatan)->where('name', Str::upper($row['desa']))->first()->id;
        }

        if ($row['kelas'] == 'X') {
            return new StudentDetail([
                'nama'              => Str::title($row['nama']),
                'nisn'              => Str::after($row['nisn'],"'"),
                'tempat_lahir'      => Str::title($row['tempat_lahir']),
                'tanggal_lahir'     => date('Y-m-d', strtotime(Str::replace('|', '-', $row['tanggal_lahir']))),
                'jenis_kelamin'     => $jenis_kelamin,
                'agama'             => 'Islam',
                'nomer_hp'          => Str::after($row['nomer_hp'], "'"),
                'email'             => '',
                'nama_ibu'          => Str::title($row['nama_ibu']),
                'nama_bapak'        => Str::title($row['nama_bapak']),
                'pekerjaan_ibu'     => $pekerjaan_ibu,
                'pekerjaan_bapak'   => $pekerjaan_bapak,
                'pendidikan_ibu'    => $pendidikan_ibu,
                'pendidikan_bapak'  => $pendidikan_bapak,
                'penghasilan_ibu'   => 1,
                'penghasilan_bapak' => 1,
                'pendidikan'        => 1,
                'nama_sekolah'      => '',
                'provinsi_id'       => $provinsi,
                'kabupaten_id'      => $kabupaten,
                'kecamatan_id'      => $kecamatan,
                'desa_id'           => $desa,
                'dusun'             => $row['dusun'],
                'rw'                => '',
                'rt'                => '',
                'alamat'            => $row['alamat'],
                'kode_pos'          => $row['kode_pos'],
                'no_kelas'          => $row['no_kelas'],
                'kelas'             => $row['kelas'],
            ]);
        } else {
            return new StudentDetail([
                'nama'              => Str::title($row['nama']),
                'nisn'              => Str::after($row['nisn'],"'"),
                'tempat_lahir'      => Str::title($row['tempat_lahir']),
                'tanggal_lahir'     => date('Y-m-d', strtotime(Str::replace('|', '-', $row['tanggal_lahir']))),
                'jenis_kelamin'     => $jenis_kelamin,
                'agama'             => 'Islam',
                'nomer_hp'          => Str::after($row['nomer_hp'], "'"),
                'email'             => '',
                'nama_ibu'          => Str::title($row['nama_ibu']),
                'nama_bapak'        => Str::title($row['nama_bapak']),
                'pekerjaan_ibu'     => $pekerjaan_ibu,
                'pekerjaan_bapak'   => $pekerjaan_bapak,
                'pendidikan_ibu'    => $pendidikan_ibu,
                'pendidikan_bapak'  => $pendidikan_bapak,
                'penghasilan_ibu'   => 1,
                'penghasilan_bapak' => 1,
                'pendidikan'        => 1,
                'nama_sekolah'      => '',
                'provinsi_id'       => $provinsi,
                'kabupaten_id'      => $kabupaten,
                'kecamatan_id'      => $kecamatan,
                'desa_id'           => $desa,
                'dusun'             => $row['dusun'],
                'rw'                => '',
                'rt'                => '',
                'alamat'            => $row['alamat'],
                'kode_pos'          => $row['kode_pos'],
                'jurusan'           => Department::where('jurusan',($row['jurusan']))->first()->id,
                'kelas'             => $row['kelas'],
            ]);
        }

    }
}
