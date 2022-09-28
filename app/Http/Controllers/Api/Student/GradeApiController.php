<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\StudentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeApiController extends Controller
{
    public function nilai(Request $request)
    {
        if (request()->user()->currentAccessToken()->name != 'student') {
            return response()->json(['status' => 'error']);
        }

        // $deuteronomi    = Grade::join('subjects', 'subjects.id', '=', 'grades.matapelajaran')
        //                         ->join('years', 'years.id', '=', 'grades.tahun')
        //                         ->join('teacher_details', 'teacher_details.id', '=', 'grades.guru')
        //                         ->where('grades.kelas', 'X')->where('grades.semester', 'Ganjil')->where('id_siswa',Auth::user()->id_siswa)
        //                         ->select('grades.id', 'grades.semester', 'grades.angka', 'grades.huruf', 'subjects.matapelajaran', 'teacher_details.nama as guru', 'years.tahun', 'grades.kelas')->get();
        $deuteronomi    = Grade::join('subjects', 'subjects.id', '=', 'grades.matapelajaran')
                                ->join('years', 'years.id', '=', 'grades.tahun')
                                ->join('teacher_details', 'teacher_details.id', '=', 'grades.guru')
                                ->where('grades.kelas', $request->kelas)->where('grades.semester', $request->semester)->where('id_siswa',Auth::user()->id_siswa)
                                ->select('grades.id', 'grades.semester', 'grades.angka', 'grades.huruf', 'subjects.matapelajaran', 'teacher_details.nama as guru', 'years.tahun', 'grades.kelas')->get();
        return response()->json($deuteronomi);
    }
}
