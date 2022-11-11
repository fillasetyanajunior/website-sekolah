<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SubjectController extends AppController
{
    public function index()
    {
        $title      = 'Mata Pelajaran';
        $subject    = Subject::paginate(20);
        return view('admin.subject.subject', compact('subject','title'));
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

    public function edit(Request $request)
    {
        return response()->json(Subject::find(Crypt::decrypt($request->subject)));
    }

    public function update(Request $request)
    {
        Subject::where('id', Crypt::decrypt($request->subject))
            ->update([
                'matapelajaran' => $request->matapelajaran,
            ]);
        return redirect()->back()->with('success', 'Data Berhasil Update');
    }

    public function destroy(Request $request)
    {
        Subject::destroy(Crypt::decrypt($request->subject));
        return redirect()->back()->with('success', 'Data Berhasil Delete');
    }
}
