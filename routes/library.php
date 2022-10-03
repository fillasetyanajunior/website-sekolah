<?php

use App\Http\Controllers\Auth\Library\LoginController as Login;
use App\Http\Controllers\Auth\Library\LogoutController as Logout;
use App\Http\Controllers\Library\DashboardController as Dashboard;
use App\Http\Controllers\Library\LendingController as Lending;
use Illuminate\Support\Facades\Route;

$root = getDomain(config('app.url'));
$param = 'library';

Route::group([
    'domain' => 'library.' . $root,
    'prefix' => $param,
], function () {
    Route::get('login',[Login::class, 'form'])->name('library.login.form');
    Route::post('login',[Login::class, 'login'])->name('library.login.post');
    Route::post('logout', [Logout::class, 'logout'])->name('library.logout');

    Route::get('/',[Dashboard::class,'index'])->name('library.dashboard');

    Route::get('peminjaman',[Lending::class, 'index'])->name('library.lending');
    Route::post('peminjaman/store',[Lending::class, 'store'])->name('library.lending.store');
    Route::post('peminjaman/edit/{lending}',[Lending::class, 'edit'])->name('library.lending.edit');
    Route::post('peminjaman/update/{lending}',[Lending::class, 'update'])->name('library.lending.update');
    Route::delete('peminjaman/destroy/{lending}',[Lending::class, 'destroy'])->name('library.lending.destroy');
});
