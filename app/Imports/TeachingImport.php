<?php

namespace App\Imports;

use App\Models\Department;
use App\Models\Subject;
use App\Models\TeacherDetail;
use App\Models\Teaching;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeachingImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $subjectcek = Subject::where('matapelajaran', $row['matapelajaran_diampu'])->first();
        if ($subjectcek == null) {
            Subject::create(['matapelajaran' => $row['matapelajaran_diampu']]);
        }

        if ($row['kelas_diampu'] == 'X') {
            return new Teaching([
                'id_guru'       => TeacherDetail::where('nama', $row['nama'])->first()->id,
                'kelas'         => $row['kelas_diampu'],
                'no_kelas'      => $row['jurusan_no_kelas'],
                'matapelajaran' => Subject::where('matapelajaran', $row['matapelajaran_diampu'])->first()->id,
            ]);
        } else {
            return new Teaching([
                'id_guru'       => TeacherDetail::where('nama', $row['nama'])->first()->id,
                'kelas'         => $row['kelas_diampu'],
                'jurusan'       => Department::where('jurusan', $row['jurusan_no_kelas'])->first()->id,
                'matapelajaran' => Subject::where('matapelajaran', $row['matapelajaran_diampu'])->first()->id,
            ]);
        }
    }
}
