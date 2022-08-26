<?php

namespace App\Imports;

use App\Models\Extracurricular;
use App\Models\StudentDetail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class ExtracurricularImport implements ToModel
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

        $student = StudentDetail::where('nama', $row['nama'])->first();

        return new Extracurricular([
            'id_siswa'  => $student->id,
            'angka'     => $row['angka'],
            'huruf'     => $row['huruf'],
            'extra'     => $row['extra'],
            'tahun'     => $row['tahun'],
            'semester'  => $semester,
            'guru'      => $this->teacher,
        ]);
    }
}
