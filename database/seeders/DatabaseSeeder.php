<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\StudentDetail;
use App\Models\Student;
use App\Models\TeacherDetail;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Student::factory(1)->create();
        StudentDetail::factory(1)->create();
        Teacher::factory(1)->create();
        TeacherDetail::factory(1)->create();
        Admin::factory(1)->create();
    }
}
