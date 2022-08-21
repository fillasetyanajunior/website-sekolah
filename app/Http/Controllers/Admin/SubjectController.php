<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends AppController
{
    public function index()
    {
        $title          = 'Mata Pelajaran';
        $matapelajaran  = Subject::paginate(20);
        return view('admin.matapelajaran.matapelajaran', compact('matapelajaran','title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matapelajaran' => 'required',
        ]);

        Subject::create([
            'matapelajaran' => $request->matapelajaran,
        ]);
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Subject $subject)
    {
        return response()->json($subject);
    }

    public function update(Request $request, Subject $subject)
    {
        Subject::where('id', $subject->id)
            ->update([
                'matapelajaran' => $request->matapelajaran,
            ]);
        return redirect()->back()->with('success', 'Data Berhasil Update');
    }

    public function destroy(Subject $subject)
    {
        Subject::destroy($subject->id);
        return redirect()->back()->with('success', 'Data Berhasil Delete');
    }
}
