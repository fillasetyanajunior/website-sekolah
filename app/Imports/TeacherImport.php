<?php

namespace App\Imports;

use App\Models\Department;
use App\Models\TeacherDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class TeacherImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if ($row['jenis_kelamin'] == 'L') {
            $jenis_kelamin = 'Laki-laki';
        } else {
            $jenis_kelamin = 'Perempuan';
        }

        if ($row['wali_kelas'] == '-') {
            return new TeacherDetail([
                'nama'              => $row['nama'],
                'nuptk'             => $row['nuptk'],
                'nip'               => $row['nip'],
                'jenis_kelamin'     => $jenis_kelamin,
                'tempat_lahir'      => $row['tempat_lahir'],
                'tanggal_lahir'     => date('Y-m-d', strtotime(Str::replace('|', '-', $row['tanggal_lahir']))),
                'nomor_hp'          => $row['nomor_hp'],
                'email'             => $row['email'],
                'status_pegawai'    => $row['status_pegawai'],
                'jabatan'           => $row['jabatan'] == '-' ? 'Lainnya' : $row['jabatan'],
            ]);
        } else {
            if ($row['wali_kelas'] == 'X') {
                return new TeacherDetail([
                    'nama'              => $row['nama'],
                    'nuptk'             => $row['nuptk'],
                    'nip'               => $row['nip'],
                    'jenis_kelamin'     => $jenis_kelamin,
                    'tempat_lahir'      => $row['tempat_lahir'],
                    'tanggal_lahir'     => date('Y-m-d', strtotime(Str::replace('|', '-', $row['tanggal_lahir']))),
                    'nomor_hp'          => $row['nomor_hp'],
                    'email'             => $row['email'],
                    'wali_kelas'        => $row['wali_kelas'],
                    'wali_no_kelas'     => $row['wali_no_kelas'],
                    'status_pegawai'    => $row['status_pegawai'],
                    'jabatan'           => $row['jabatan'] == '-' ? 'Lainnya' : $row['jabatan'],
                ]);
            } else {
                return new TeacherDetail([
                    'nama'              => $row['nama'],
                    'nuptk'             => $row['nuptk'],
                    'nip'               => $row['nip'],
                    'jenis_kelamin'     => $jenis_kelamin,
                    'tempat_lahir'      => $row['tempat_lahir'],
                    'tanggal_lahir'     => date('Y-m-d', strtotime(Str::replace('|', '-', $row['tanggal_lahir']))),
                    'nomor_hp'          => $row['nomor_hp'],
                    'email'             => $row['email'],
                    'wali_kelas'        => $row['wali_kelas'],
                    'wali_jurusan'      => Department::where('jurusan', $row['wali_jurusan'])->first()->id,
                    'status_pegawai'    => $row['status_pegawai'],
                    'jabatan'           => $row['jabatan'] == '-' ? 'Lainnya' : $row['jabatan'],
                ]);
            }
        }
    }
}
