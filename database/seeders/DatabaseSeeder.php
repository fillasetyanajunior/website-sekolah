<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Department;
use App\Models\Registration;
use App\Models\RegistrationDetail;
use App\Models\StudentDetail;
use App\Models\Student;
use App\Models\Subject;
use App\Models\TeacherDetail;
use App\Models\Teacher;
use App\Models\Teaching;
use App\Models\Year;
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

            $jenis          = array('Laki-laki', 'Perempuan');
            $jenis_kelamin  = array_rand($jenis,1);
            $int            = '0123456789';
            $nis            =  substr(str_shuffle($int), 0, 8);
            $kelas          = array('X', 'XI', 'XII');
            $k              = array_rand($kelas, 1);

            $id_siswa = StudentDetail::create([
                'nama'                  => 'Student ' . $i,
                'nisn'                  => '123456789012',
                'tempat_lahir'          => 'Jl. Kebon Kacang',
                'tanggal_lahir'         => '2000-01-01',
                'jenis_kelamin'         => $jenis[$jenis_kelamin],
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
                'provinsi_id'           => '51',
                'kabupaten_id'          => '5108',
                'kecamatan_id'          => '5108010',
                'desa_id'               => '5108010010',
                'dusun'                 => 'Patas',
                'rw'                    => '00',
                'rt'                    => '00',
                'alamat'                => 'Jl. Tugu Pahlawan',
                'kode_pos'              => '81155',
                'kelas'                 => $kelas[$k],
                'jurusan'               => rand(1, 2),
            ]);

            Student::create([
                'id_siswa'              => $id_siswa->id,
                'name'                  => 'Student ' . $i,
                'username'              => $nis,
                'password'              => Hash::make('students'),
                'password_encrypted'    => Crypt::encrypt('students'),
            ]);
        }

        for ($j=1; $j <= 10; $j++) {

            $id_guru = TeacherDetail::create([
                'nama'                  => 'Teacher ' . $j,
                'nuptk'                 => '123456789012',
                'alamat'                => 'Jl. Kebon Kacang',
                'nomer'                 => '08123456789',
                'email'                 => 'teacher@teacher.com',
                'lulusan'               => 'S1',
                'wali_kelas'            => 'X',
                'wali_jurusan'          => 1,
                'status'                => 'PNS',
            ]);

            for ($l=0; $l < 3; $l++) {
                $kelas = array('X', 'XI', 'XII');
                $k = array_rand($kelas, 1);

                Teaching::create([
                    'id_guru'       => $id_guru->id,
                    'kelas'         => $kelas[$k],
                    'jurusan'       => rand(1,2),
                    'matapelajaran' => rand(1,4),
                ]);
            }

            Teacher::create([
                'id_guru'               => $id_guru->id,
                'name'                  => 'Teacher ' . $j,
                'username'              => 'teacher' . $j,
                'password'              => Hash::make('teachers'),
                'password_encrypted'    => Crypt::encrypt('teachers'),
            ]);
        }

        $registrationDetail = RegistrationDetail::create([
            'nama'                  => 'Aqmar Nadhif Ramdan',
            'nisn'                  => '123456789012',
            'tempat_lahir'          => 'Batam',
            'tanggal_lahir'         => '2001-07-31',
            'jenis_kelamin'         => 'Laki-laki',
            'agama'                 => 'Islam',
            'nomer_hp'              => '08123456789',
            'email'                 => 'aqmarnadhiframdan@gmail.com',
            'nama_ibu'              => 'Ibu Student',
            'nama_bapak'            => 'Bapak Student',
            'pendidikan_ibu'        => 5,
            'pendidikan_bapak'      => 5,
            'pekerjaan_ibu'         => 64,
            'pekerjaan_bapak'       => 64,
            'penghasilan_ibu'       => 2,
            'penghasilan_bapak'     => 2,
            'pendidikan'            => 2,
            'nama_sekolah'          => 'MTs Negeri 1 Buleleng',
            'provinsi_id'           => '51',
            'kabupaten_id'          => '5108',
            'kecamatan_id'          => '5108010',
            'desa_id'               => '5108010010',
            'dusun'                 => 'Patas',
            'rw'                    => '00',
            'rt'                    => '00',
            'alamat'                => 'Jl. Tugu Pahlawan',
            'kode_pos'              => '81155',
        ]);

        Registration::create([
            'id_registration'   => $registrationDetail->id,
            'kode'              => '19874205',
            'pilihan_1'         => 98,
            'pilihan_2'         => 1,
            'info'              => 2,
            'password'          => '087926',
            'is_active'         => 'belum test',
        ]);

        Department::create([
            'kode'      => 98,
            'jurusan'   => 'IPA 1',
        ]);

        Department::create([
            'kode'      => 99,
            'jurusan'   => 'IPA 2',
        ]);

        Department::create([
            'kode'      => 1,
            'jurusan'   => 'IPS 1',
        ]);

        Department::create([
            'kode'      => 2,
            'jurusan'   => 'IPS 2',
        ]);

        Subject::create([
            'matapelajaran' => 'Fisika'
        ]);

        Subject::create([
            'matapelajaran' => 'Bahasa Indonesia'
        ]);

        Subject::create([
            'matapelajaran' => 'Matematika'
        ]);

        Subject::create([
            'matapelajaran' => 'Geografi'
        ]);

        Year::create([
            'tahun' => '2021/2022'
        ]);

        Year::create([
            'tahun' => '2022/2023'
        ]);

        $this->call([
            IndoRegionSeeder::class,
        ]);
    }
}
