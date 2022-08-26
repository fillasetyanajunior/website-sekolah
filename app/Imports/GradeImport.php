<?php

namespace App\Imports;

use App\Models\Grade;
use App\Models\StudentDetail;
use App\Models\Subject;
use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GradeImport implements ToModel, WithHeadingRow
{
    public $teacher;
    public function __construct($teacher)
    {
        $this->teacher = $teacher;
    }

    public function model(array $row)
    {
        if ($row['semester'] == 'ganjil' || $row['semester'] == 'Ganjil') {
            $semester = 'Ganjil';
        } else {
            $semester = 'Genap';
        }

        $subject = Subject::where('matapelajaran', $row['matapelajaran'])->first();
        $student = StudentDetail::where('nama', $row['nama'])->first();

        return new Grade([
            'id_siswa'  => $student->id,
            'angka'     => $row['angka'],
            'huruf'     => $row['huruf'],
            'mapel'     => $subject->id,
            'tahun'     => $row['tahun'],
            'semester'  => $semester,
            'guru'      => $this->teacher,
        ]);
    }
}
