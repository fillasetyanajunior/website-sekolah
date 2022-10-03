<?php

namespace App\Http\Controllers\Learning\Student;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ClassController extends AppController
{
    public function index(Request $request)
    {
        $request->only('id');
        $class      = Classroom::find(Crypt::decrypt($request->id));
        $title      = $class->nama;
        $content    = Content::where('id_classroom', Crypt::decrypt($request->id))->get();
        return view('student.learning.class.class', compact('title', 'content'));
    }
}
