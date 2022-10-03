<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\TeacherDetail;
use App\Models\Teaching;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($j = 1; $j <= 10; $j++) {

            $jabatan    = ['Kepala Sekolah', 'Waka Humas', 'Waka Kurikulum', 'Waka Sapras', 'Waka Kesiswaan', 'KTU', 'Pramubakti', 'Bendahara', 'Guru'];
            $y          = array_rand($jabatan, 1);

            $status     = ['PNS', 'Non PNS'];
            $i          = array_rand($status, 1);

            $id_guru = TeacherDetail::create([
                'nama'          => 'Teacher ' . $j,
                'nuptk'         => '123456789012',
                'alamat'        => 'Jl. Kebon Kacang',
                'nomer'         => '08123456789',
                'email'         => 'teacher@teacher.com',
                'lulusan'       => 'S1',
                'wali_kelas'    => 'X',
                'wali_jurusan'  => 1,
                'status'        => $status[$i],
                'jabatan'       => $jabatan[$y],
            ]);

            for ($l = 0; $l < 8; $l++) {
                $kelas          = array('X', 'XI', 'XII');
                $k              = array_rand($kelas, 1);
                $jurusan        = rand(1,4);
                $matapelajaran  = rand(1,4);
                $data2          = Teaching::where('kelas', $kelas[$k])->where('jurusan', $jurusan)->where('matapelajaran', $matapelajaran)->first();

                if ($data2 == null) {
                    Teaching::create([
                        'id_guru'       => $id_guru->id,
                        'kelas'         => $kelas[$k],
                        'jurusan'       => $jurusan,
                        'matapelajaran' => $matapelajaran,
                    ]);
                }
            }

            Teacher::create([
                'id_guru'               => $id_guru->id,
                'name'                  => 'Teacher ' . $j,
                'username'              => 'teacher' . $j,
                'password'              => Hash::make('teachers'),
                'password_encrypted'    => Crypt::encrypt('teachers'),
            ]);
        }
    }
}
