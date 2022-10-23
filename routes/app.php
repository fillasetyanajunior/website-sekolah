<?php

use App\Http\Controllers\Attandance\AttandanceController as Attandance;
use App\Http\Controllers\Attandance\CodeQrController  as CodeQr;
use App\Http\Controllers\Attandance\DashboardController as Dashboard;
use App\Http\Controllers\Auth\Attandance\LoginController as Login;
use Illuminate\Support\Facades\Route;

$root = getDomain(config('app.url'));
$param = 'app';

Route::group([
    'domain' => 'app.' . $root,
    'prefix' => $param,
], function () {
    Route::get('login', [Login::class, 'form'])->name('attandance.login.form');
    Route::post('login', [Login::class, 'login'])->name('attandance.login.login');

    Route::get('/', [Dashboard::class, 'index'])->name('attandance.splash');
    Route::get('dashboard/{id}', [Dashboard::class, 'dashboard'])->name('attandance.dashboard');

    Route::post('qrkode', [CodeQr::class, 'store'])->name('attandance.qrcode.store');
    Route::post('qrkode/update', [CodeQr::class, 'update'])->name('attandance.qrcode.update');
    Route::post('qrkode/destroy', [CodeQr::class, 'destroy'])->name('attandance.qrcode.destroy');

    Route::post('absen', [Attandance::class, 'absen'])->name('attandance.attandance.store');
});
