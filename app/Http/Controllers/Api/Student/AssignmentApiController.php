<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Content;
use App\Models\StudentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentApiController extends Controller
{
    public function assignment()
    {
        if (request()->user()->currentAccessToken()->name != 'student') {
            return response()->json(['status' => 'error']);
        }

        $student    = StudentDetail::find(Auth::user()->id_siswa);
        $classroom  = Classroom::where('kelas',$student->kelas)->where('jurusan',$student->jurusan)->get();
        $classrooms = Classroom::where('kelas',$student->kelas)->where('jurusan',$student->jurusan)->first();
        if ($classrooms == null) {
            $response = [];
        } else {
            foreach ($classroom as $showclassroom) {
                $content = Content::where('id_classroom',$showclassroom->id)->where('choices','Tugas')->get();
                foreach ($content as $showcontent) {
                    $response[] = [
                        'matapelajaran' => $showclassroom->nama,
                        'judul'         => $showcontent->judul,
                        'dateline'      => $showcontent->dateline,
                    ];
                }
            }
        }
        return response()->json($response);
    }
}
