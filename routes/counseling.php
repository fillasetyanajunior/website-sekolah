<?php

use App\Http\Controllers\Auth\Counselingguidance\LoginController as Login;
use App\Http\Controllers\Auth\Counselingguidance\LogoutController as Logout;
use App\Http\Controllers\Counselingguidance\AttendanceController as Attendance;
use App\Http\Controllers\Counselingguidance\DashboardController as Dashboard;
use App\Http\Controllers\Counselingguidance\OffenseController as Offense;
use Illuminate\Support\Facades\Route;

$root = getDomain(config('app.url'));
$param = 'counseling';

Route::group([
    'domain' => 'counseling.' . $root,
    'prefix' => $param,
], function () {
    Route::get('login', [Login::class, 'form'])->name('counseling.login.form');
    Route::post('login', [Login::class, 'login'])->name('counseling.login.post');
    Route::post('logout', [Logout::class, 'logout'])->name('counseling.logout');

    Route::get('/', [Dashboard::class, 'index'])->name('counseling.dashboard');

    Route::get('absen', [Attendance::class, 'index'])->name('counseling.attendance');
    Route::post('absen', [Attendance::class, 'store'])->name('counseling.attendance.store');
    Route::post('absen/edit/{attendanceCounseling}', [Attendance::class, 'edit'])->name('counseling.attendance.edit');
    Route::post('absen/update/{attendanceCounseling}', [Attendance::class, 'update'])->name('counseling.attendance.update');
    Route::delete('absen/destroy/{attendanceCounseling}', [Attendance::class, 'destroy'])->name('counseling.attendance.destroy');

    Route::get('pelanggaran', [Offense::class, 'index'])->name('counseling.offense');
    Route::post('pelanggaran', [Offense::class, 'store'])->name('counseling.offense.store');
    Route::post('pelanggaran/edit/{studentOffence}', [Offense::class, 'edit'])->name('counseling.offense.edit');
    Route::post('pelanggaran/update/{studentOffence}', [Offense::class, 'update'])->name('counseling.offense.update');
    Route::delete('pelanggaran/destroy/{studentOffence}', [Offense::class, 'destroy'])->name('counseling.offense.destroy');
});
