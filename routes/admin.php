<?php

use App\Http\Controllers\Admin\AchievementController as Achievement;
use App\Http\Controllers\Admin\AddScheduleController as AddSchedule;
use App\Http\Controllers\Admin\AddStudentController as AddStudent;
use App\Http\Controllers\Admin\AddTeacherController as AddTeacher;
use App\Http\Controllers\Admin\ClassroomController as Classroom;
use App\Http\Controllers\Admin\DashboardController as Dashboard;
use App\Http\Controllers\Admin\DepartmentController as Department;
use App\Http\Controllers\Admin\DeuteronomiController as Deuteronomi;
use App\Http\Controllers\Admin\ExamController as Exam;
use App\Http\Controllers\Admin\ExtracurricularController as Extracurricular;
use App\Http\Controllers\Admin\GradeController as Grade;
use App\Http\Controllers\Admin\MagazineController as Magazine;
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
$param = 'admins';

Route::group([
    'domain' => 'admin.' . $root,
    'prefix' => $param,
], function () {

    Route::get('login', [Login::class, 'form'])->name('admin.login.form');
    Route::post('login', [Login::class, 'login'])->name('admin.login.post');
    Route::post('logout', [Logout::class, 'logout'])->name('admin.logout');

    Route::get('/', [Dashboard::class, 'index'])->name('admin.dashboard');
    Route::post('testdata', [Dashboard::class, 'testdata'])->name('admin.testdata');

    Route::get('input-jadwal', [AddSchedule::class, 'index'])->name('admin.input-schedule');
    Route::post('input-jadwal', [AddSchedule::class, 'store'])->name('admin.input-schedule.store');

    Route::get('input-siswa', [AddStudent::class, 'index'])->name('admin.input-student');
    Route::post('input-siswa', [AddStudent::class, 'store'])->name('admin.input-student.store');
    Route::delete('input-siswa/{studentDetail}', [AddStudent::class, 'destroy'])->name('admin.input-student.destroy');

    Route::get('input-guru', [AddTeacher::class, 'index'])->name('admin.input-teacher');
    Route::post('input-guru', [AddTeacher::class, 'store'])->name('admin.input-teacher.store');
    Route::post('input-guru/pengajaran', [AddTeacher::class, 'teaching'])->name('admin.input-teacher.teaching');
    Route::delete('input-guru/{teacherDetail}', [AddTeacher::class, 'destroy'])->name('admin.input-teacher.destroy');

    Route::get('ruangkelas', [Classroom::class, 'index'])->name('admin.classroom');
    Route::post('ruangkelas/store', [Classroom::class, 'store'])->name('admin.classroom.store');
    Route::post('ruangkelas/edit/{classroom}', [Classroom::class, 'edit'])->name('admin.classroom.edit');
    Route::post('ruangkelas/update/{classroom}', [Classroom::class, 'update'])->name('admin.classroom.update');
    Route::delete('ruangkelas/destroy/{classroom}', [Classroom::class, 'destroy'])->name('admin.classroom.destroy');

    Route::get('majalah', [Magazine::class, 'index'])->name('admin.magazine');
    Route::post('majalah/store', [Magazine::class, 'store'])->name('admin.magazine.store');
    Route::post('majalah/edit/{magazine}', [Magazine::class, 'edit'])->name('admin.magazine.edit');
    Route::post('majalah/update/{magazine}', [Magazine::class, 'update'])->name('admin.magazine.update');
    Route::delete('majalah/destroy/{magazine}', [Magazine::class, 'destroy'])->name('admin.magazine.destroy');

    Route::get('prestasi', [Achievement::class, 'index'])->name('admin.achievement');
    Route::post('prestasi/store', [Achievement::class, 'store'])->name('admin.achievement.store');
    Route::post('prestasi/edit/{achievement}', [Achievement::class, 'edit'])->name('admin.achievement.edit');
    Route::post('prestasi/update/{achievement}', [Achievement::class, 'update'])->name('admin.achievement.update');
    Route::delete('prestasi/destroy/{achievement}', [Achievement::class, 'destroy'])->name('admin.achievement.destroy');

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
    Route::post('siswa/show', [Student::class, 'show'])->name('admin.student.show');
    Route::post('siswa/update/{student}', [Student::class, 'update'])->name('admin.student.update');
    Route::delete('siswa/destroy/{student}', [Student::class, 'destroy'])->name('admin.student.destroy');

    Route::get('guru', [Teacher::class,'index'])->name('admin.teacher');
    Route::post('guru/store', [Teacher::class, 'store'])->name('admin.teacher.store');
    Route::post('guru/edit/{teacher}', [Teacher::class, 'edit'])->name('admin.teacher.edit');
    Route::post('guru/show', [Teacher::class, 'show'])->name('admin.teacher.show');
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
