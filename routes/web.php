<?php

use App\Http\Controllers\CobaController;
use App\Http\Controllers\Home\RegistrationController as Registration;
use App\Http\Controllers\Home\HomeController as Home;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/coba', [CobaController::class,'coba']);
Route::get('/', [Home::class, 'index'])->name('home');
Route::get('/guru-dan-pegawai',[Home::class, 'teacher'])->name('home.teacher');
Route::get('/siswa',[Home::class, 'student'])->name('home.student');
Route::get('/news-utama/{id}',[Home::class, 'news'])->name('home.newsmain');
Route::get('/info/{id}',[Home::class, 'info'])->name('home.info');
Route::get('/prestasi-siswa',[Home::class, 'achievement'])->name('home.achievement');
Route::get('/majalah-madani',[Home::class, 'magazine'])->name('home.magazine');

Route::get('/pendaftaran', [Registration::class, 'index'])->name('regisration');
Route::post('/pendaftaran', [Registration::class, 'store'])->name('regisration.store');
