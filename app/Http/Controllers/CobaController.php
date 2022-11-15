<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CobaController extends Controller
{
    public function coba()
    {
        $student = Student::where('id_siswa', 621)->first();
        dd(Crypt::decrypt($student->passworpassword_encryptedd_en));
        // $bln = date('m') - 6;
        // if ($bln < 0) {
        //     $bln2 = date('y', strtotime('+' . abs($bln) .'month', strtotime('+1 year', strtotime('-3 year'))));
        // }else{
        //     $bln2 = date('y', strtotime('-' . abs($bln) . 'month', strtotime('+1 year', strtotime('-3 year'))));
        // }
        // dd($bln2);
    }
}
