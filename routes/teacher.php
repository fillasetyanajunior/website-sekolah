<?php

use App\Http\Controllers\Auth\Teacher\LoginController as Login;
use App\Http\Controllers\Auth\Teacher\LogoutController as Logout;
use App\Http\Controllers\Teacher\AttendanceController as Attendance;
use App\Http\Controllers\Teacher\DashboardController as Dashboard;
use App\Http\Controllers\Teacher\ExtracurricularController as Extracurricular;
use App\Http\Controllers\Teacher\FinalReportController as FinalReport;
use App\Http\Controllers\Teacher\GradeController as Grade;
use App\Http\Controllers\Teacher\GradeIncreaseController as GradeIncrease;
use App\Http\Controllers\Teacher\MaterialController as Material;
use Illuminate\Support\Facades\Route;

$root = getDomain(config('app.url'));
$param = 'teacher';

Route::group([
    'domain' => 'teacher.' . $root,
    'prefix' => $param,
], function () {
    Route::get('login', [Login::class, 'form'])->name('teacher.login.form');
    Route::post('login', [Login::class, 'login'])->name('teacher.login.post');
    Route::post('logout', [Logout::class, 'logout'])->name('teacher.logout');

    Route::get('/', [Dashboard::class, 'index'])->name('teacher.dashboard');
    Route::get('profile', [Dashboard::class, 'profile'])->name('teacher.profile');

    Route::get('absen', [Attendance::class, 'index'])->name('teacher.attendance');
    Route::post('absen/studentshow', [Attendance::class, 'student'])->name('teacher.attendance.getstudent');
    Route::post('absen/store', [Attendance::class, 'store'])->name('teacher.attendance.store');
    Route::post('absen/edit/{attendance}', [Attendance::class, 'edit'])->name('teacher.attendance.edit');
    Route::post('absen/update/{attendance}', [Attendance::class, 'update'])->name('teacher.attendance.update');
    Route::delete('absen/destroy/{attendance}', [Attendance::class, 'destroy'])->name('teacher.attendance.destroy');

    Route::get('ekstra', [Extracurricular::class, 'index'])->name('teacher.extracurricular');
    Route::post('ekstra/store', [Extracurricular::class, 'store'])->name('teacher.extracurricular.store');
    Route::post('ekstra/edit/{extracurricular}', [Extracurricular::class, 'edit'])->name('teacher.extracurricular.edit');
    Route::post('ekstra/update/{extracurricular}', [Extracurricular::class, 'update'])->name('teacher.extracurricular.update');
    Route::delete('ekstra/destroy/{extracurricular}', [Extracurricular::class, 'destroy'])->name('teacher.extracurricular.destroy');

    Route::get('raport', [FinalReport::class, 'index'])->name('teacher.finalreport');
    Route::get('raport/{id}', [FinalReport::class, 'print'])->name('teacher.finalreport.print');

    Route::get('kenaikankelas', [GradeIncrease::class, 'index'])->name('teacher.gradeincrease');
    Route::post('kenaikankelas/update/{studentDetail}', [GradeIncrease::class, 'update'])->name('teacher.gradeincrease.update');
    Route::post('kenaikankelas/updateall', [GradeIncrease::class, 'update_all'])->name('teacher.gradeincrease.update_all');

    Route::get('materi', [Material::class, 'index'])->name('teacher.material');
    Route::post('materi/store', [Material::class, 'store'])->name('teacher.material.store');
    Route::post('materi/edit/{material}', [Material::class, 'edit'])->name('teacher.material.edit');
    Route::post('materi/update/{material}', [Material::class, 'update'])->name('teacher.material.update');
    Route::delete('materi/destroy/{material}', [Material::class, 'destroy'])->name('teacher.material.destroy');

    Route::get('nilai', [Grade::class, 'index'])->name('teacher.grade');
    Route::post('nilai/store', [Grade::class, 'store'])->name('teacher.grade.store');
    Route::post('nilai/edit/{grade}', [Grade::class, 'edit'])->name('teacher.grade.edit');
    Route::post('nilai/update/{grade}', [Grade::class, 'update'])->name('teacher.grade.update');
    Route::delete('nilai/destroy/{grade}', [Grade::class, 'destroy'])->name('teacher.grade.destroy');
});
