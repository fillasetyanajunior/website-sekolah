<?php

use App\Http\Controllers\Attendance\AttendanceController as Attendance;
use App\Http\Controllers\Attendance\CodeQrController  as CodeQr;
use App\Http\Controllers\Attendance\DashboardController as Dashboard;
use App\Http\Controllers\Auth\Attendance\LoginController as Login;
use App\Http\Controllers\Auth\Attendance\LogoutController as Logout;
use Illuminate\Support\Facades\Route;

$root = getDomain(config('app.url'));
$param = 'app';

Route::group([
    'domain' => 'app.' . $root,
    'prefix' => $param,
], function () {
    Route::get('login', [Login::class, 'form'])->name('attendance.login.form');
    Route::post('login', [Login::class, 'login'])->name('attendance.login.login');
    Route::post('logout', [Logout::class, 'logout'])->name('attendance.logout');

    Route::get('/', [Dashboard::class, 'index'])->name('attendance.splash');
    Route::get('dashboard/{id}', [Dashboard::class, 'dashboard'])->name('attendance.dashboard');

    Route::post('qrkode', [CodeQr::class, 'store'])->name('attendance.qrcode.store');
    Route::post('qrkode/update', [CodeQr::class, 'update'])->name('attendance.qrcode.update');
    Route::post('qrkode/destroy', [CodeQr::class, 'destroy'])->name('attendance.qrcode.destroy');

    Route::post('absen', [Attendance::class, 'absen'])->name('attendance.attendance.store');
    Route::post('absenall', [Attendance::class, 'absenall'])->name('attendance.attendance.storeall');
    Route::post('absen/edit', [Attendance::class, 'edit'])->name('attendance.attendance.edit');
    Route::post('absen/update', [Attendance::class, 'update'])->name('attendance.attendance.update');
});
