<?php

namespace App\Http\Controllers\Learning\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ContentController extends AppController
{
    public function index(Request $request)
    {
        $content    = Content::find(Crypt::decrypt($request->id));
        $class      = Classroom::find($content->id_classroom)->nama;
        $title      = $content->judul;
        $assigment  = Assignment::where('id_content', $content->id)->where('id_siswa',Auth::user()->id_siswa)->get();
        $assigments = Assignment::where('id_content', $content->id)->where('id_siswa',Auth::user()->id_siswa)->first();
        return view('student.learning.content.content', compact('title', 'class', 'content', 'assigment', 'assigments'));
    }
}
