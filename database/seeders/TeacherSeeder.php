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

            $datakelas  = StudentDetail::groupBy('kelas')->get('kelas');
            $walikelas  = [];
            foreach ($datakelas as $showkelas) {
                $walikelas[] = $showkelas->kelas;
            }
            $wk = array_rand($walikelas, 1);

            if ($walikelas[$wk] == 'X') {
                $databagian_kelas = StudentDetail::groupBy('no_kelas')->having('no_kelas', '!=', 'null')->get('no_kelas');

                $no_kelas = [];
                foreach ($databagian_kelas as $show_bagian_kelas) {
                    $no_kelas[] = $show_bagian_kelas->no_kelas;
                }
                $nks = array_rand($no_kelas, 1);
            } else {
                $datajurusan = StudentDetail::groupBy('jurusan')->having('jurusan', '!=', 'null')->get('jurusan');

                $jurusan = [];
                foreach ($datajurusan as $show_jurusan) {
                    $jurusan[] = $show_jurusan->jurusan;
                }
                $jrs = array_rand($jurusan, 1);
            }

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
                    'wali_jurusan'  => $jurusan[$jrs],
                    'status'        => $status[$i],
                    'jabatan'       => $jabatan[$y],
                ]);
            }

            for ($l = 0; $l < 8; $l++) {
                $datakelas2  = StudentDetail::groupBy('kelas')->get('kelas');
                $kelas  = [];
                foreach ($datakelas2 as $showkelas) {
                    $kelas[] = $showkelas->kelas;
                }
                $k = array_rand($kelas, 1);
                $matapelajaran  = rand(1,4);

                if ($kelas[$k] == 'X') {
                    $databagian_kelas2  = StudentDetail::groupBy('no_kelas')->having('no_kelas', '!=', 'null')->get('no_kelas');
                    $no_kelas2          = [];

                    foreach ($databagian_kelas2 as $show_bagian_kelas2) {
                        $no_kelas2[] = $show_bagian_kelas2->no_kelas;
                    }

                    $nks2   = array_rand($no_kelas2, 1);
                    $data2  = Teaching::where('id_guru', $id_guru->id)->where('kelas', $kelas[$k])->where('no_kelas', $no_kelas2[$nks2])->where('matapelajaran', $matapelajaran)->first();

                    if ($data2 == null) {
                        Teaching::create([
                            'id_guru'       => $id_guru->id,
                            'kelas'         => $kelas[$k],
                            'no_kelas'      => $no_kelas2[$nks2],
                            'matapelajaran' => $matapelajaran,
                        ]);
                    }
                } else {
                    $datajurusan2   = StudentDetail::groupBy('jurusan')->having('jurusan', '!=', 'null')->get('jurusan');
                    $jurusan2       = [];

                    foreach ($datajurusan2 as $show_jurusan2) {
                        $jurusan2[] = $show_jurusan2->jurusan;
                    }

                    $jrs2   = array_rand($jurusan2, 1);
                    $data2  = Teaching::where('id_guru', $id_guru->id)->where('kelas', $kelas[$k])->where('jurusan', $jurusan2[$jrs2])->where('matapelajaran', $matapelajaran)->first();

                    if ($data2 == null) {
                        Teaching::create([
                            'id_guru'       => $id_guru->id,
                            'kelas'         => $kelas[$k],
                            'jurusan'       => $jurusan2[$jrs2],
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
