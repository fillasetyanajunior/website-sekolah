<?php

namespace App\Imports;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;

class GradeImport implements ToModel
{
    public $teacher;
    public function __construct($teacher)
    {
        $this->teacher = $teacher;
    }

    public function model(array $row)
    {
        if ($row[6] == 'ganjil' || $row[6] == 'Ganjil') {
            $semester = 'Ganjil';
        } else {
            $semester = 'Genap';
        }

        $subject = Subject::where('matapelajaran', $row[4])->first();

        return new Grade([
            'nama'     => $row[1],
            'angka'    => $row[2],
            'huruf'    => $row[3],
            'mapel'    => $subject->id,
            'tahun'    => $row[5],
            'semester' => $semester,
            'guru'     => $this->teacher,
        ]);
    }
}
