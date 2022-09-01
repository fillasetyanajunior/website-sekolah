<?php

use App\Http\Controllers\Admin\DashboardController as Dashboard;
use App\Http\Controllers\Admin\DepartmentController as Department;
use App\Http\Controllers\Admin\DeuteronomiController as Deuteronomi;
use App\Http\Controllers\Admin\ExamController as Exam;
use App\Http\Controllers\Admin\ExtracurricularController as Extracurricular;
use App\Http\Controllers\Admin\GradeController as Grade;
use App\Http\Controllers\Admin\MaterialController as Material;
use App\Http\Controllers\Admin\NewsController as News;
use App\Http\Controllers\Admin\RegistrationController as Registration;
use App\Http\Controllers\Admin\ScheduleController as Schedule;
use App\Http\Controllers\Admin\StudentController as Student;
use App\Http\Controllers\Admin\SubjectController as Subject;
use App\Http\Controllers\Admin\TeacherController as Teacher;
use App\Http\Controllers\Admin\YearController as Year;
use App\Http\Controllers\Auth\Admin\LoginController as Login;
use App\Http\Controllers\Auth\Admin\LogoutController as Logout;
use Illuminate\Support\Facades\Route;

$root = getDomain(config('app.url'));
$param = 'admin';

Route::group([
    'domain' => 'admin.' . $root,
    'prefix' => $param,
], function () {
    Route::get('login', [Login::class, 'form'])->name('admin.login.form');
    Route::post('login', [Login::class, 'login'])->name('admin.login.post');
    Route::post('logout', [Logout::class, 'logout'])->name('admin.logout');

    Route::get('/', [Dashboard::class, 'index'])->name('admin.dashboard');

    Route::get('ujian', [Exam::class, 'index'])->name('admin.exam');
    Route::post('ujian/store', [Exam::class, 'store'])->name('admin.exam.store');
    Route::post('ujian/edit/{exam}', [Exam::class, 'edit'])->name('admin.exam.edit');
    Route::post('ujian/update/{exam}', [Exam::class, 'update'])->name('admin.exam.update');
    Route::delete('ujian/destroy/{exam}', [Exam::class, 'destroy'])->name('admin.exam.destroy');

    Route::get('informasi', [News::class, 'index'])->name('admin.news');
    Route::post('informasi/store', [News::class, 'store'])->name('admin.news.store');
    Route::post('informasi/edit/{news}', [News::class, 'edit'])->name('admin.news.edit');
    Route::post('informasi/update/{news}', [News::class, 'update'])->name('admin.news.update');
    Route::delete('informasi/destroy/{news}', [News::class, 'destroy'])->name('admin.news.destroy');

    Route::get('ekstra', [Extracurricular::class, 'index'])->name('admin.extracurricular');
    Route::post('ekstra/store', [Extracurricular::class, 'store'])->name('admin.extracurricular.store');
    Route::post('ekstra/edit/{extracurricular}', [Extracurricular::class, 'edit'])->name('admin.extracurricular.edit');
    Route::post('ekstra/update/{extracurricular}', [Extracurricular::class, 'update'])->name('admin.extracurricular.update');
    Route::delete('ekstra/destroy/{extracurricular}', [Extracurricular::class, 'destroy'])->name('admin.extracurricular.destroy');

    Route::get('materi', [Material::class, 'index'])->name('admin.material');
    Route::post('materi/store', [Material::class, 'store'])->name('admin.material.store');
    Route::post('materi/edit/{material}', [Material::class, 'edit'])->name('admin.material.edit');
    Route::post('materi/update/{material}', [Material::class, 'update'])->name('admin.material.update');
    Route::delete('materi/destroy/{material}', [Material::class, 'destroy'])->name('admin.material.destroy');

    Route::get('nilai', [Grade::class, 'index'])->name('admin.grade');
    Route::post('nilai/store', [Grade::class, 'store'])->name('admin.grade.store');
    Route::post('nilai/edit/{grade}', [Grade::class, 'edit'])->name('admin.grade.edit');
    Route::post('nilai/update/{grade}', [Grade::class, 'update'])->name('admin.grade.update');
    Route::delete('nilai/destroy/{grade}', [Grade::class, 'destroy'])->name('admin.grade.destroy');

    Route::get('pendaftaran', [Registration::class,'index'])->name('admin.registration');
    Route::post('pendaftaran/edit/{registration}', [Registration::class, 'edit'])->name('admin.registration.edit');
    Route::post('pendaftaran/update/{registration}', [Registration::class, 'update'])->name('admin.registration.update');

    Route::get('siswa', [Student::class,'index'])->name('admin.student');
    Route::post('siswa/store', [Student::class, 'store'])->name('admin.student.store');
    Route::post('siswa/edit/{student}', [Student::class, 'edit'])->name('admin.student.edit');
    Route::post('siswa/update/{student}', [Student::class, 'update'])->name('admin.student.update');
    Route::delete('siswa/destroy/{student}', [Student::class, 'destroy'])->name('admin.student.destroy');

    Route::get('guru', [Teacher::class,'index'])->name('admin.teacher');
    Route::post('guru/store', [Teacher::class, 'store'])->name('admin.teacher.store');
    Route::post('guru/edit/{teacher}', [Teacher::class, 'edit'])->name('admin.teacher.edit');
    Route::post('guru/update/{teacher}', [Teacher::class, 'update'])->name('admin.teacher.update');
    Route::delete('guru/destroy/{teacher}', [Teacher::class, 'destroy'])->name('admin.teacher.destroy');

    Route::get('jadwal', [Schedule::class,'index'])->name('admin.schedule');
    Route::post('jadwal/store', [Schedule::class, 'store'])->name('admin.schedule.store');
    Route::post('jadwal/edit/{schedule}', [Schedule::class, 'edit'])->name('admin.schedule.edit');
    Route::post('jadwal/update/{schedule}', [Schedule::class, 'update'])->name('admin.schedule.update');
    Route::delete('jadwal/destroy/{schedule}', [Schedule::class, 'destroy'])->name('admin.schedule.destroy');

    Route::get('ulangan', [Deuteronomi::class,'index'])->name('admin.deuteronomi');
    Route::post('ulangan/store', [Deuteronomi::class, 'store'])->name('admin.deuteronomi.store');
    Route::post('ulangan/edit/{deuteronomi}', [Deuteronomi::class, 'edit'])->name('admin.deuteronomi.edit');
    Route::post('ulangan/update/{deuteronomi}', [Deuteronomi::class, 'update'])->name('admin.deuteronomi.update');
    Route::delete('ulangan/destroy/{deuteronomi}', [Deuteronomi::class, 'destroy'])->name('admin.deuteronomi.destroy');

    Route::get('jurusan', [Department::class,'index'])->name('admin.department');
    Route::post('jurusan/store', [Department::class, 'store'])->name('admin.department.store');
    Route::post('jurusan/edit/{department}', [Department::class, 'edit'])->name('admin.department.edit');
    Route::post('jurusan/update/{department}', [Department::class, 'update'])->name('admin.department.update');
    Route::delete('jurusan/destroy/{department}', [Department::class, 'destroy'])->name('admin.department.destroy');

    Route::get('matapelajaran', [Subject::class, 'index'])->name('admin.subject');
    Route::post('matapelajaran/store', [Subject::class, 'store'])->name('admin.subject.store');
    Route::post('matapelajaran/edit/{subject}', [Subject::class, 'edit'])->name('admin.subject.edit');
    Route::post('matapelajaran/update/{subject}', [Subject::class, 'update'])->name('admin.subject.update');
    Route::delete('matapelajaran/destroy/{subject}', [Subject::class, 'destroy'])->name('admin.subject.destroy');

    Route::get('tahunpelajaran', [Year::class, 'index'])->name('admin.year');
    Route::post('tahunpelajaran/store', [Year::class, 'store'])->name('admin.year.store');
    Route::post('tahunpelajaran/edit/{year}', [Year::class, 'edit'])->name('admin.year.edit');
    Route::post('tahunpelajaran/update/{year}', [Year::class, 'update'])->name('admin.year.update');
    Route::delete('tahunpelajaran/destroy/{year}', [Year::class, 'destroy'])->name('admin.year.destroy');
});
