<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Models\Deuteronomi;
use App\Models\StudentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeuteronomiApiController extends Controller
{
    public function ulangan()
    {
        if (request()->user()->currentAccessToken()->name != 'student') {
            return response()->json(['status' => 'error']);
        }

        $student        = StudentDetail::find(Auth::user()->id_siswa);
        $deuteronomi    = Deuteronomi::join('subjects', 'subjects.id', '=', 'deuteronomis.matapelajaran')
                                     ->join('years', 'years.id', '=', 'deuteronomis.tahun')
                                     ->join('departments', 'departments.id', '=', 'deuteronomis.jurusan')
                                    ->where('deuteronomis.kelas', $student->kelas)->where('deuteronomis.jurusan', $student->jurusan)->where('tanggal', date('Y-m-d'))->where('id_siswa', Auth::user()->id_siswa)
                                   ->select('deuteronomis.id', 'deuteronomis.tanggal', 'deuteronomis.jam', 'subjects.matapelajaran', 'years.tahun', 'departments.jurusan', 'deuteronomis.kelas','deuteronomis.kursi','deuteronomis.ruangan')->get();
        return response()->json($deuteronomi);
    }

    public function show()
    {
        if (request()->user()->currentAccessToken()->name != 'student') {
            return response()->json(['status' => 'error']);
        }

        $student        = StudentDetail::find(Auth::user()->id_siswa);
        $deuteronomi    = Deuteronomi::join('subjects', 'subjects.id', '=', 'deuteronomis.matapelajaran')
                                     ->join('years', 'years.id', '=', 'deuteronomis.tahun')
                                     ->join('departments', 'departments.id', '=', 'deuteronomis.jurusan')
                                    ->where('deuteronomis.kelas', $student->kelas)->where('deuteronomis.jurusan', $student->jurusan)->where('id_siswa', Auth::user()->id_siswa)
                                   ->select('deuteronomis.id', 'deuteronomis.tanggal', 'deuteronomis.jam', 'subjects.matapelajaran', 'years.tahun', 'departments.jurusan', 'deuteronomis.kelas','deuteronomis.kursi','deuteronomis.ruangan')->get();
        return response()->json($deuteronomi);
    }

    public function day()
    {
        if (request()->user()->currentAccessToken()->name != 'student') {
            return response()->json(['status' => 'error']);
        }

        $student        = StudentDetail::find(Auth::user()->id_siswa);
        $deuteronomi    = Deuteronomi::groupBy('tanggal')
                                    ->where('deuteronomis.kelas', $student->kelas)->where('deuteronomis.jurusan', $student->jurusan)->where('id_siswa', Auth::user()->id_siswa)
                                   ->get('tanggal');
        return response()->json($deuteronomi);
    }
}
