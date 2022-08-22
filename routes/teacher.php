<?php

use App\Http\Controllers\Auth\Teacher\LoginController as Login;
use App\Http\Controllers\Auth\Teacher\LogoutController as Logout;
use App\Http\Controllers\Teacher\DashboardController as Dashboard;
use App\Http\Controllers\Teacher\GradeController as Grade;
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
