<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\StudentDetail;
use App\Models\TeacherDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    public function index()
    {
        $title  = "Man Buleleng";
        $berita = News::orderBy('created_at', 'DESC')->where('choices','Berita')->limit(8)->get();
        $info   = News::orderBy('created_at', 'DESC')->where('choices','Info')->limit(8)->get();
        return view('home.home',compact('berita','info','title'));
    }

    public function teacher()
    {
        $title  = "Guru dan Pegawai";
        $guru   = TeacherDetail::orderBy('nama')->get();
        return view('home.teacher',compact('title','guru'));
    }

    public function student()
    {
        $title = "Siswa";
        $siswa = StudentDetail::groupBy('kelas')->get('kelas');
        return view('home.student',compact('title','siswa'));
    }

    public function news(Request $request)
    {
        $request->only('id');
        $news   = News::find(Crypt::decrypt($request->id));
        $title  = $news->title;
        return view('home.newsdetail',compact('news','title'));
    }

    public function info(Request $request)
    {
        $request->only('id');
        $news   = News::find(Crypt::decrypt($request->id));
        $title  = $news->title;
        return view('home.newsdetail',compact('news','title'));
    }
}
