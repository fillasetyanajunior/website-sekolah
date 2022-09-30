<?php

use App\Http\Controllers\Home\RegistrationController as Registration;
use App\Http\Controllers\HomeController as Home;
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

Route::get('/', [Home::class,'index'])->name('home');
Route::get('/guru-dan-pegawai',[Home::class,'teacher'])->name('home.teacher');
Route::get('/siswa',[Home::class,'student'])->name('home.student');
Route::get('/news-utama/{id}',[Home::class,'news'])->name('home.newsmain');
Route::get('/info/{id}',[Home::class,'news'])->name('home.info');

Route::get('/pendaftaran', [Registration::class,'index'])->name('regisration');
Route::post('/pendaftaran', [Registration::class,'store'])->name('regisration.store');
