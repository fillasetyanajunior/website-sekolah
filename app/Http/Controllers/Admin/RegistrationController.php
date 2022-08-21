<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegistrationController extends Controller
{
    public function index()
    {
        $title          = "Data Pendaftaran";
        $registration   = Registration::orderBy('nama')->paginate(20);
        return view('admin.pendaftaran.pendaftaran', compact('registration', 'title'));
    }

    public function edit(Registration $registration)
    {
        return response()->json($registration);
    }
}
