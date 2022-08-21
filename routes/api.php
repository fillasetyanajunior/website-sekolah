<?php

use App\Http\Controllers\Api\GetRegionApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('kabupaten/{id}', [GetRegionApi::class, 'KabupatenGetId'])->name('api.kabupaten.get');
Route::post('kecamatan/{id}', [GetRegionApi::class, 'KecamatanGetId'])->name('api.kecamatan.get');
Route::post('desa/{id}', [GetRegionApi::class, 'desaGetId'])->name('api.desa.get');
