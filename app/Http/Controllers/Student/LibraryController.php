<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Lending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryController extends AppController
{
    public function index()
    {
        $title      = 'Perpustakaan';
        $lending    = Lending::where('id_siswa', Auth::user()->id_siswa)->paginate(20);
        return view('student.library.library', compact('title', 'lending'));
    }
}
