<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\StudentDetail;
use App\Models\Student;
use App\Models\TeacherDetail;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

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
        // Student::factory(10)->create();
        // StudentDetail::factory(10)->create();
        // Teacher::factory(10)->create();
        // TeacherDetail::factory(10)->create();
        Admin::factory(1)->create();

        for ($i=1; $i <= 10; $i++) {
            $id_siswa = Student::create([
                'name'                  => 'Student ' . $i,
                'username'              => 'student' . $i,
                'password'              => Hash::make('students'),
                'password_encrypted'    => Crypt::encrypt('students'),
            ]);

            $jenis = array('Laki-laki', 'Perempuan');
            $jenis_kelamin = array_rand($jenis,2);

            StudentDetail::create([
                'user_id'               => $id_siswa->id,
                'nama'                  => 'Student ' . $i,
                'nisn'                  => '123456789012',
                'tempat_lahir'          => 'Jl. Kebon Kacang',
                'tanggal_lahir'         => '2000-01-01',
                'jenis_kelamin'         => $jenis[$jenis_kelamin[0]],
                'agama'                 => 'Islam',
                'nomer_hp'              => '08123456789',
                'email'                 => 'students@students.com',
                'nama_ibu'              => 'Ibu Student',
                'nama_bapak'            => 'Bapak Student',
                'pendidikan_ibu'        => 1,
                'pendidikan_bapak'      => 1,
                'pekerjaan_ibu'         => 2,
                'pekerjaan_bapak'       => 2,
                'penghasilan_ibu'       => 1,
                'penghasilan_bapak'     => 1,
                'pendidikan'            => 1,
                'nama_sekolah'          => 'SMP N 1',
                'alamat'                => 'Jl. Kebon Kacang',
                'jurusan'               => 1,
            ]);
        }

        for ($j=1; $j <= 10; $j++) {
            $id_guru = Teacher::create([
                'name'                  => 'Teacher ' . $j,
                'username'              => 'teacher' . $j,
                'password'              => Hash::make('teachers'),
                'password_encrypted'    => Crypt::encrypt('teachers'),
            ]);

            TeacherDetail::create([
                'user_id'               => $id_guru->id,
                'nama'                  => 'Teacher ' . $j,
                'nuptk'                 => '123456789012',
                'alamat'                => 'Jl. Kebon Kacang',
                'nomer'                 => '08123456789',
                'email'                 => 'teacher@teacher.com',
                'lulusan'               => 'S1',
                'mapel'                 => 'Matematika',
                'kelas'                 => 'X',
                'jurusan'               => 'IPA',
                'kelas_mengajar'        => 'X',
                'status'                => 'PNS',
            ]);
        }
        $this->call([
            IndoRegionSeeder::class,
        ]);
    }
}
