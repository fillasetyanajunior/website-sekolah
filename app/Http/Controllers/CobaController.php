<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CobaController extends Controller
{
    public function coba()
    {
        $bln = date('m') - 6;
        if ($bln < 0) {
            $bln2 = date('y', strtotime('+' . abs($bln) .'month', strtotime('+1 year', strtotime('-3 year'))));
        }else{
            $bln2 = date('y', strtotime('-' . abs($bln) . 'month', strtotime('+1 year', strtotime('-3 year'))));
        }
        dd($bln2);
    }
}
