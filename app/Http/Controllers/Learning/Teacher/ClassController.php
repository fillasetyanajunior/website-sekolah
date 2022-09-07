<?php

namespace App\Http\Controllers\Learning\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Content;
use App\Models\FileContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ClassController extends AppController
{
    public function index(Request $request)
    {
        $request->only('id');
        $class      = Classroom::find(Crypt::decrypt($request->id));
        $title      = $class->nama;
        $content    = Content::where('id_classroom', Crypt::decrypt($request->id))->get();
        return view('teacher.learning.class.class', compact('title', 'content', 'request', 'class'));
    }
}
