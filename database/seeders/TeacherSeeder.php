<?php

namespace Database\Seeders;

use App\Models\StudentDetail;
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
        for ($j = 1; $j <= 100; $j++) {

            $jabatan    = ['Kepala Sekolah', 'Waka Humas', 'Waka Kurikulum', 'Waka Sapras', 'Waka Kesiswaan', 'KTU', 'Pramubakti', 'Bendahara', 'Guru'];
            $y          = array_rand($jabatan, 1);

            $status     = ['PNS', 'Non PNS'];
            $i          = array_rand($status, 1);

            $walikelas  = array('X', 'XI', 'XII');
            $wk         = array_rand($walikelas, 1);

            $databagian_kelas = StudentDetail::groupBy('no_kelas')->having('no_kelas', '!=', 'null')->get('no_kelas');

            $no_kelas = [];
            foreach ($databagian_kelas as $show_bagian_kelas) {
                $no_kelas[] = $show_bagian_kelas->no_kelas;
            }
            $nks = array_rand($no_kelas, 1);

            if ($walikelas[$wk] == 'X') {
                $id_guru = TeacherDetail::create([
                    'nama'          => 'Teacher ' . $j,
                    'nuptk'         => '123456789012',
                    'alamat'        => 'Jl. Kebon Kacang',
                    'nomer'         => '08123456789',
                    'email'         => 'teacher@teacher.com',
                    'lulusan'       => 'S1',
                    'wali_kelas'    => $walikelas[$wk],
                    'wali_no_kelas' => $no_kelas[$nks],
                    'status'        => $status[$i],
                    'jabatan'       => $jabatan[$y],
                ]);
            } else {
                $id_guru = TeacherDetail::create([
                    'nama'          => 'Teacher ' . $j,
                    'nuptk'         => '123456789012',
                    'alamat'        => 'Jl. Kebon Kacang',
                    'nomer'         => '08123456789',
                    'email'         => 'teacher@teacher.com',
                    'lulusan'       => 'S1',
                    'wali_kelas'    => $walikelas[$wk],
                    'wali_jurusan'  => rand(1, 4),
                    'status'        => $status[$i],
                    'jabatan'       => $jabatan[$y],
                ]);
            }


            for ($l = 0; $l < 8; $l++) {
                $kelas          = array('X', 'XI', 'XII');
                $k              = array_rand($kelas, 1);
                $jurusan        = rand(1,4);
                $matapelajaran  = rand(1,4);
                $data2          = Teaching::where('kelas', $kelas[$k])->where('jurusan', $jurusan)->where('matapelajaran', $matapelajaran)->first();
                $databagian_kelas2 = StudentDetail::groupBy('no_kelas')->having('no_kelas', '!=', 'null')->get('no_kelas');

                $no_kelas2 = [];
                foreach ($databagian_kelas2 as $show_bagian_kelas2) {
                    $no_kelas2[] = $show_bagian_kelas2->no_kelas;
                }
                $nks2 = array_rand($no_kelas2, 1);

                if ($kelas[$k] == 'X') {
                    if ($data2 == null) {
                        Teaching::create([
                            'id_guru'       => $id_guru->id,
                            'kelas'         => $kelas[$k],
                            'no_kelas'      => $no_kelas2[$nks2],
                            'matapelajaran' => $matapelajaran,
                        ]);
                    }
                } else {
                    if ($data2 == null) {
                        Teaching::create([
                            'id_guru'       => $id_guru->id,
                            'kelas'         => $kelas[$k],
                            'jurusan'       => $jurusan,
                            'matapelajaran' => $matapelajaran,
                        ]);
                    }
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
