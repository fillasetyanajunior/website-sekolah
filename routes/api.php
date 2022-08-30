<?php

use App\Http\Controllers\Api\Teacher\CodeQrApiController as CodeQr;
use App\Http\Controllers\Api\GetRegionApi;
use App\Http\Controllers\Api\Auth\Student\LoginApiController as LoginStudent;
use App\Http\Controllers\Api\Auth\Student\LogoutApiController as LogoutStudent;
use App\Http\Controllers\Api\Auth\Teacher\LoginApiController as LoginTeacher;
use App\Http\Controllers\Api\Auth\Teacher\LogoutApiController as LogoutTeacher;
use App\Http\Controllers\Api\Teacher\AttendanceApiController as AttendanceTeacher;;
use App\Http\Controllers\Api\Teacher\MaterialApiController as Material;
use App\Http\Controllers\Api\Teacher\ScheduleApiController as Schedule;
use App\Http\Controllers\Api\Teacher\TeacherApiController as Teacher;
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

Route::post('login/student', [LoginStudent::class, 'login']);
Route::post('login/teacher', [LoginTeacher::class, 'login']);

Route::prefix('student')->middleware(['auth:sanctum','student'])->group(function (){
    Route::post('logout/student', [LogoutStudent::class, 'logout']);
});

Route::prefix('teacher')->middleware(['auth:sanctum'])->group(function (){
    Route::post('logout/teacher', [LogoutTeacher::class, 'logout']);

    Route::post('qr', [CodeQr::class,'create']);
    Route::put('qr/update', [CodeQr::class,'update']);
    Route::delete('qr/delete', [CodeQr::class,'destroy']);

    Route::post('materi/show', [Material::class, 'index']);
    Route::post('materi', [Material::class, 'store']);

    Route::get('teacher', [Teacher::class,'index']);
    Route::post('teacher/showkelas', [Teacher::class,'showkelas']);
    Route::post('teacher/showjurusan', [Teacher::class, 'showjurusan']);
    Route::post('teacher/showmapel', [Teacher::class, 'showmapel']);

    Route::post('jadwal',[Schedule::class,'index']);

    Route::post('absen',[AttendanceTeacher::class,'show']);
    Route::post('absen/store', [AttendanceTeacher::class, 'absendekstop']);
    Route::post('absen/destroy/{attendance}', [AttendanceTeacher::class, 'destroy']);
});

Route::post('kabupaten/{id}', [GetRegionApi::class, 'KabupatenGetId'])->name('api.kabupaten.get');
Route::post('kecamatan/{id}', [GetRegionApi::class, 'KecamatanGetId'])->name('api.kecamatan.get');
Route::post('desa/{id}', [GetRegionApi::class, 'desaGetId'])->name('api.desa.get');
