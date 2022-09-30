<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends AppController
{
    public function index()
    {
        $title  = 'Berita';
        $news    = News::paginate(20);
        return view('admin.news.news', compact('title', 'news'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required',
            'description'   => 'required',
            'thumnail'      => 'required',
            'choices'       => 'required',
        ]);

        if ($request->choices == 1) {
            $choices = 'Berita';
        } else {
            $choices = 'Info';
        }


        $file = $request->file('thumnail');
        $path = Storage::putFileAs('news', $file, $request->judul . rand(1, 100) . '.' . $file->extension());

        News::create([
            'title'         => $request->title,
            'description'   => $request->description,
            'thumnail'      => $path,
            'choices'       => $choices,
        ]);
        return redirect()->back()->with('success', 'Data Berhasil Di Posting');
    }

    public function edit(News $news)
    {
        return response()->json($news);
    }

    public function update(News $news, Request $request)
    {
        if ($request->choices == 1) {
            $choices = 'Berita';
        } else {
            $choices = 'Info';
        }

        if ($request->hasfile('thumnail')) {
            Storage::delete(Storage::path($news->thumnail));
            $file = $request->file('thumnail');
            $path = Storage::putFileAs('news', $file, $request->judul . rand(1, 100) . '.' . $file->extension());
        } else {
            $path = $news->thumnail;
        }

        News::where('id', $news->id)
            ->update([
                'title'         => $request->title,
                'description'   => $request->description,
                'thumnail'      => $path,
                'choices'       => $choices,
            ]);
        return redirect()->back()->with('success', 'Data Berhasil Update');
    }

    public function destroy(News $news)
    {
        News::destroy($news->id);
        return redirect()->back()->with('success', 'Data Berhasil Delete');
    }
}
