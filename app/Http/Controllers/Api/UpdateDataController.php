<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class UpdateDataController extends Controller
{
    public function update(Request $request)
    {
        $attendance = Attendance::where('matapelajaran', $request->matapelajaran)
            ->where('jurusan', $request->jurusan)
            ->where('guru', $request->guru)
            ->where('tanggal', $request->tanggal)
            ->get();

        foreach ($attendance as $showattendance) {
            Attendance::where('id', $showattendance->id)
                ->update([
                    'jam' => $request->jam . ':' . rand(1,59) . ':' . rand(1, 59)
                ]);
        }

        return response()->json(['status_code' => 200]);
    }
}
