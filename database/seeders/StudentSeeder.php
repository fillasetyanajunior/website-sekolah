<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\StudentDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 500; $i++) {

            $jenis          = array('Laki-laki', 'Perempuan');
            $jenis_kelamin  = array_rand($jenis, 1);
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
    }
}
