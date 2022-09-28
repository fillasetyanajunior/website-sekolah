<?php

namespace App\Http\Controllers\Learning\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Content;
use App\Models\FileAssigment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ContentController extends AppController
{
    public function index(Request $request)
    {
        $content    = Content::find(Crypt::decrypt($request->id));
        $class      = Classroom::find($content->id_classroom)->nama;
        $title      = $content->judul;
        $assigment  = Assignment::where('id_content', $content->id)->where('id_siswa',Auth::user()->id_siswa)->first();
        return view('student.learning.content.content', compact('title', 'class', 'content', 'assigment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file.*' => 'required',
        ]);

        $assigment = Assignment::create([
            'id_content'    => $request->id_content,
            'id_siswa'      => Auth::user()->id_siswa,
        ]);

        foreach ($request->file('file') as $file) {
            $path  = Storage::putFileAs('assigment', $file, $file->getClientOriginalName());

            FileAssigment::create([
                'id_assigment'  => $assigment->id,
                'path'          => $path,
                'extension'     => $file->getClientOriginalExtension(),
            ]);
        }

        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function submit(Request $request)
    {
        $request->only('id');
        Assignment::where('id_content',Crypt::decrypt($request->id))
                  ->where('id_siswa',Auth::user()->id_siswa)
                 ->update([
                    'choices' => 'Submit'
                ]);

        return redirect()->back()->with('success','Data Berhasil Diubah');
    }

    public function unsubmit(Request $request)
    {
        $request->only('id');
        Assignment::where('id_content',Crypt::decrypt($request->id))
                  ->where('id_siswa',Auth::user()->id_siswa)
                 ->update([
                    'choices' => 'Unsubmit'
                ]);

        return redirect()->back()->with('success','Data Berhasil Diubah');
    }
    public function destroy(Request $request)
    {
        $request->only('title');
        FileAssigment::where('path','assigment/' . Crypt::decrypt($request->title))->delete();

        return redirect()->back()->with('success','Data Berhasil Diubah');
    }
}
