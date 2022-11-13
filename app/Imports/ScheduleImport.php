<?php

namespace App\Imports;

use App\Models\Department;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\TeacherDetail;
use App\Models\Year;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ScheduleImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $jam            = explode('|', $row['jam']);
        $matapelajarans = Subject::where('matapelajaran', $row['matapelajaran'])->first();
        if ($matapelajarans == null) {
            $matapelajaran = Subject::create(['matapelajaran' => $row['matapelajaran']])->id;
        }else{
            $matapelajaran = $matapelajarans->id;
        }

        if ($row['guru'] == '-') {
            $guru = 0;
        }else{
            $guru = TeacherDetail::where('nama', $row['guru'])->first()->id;
        }

        $tahuns = Year::where('tahun', $row['tahun'])->where('semester', $row['semester'])->first();

        if ($tahuns == null) {
            $tahun = Year::create(['tahun' => $row['tahun'],'semester' => $row['semester']])->id;
        } else {
            $tahun = $tahuns->id;
        }

        if ($row['kelas'] == 'X') {
            return new Schedule([
                'hari'          => Str::title($row['hari']),
                'jam_start'     => Str::replace('.', ':', $jam[0]),
                'jam_end'       => Str::replace('.', ':', $jam[1]),
                'matapelajaran' => $matapelajaran,
                'guru'          => $guru,
                'tahun'         => $tahun,
                'no_kelas'      => $row['no_kelas'],
                'kelas'         => $row['kelas'],
            ]);
        } else {
            $jurusan = Department::where('jurusan', $row['jurusan'])->first()->id;
            return new Schedule([
                'hari'          => Str::title($row['hari']),
                'jam_start'     => Str::replace('.', ':', $jam[0]),
                'jam_end'       => Str::replace('.', ':', $jam[1]),
                'matapelajaran' => $matapelajaran,
                'guru'          => $guru,
                'tahun'         => $tahun,
                'jurusan'       => $jurusan,
                'kelas'         => $row['kelas'],
            ]);
        }

    }
}
