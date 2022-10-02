<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magazine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MagazineController extends AppController
{
    public function index()
    {
        $title      = 'Majalah Madani';
        $magazine   = Magazine::paginate(20);
        return view('admin.magazine.magazine',compact('title', 'magazine'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required',
            'thumnail'  => 'required',
            'file'      => 'required',
        ]);

        $thumnails  = $request->file('thumnail');
        $thumnail   = Storage::putFileAs('magazine-thumnail',$thumnails,time() . rand(1,100) . $thumnails->getClientOriginalExtension());

        $file = $request->file('file');
        $path = Storage::putFileAs('magazine',$file,time() . rand(1,100) . $file->getClientOriginalExtension());

        Magazine::create([
            'title'     => $request->title,
            'thumnail'  => $thumnail,
            'file'      => $path,
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Magazine $magazine)
    {
        return response()->json($magazine);
    }

    public function update(Request $request, Magazine $magazine)
    {
        if ($request->hasFile('thumnail')) {
            $thumnails  = $request->file('thumnail');
            $thumnail   = Storage::putFileAs('magazine-thumnail', $thumnails, time() . rand(1, 100) . $thumnails->getClientOriginalExtension());

            $path       = $magazine->file;
        }elseif ($request->hasFile('file')) {
            $thumnail   = $magazine->thumnail;
            $file       = $request->file('file');
            $path       = Storage::putFileAs('magazine', $file, time() . rand(1, 100) . $file->getClientOriginalExtension());
        }else {
            $path       = $magazine->file;
            $thumnail   = $magazine->thumnail;
        }

        Magazine::create([
            'title'     => $request->title,
            'thumnail'  => $thumnail,
            'file'      => $path,
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Diupdate');
    }

    public function destroy(Magazine $magazine)
    {
        Magazine::destroy($magazine->id);
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }
}
