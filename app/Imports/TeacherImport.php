<?php

namespace App\Imports;

use App\Models\TeacherDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeacherImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new TeacherDetail([
            'nama'                  => $row['nama'],
            'nuptk'                 => $row['nuptk'],
            'alamat'                => $row['alamat'],
            'nomer'                 => $row['nomer'],
            'email'                 => $row['email'],
            'lulusan'               => $row['lulusan'],
            'wali_kelas'            => $row['wali_kelas'],
            'wali_jurusan'          => $row['wali_kelas'],
            'wali_no_kelas'         => $row['wali_kelas'],
            'status'                => $row['wali_kelas'],
            'jabatan'               => $row['wali_kelas'],
            'sertifikat_pendidikan' => $row['wali_kelas'],
            'izasah'                => $row['wali_kelas'],
        ]);
    }
}
