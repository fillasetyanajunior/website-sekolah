<?php

namespace Database\Seeders;

use App\Models\Registration;
use App\Models\RegistrationDetail;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 500; $i++) {
            $min = strtotime('2021-01-01');
            $max = strtotime('2024-01-01');
            $val = rand($min, $max);
            $jenis          = ['Laki-laki', 'Perempuan'];
            $jenis_kelamin  = array_rand($jenis, 1);

            $registrationDetail = RegistrationDetail::create([
                'nama'                  => 'Aqmar Nadhif Ramdan ' . $i,
                'nisn'                  => '123456789012',
                'nik'                   => '123456789012',
                'nik_ibu'               => '123456789012',
                'nik_bapak'             => '123456789012',
                'tempat_lahir'          => 'Batam',
                'tanggal_lahir'         => '2001-07-31',
                'jenis_kelamin'         => $jenis[$jenis_kelamin],
                'agama'                 => 'Islam',
                'nomer_hp_siswa'        => '08123456789',
                'nomer_hp_wali'         => '08123456789',
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
                'created_at'            => date("Y-m-d H:i:s", $val),
                'updated_at'            => date("Y-m-d H:i:s", $val),
            ]);

            Registration::create([
                'id_registration'   => $registrationDetail->id,
                'kode'              => '19874205',
                // 'pilihan_1'         => 98,
                // 'pilihan_2'         => 1,
                'info'              => 2,
                'password'          => '087926',
                'is_active'         => 'belum test',
            ]);
        }
    }
}
