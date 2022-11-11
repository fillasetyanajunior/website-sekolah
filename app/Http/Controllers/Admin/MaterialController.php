<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Subject;
use App\Models\TeacherDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class MaterialController extends AppController
{
    public function index()
    {
        $title      = 'Materi';
        $subject    = Subject::all();
        $teacher    = TeacherDetail::all();
        $material   = Material::paginate(20);
        return view('admin.material.material', compact('title', 'subject', 'material','teacher'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mapel' => 'required',
            'judul' => 'required',
            'kelas' => 'required',
            'file'  => 'required',
        ]);

        $file = $request->file('file');
        $path = Storage::putFileAs('materi', $file, $request->judul . rand(1,100) . '.' . $file->extension());

        if ($request->kelas == 1) {
            $kelas = 'X';
        } elseif ($request->kelas == 2) {
            $kelas = 'XI';
        } else {
            $kelas = 'XII';
        }

        Material::create([
            'id_guru'       => TeacherDetail::where('nama', $request->guru)->first()->id,
            'matapelajaran' => Subject::where('matapelajaran', $request->mapel)->first()->id,
            'judul'         => $request->judul,
            'kelas'         => $kelas,
            'path'          => $path,
        ]);

        return redirect(route('admin.material'))->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Request $request)
    {
        $material = Material::find(Crypt::decrypt($request->material));
        return response()->json([
            'id_guru'       => TeacherDetail::find($material->id_guru)->nama,
            'matapelajaran' => Subject::find($material->mapel)->id,
            'judul'         => $material->judul,
            'kelas'         => $material->kelas,
        ]);
    }

    public function update(Request $request)
    {
        $material = Material::find(Crypt::decrypt($request->material));
        if ($request->kelas == 1) {
            $kelas = 'X';
        } elseif ($request->kelas == 2) {
            $kelas = 'XI';
        } else {
            $kelas = 'XII';
        }

        if ($request->hasFile('file')) {

            Storage::delete($material->path);

            $file = $request->file('file');
            $path = Storage::putFileAs('materi', $file, $request->judul . rand(1, 100) . '.' . $file->extension());

        } else {
            $path = $material->path;
        }

        Material::where('id', Crypt::decrypt($request->material))
            ->update([
                'id_guru'       => TeacherDetail::where('nama', $request->guru)->first()->id,
                'matapelajaran' => Subject::where('matapelajaran', $request->mapel)->first()->id,
                'judul'         => $request->judul,
                'kelas'         => $kelas,
                'path'          => $path,
            ]);

        return redirect(route('admin.meterial'))->with('success', 'Data Berhasil Update');
    }

    public function destroy(Request $request)
    {
        Material::destroy(Crypt::decrypt($request->material));
        return redirect(route('admin.meterial'))->with('success', 'Data Berhasil Delete');
    }
}
