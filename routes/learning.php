<?php

use App\Http\Controllers\Auth\Learning\Student\LoginController as LoginStudent;
use App\Http\Controllers\Auth\Learning\Student\LogoutController as LogoutStudent;
use App\Http\Controllers\Auth\Learning\Teacher\LoginController as LoginTeacher;
use App\Http\Controllers\Auth\Learning\Teacher\LogoutController as LogoutTeacher;
use App\Http\Controllers\Learning\Student\ClassController as ClassroomStudent;
use App\Http\Controllers\Learning\Student\ContentController as ContentStudent;
use App\Http\Controllers\Learning\Student\DashboardController as DashboardStudent;
use App\Http\Controllers\Learning\Teacher\ClassController as ClassroomTeacher;
use App\Http\Controllers\Learning\Teacher\ContentController as ContentTeacher;
use App\Http\Controllers\Learning\Teacher\DashboardController as DashboardTeacher;
use App\Models\Classroom;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

$root = getDomain(config('app.url'));
$param = 'learning';

Route::group([
    'domain' => 'learning.' . $root,
    'prefix' => $param,
], function () {

    //Student
    Route::group(['prefix' => 'student'],function (){
        Route::get('login', [LoginStudent::class,'form'])->name('learning.student.login.form');
        Route::post('login',[LoginStudent::class,'login'])->name('learning.student.login.post');
        Route::post('logout',[LogoutStudent::class,'logout'])->name('learning.student.logout');

        Route::get('/',[DashboardStudent::class,'index'])->name('learning.student.dashboard');

        $class = Classroom::all();
        foreach ($class as $showclass) {
            Route::get(Str::lower($showclass->nama) . '/{id}', [ClassroomStudent::class,'index'])->name('learning.student.' . Str::lower($showclass->nama));
        }

        Route::get('content/{id}',[ContentStudent::class, 'index'])->name('learning.student.content');
        Route::post('content/store',[ContentStudent::class, 'store'])->name('learning.student.content.store');
        Route::post('content/submit/{id}',[ContentStudent::class, 'submit'])->name('learning.student.content.submit');
        Route::post('content/unsubmit/{id}',[ContentStudent::class, 'unsubmit'])->name('learning.student.content.unsubmit');
        Route::post('content/destroy/{title}',[ContentStudent::class, 'destroy'])->name('learning.student.content.destroy');
    });

    Route::group(['prefix' => 'teacher'], function (){
        Route::get('login', [LoginTeacher::class, 'form'])->name('learning.teacher.login.form');
        Route::post('login',[LoginTeacher::class, 'login'])->name('learning.teacher.login.post');
        Route::post('logout',[LogoutTeacher::class, 'logout'])->name('learning.teacher.logout');

        Route::get('/',[DashboardTeacher::class, 'index'])->name('learning.teacher.dashboard');

        $class = Classroom::all();
        foreach ($class as $showclass) {
            Route::get(Str::lower($showclass->nama) . '/{id}', [ClassroomTeacher::class, 'index'])->name('learning.teacher.' . Str::lower($showclass->nama));
        }

        Route::get('content/{id}', [ContentTeacher::class, 'index'])->name('learning.teacher.content');
        Route::post('content/store', [ContentTeacher::class, 'store'])->name('learning.teacher.content.store');
        Route::get('content/show/{id}', [ContentTeacher::class, 'show'])->name('learning.teacher.content.show');
        Route::post('content/edit/{content}', [ContentTeacher::class, 'edit'])->name('learning.teacher.content.edit');
        Route::post('content/update/{content}', [ContentTeacher::class, 'update'])->name('learning.teacher.content.update');
        Route::delete('content/destroy/{content}', [ContentTeacher::class, 'destroy'])->name('learning.teacher.content.destroy');
    });
});

