<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CobaController extends Controller
{
    public function coba()
    {
        dd(Crypt::decrypt('eyJpdiI6IkNmN29wMmh0L1JFRHdaZUlNM1ZwNEE9PSIsInZhbHVlIjoieXI5WHFYd05hTWFMVEtUSFUwU0JuUT09IiwibWFjIjoiYjc4OTk5MDJlZDQyYjc3NjNkYjIzM2FjODMwNDlkMDVmMjJmZTVlODRlN2Q4YzcxYjU5MGQ3OWU3OTFjNjAwNCIsInRhZyI6IiJ9'));
        // $bln = date('m') - 6;
        // if ($bln < 0) {
        //     $bln2 = date('y', strtotime('+' . abs($bln) .'month', strtotime('+1 year', strtotime('-3 year'))));
        // }else{
        //     $bln2 = date('y', strtotime('-' . abs($bln) . 'month', strtotime('+1 year', strtotime('-3 year'))));
        // }
        // dd($bln2);
    }
}
