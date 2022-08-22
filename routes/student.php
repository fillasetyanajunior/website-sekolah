<?php

use App\Http\Controllers\Auth\Student\LoginController as Login;
use App\Http\Controllers\Auth\Student\LogoutController as Logout;
use App\Http\Controllers\Student\DashboardController as Dashboard;
use Illuminate\Support\Facades\Route;

$root = getDomain(config('app.url'));
$param = 'student';

Route::group([
    'domain' => 'student.' . $root,
    'prefix' => $param,
], function () {
    Route::get('login', [Login::class, 'form'])->name('student.login.form');
    Route::post('login', [Login::class, 'login'])->name('student.login.post');
    Route::post('logout', [Logout::class, 'logout'])->name('student.logout');

    Route::get('/', [Dashboard::class, 'index'])->name('student.dashboard');
});
