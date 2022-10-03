<?php

namespace App\Http\Controllers\Learning\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Content;
use App\Models\FileContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ContentController extends AppController
{
    public function index(Request $request)
    {
        $content    = Content::find(Crypt::decrypt($request->id));
        $class      = Classroom::find($content->id_classroom)->nama;
        $title      = $content->judul;
        $assigment  = Assignment::where('id_content', $content->id)->get();
        return view('teacher.learning.content.content', compact('title', 'class', 'content', 'assigment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'         => 'required',
            'description'   => 'required',
            'choices'       => 'required',
        ]);

        if ($request->choices == 1) {
            $choices    = 'Materi';
            $dateline   = null;
        } elseif ($request->choices == 2) {
            $choices    = 'Tugas';
            $dateline   = $request->dateline;
        } else {
            $choices    = 'Kuis';
            $dateline   = $request->dateline;
        }

        $content = Content::create([
            'id_classroom'  => Crypt::decrypt($request->id_classroom),
            'judul'         => $request->judul,
            'description'   => $request->description,
            'choices'       => $choices,
            'dateline'      => $dateline,
        ]);

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $path  = Storage::putFileAs('classroom', $file, $file->getClientOriginalName());

                FileContent::create([
                    'id_content'    => $content->id,
                    'path'          => $path,
                    'extension'     => $file->getClientOriginalExtension(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function show(Request $request)
    {
        $file = FileContent::where('id_content', Crypt::decrypt($request->id))->first();
        return view('teacher.learning.pdf.index', compact('file'));
    }

    public function edit(Content $content)
    {
        return response()->json($content);
    }

    public function update(Request $request, Content $content)
    {
        $filecontent = FileContent::where('id_content', $content->id)->get();
        foreach ($filecontent as $showfilecontent) {
            Storage::delete(Storage::path($showfilecontent->path));
        }

        FileContent::where('id_content', $content->id)->delete();

        if ($content->choices == 'Material') {
            $dateline   = null;
        } elseif ($content->choices == 'Tugas') {
            $dateline   = $request->dateline;
        } else {
            $dateline   = $request->dateline;
        }

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $path  = Storage::putFileAs('classroom', $file, $file->getClientOriginalName());

                FileContent::create([
                    'id_content'    => $content->id,
                    'path'          => $path,
                ]);
            }
        }

        Content::where('id', $content->id)
            ->update([
                'id_classroom'  => Crypt::decrypt($request->id_classroom),
                'judul'         => $request->judul,
                'description'   => $request->description,
                'dateline'      => $dateline,
            ]);

        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function destroy(Content $content)
    {
        Content::destroy($content->id);
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }
}
