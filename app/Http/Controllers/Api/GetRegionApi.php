<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Http\Request;

class GetRegionApi extends Controller
{
    public function KabupatenGetId(Request $request)
    {
        $kabupaten = Regency::where('province_id', $request->id)->get();
        return response()->json($kabupaten);
    }

    public function KecamatanGetId(Request $request)
    {
        $kecamatan = District::where('regency_id', $request->id)->get();
        return response()->json($kecamatan);
    }

    public function DesaGetId(Request $request)
    {
        $desa = Village::where('district_id', $request->id)->get();
        return response()->json($desa);
    }
}
