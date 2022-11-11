<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Registration;
use App\Models\RegistrationDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
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
            // 'pilihan_1'         => 98,
            // 'pilihan_2'         => 1,
            'info'              => 2,
            'password'          => '087926',
            'is_active'         => 'belum test',
        ]);
        DB::table('departments')->insert([
            ['jurusan' => 'IPA 1'],
            ['jurusan' => 'IPA 2'],
            ['jurusan' => 'IPS 1'],
            ['jurusan' => 'IPS 2'],
            ['jurusan' => 'IPB'],
            ['jurusan' => 'AGAMA'],
        ]);
        // DB::table('subjects')->insert([
        //     ['matapelajaran' => 'Fisika'],
        //     ['matapelajaran' => 'Bahasa Indonesia'],
        //     ['matapelajaran' => 'Matematika'],
        //     ['matapelajaran' => 'Geografi']
        // ]);
        DB::table('years')->insert([
            ['tahun' => '2021/2022','semester' => 'Ganjil'],
            ['tahun' => '2021/2022','semester' => 'Genap'],
            ['tahun' => '2022/2023','semester' => 'Ganjil'],
            ['tahun' => '2022/2023','semester' => 'Genap'],
        ]);
        DB::table('employments')->insert([
            ['nama'  => 'BELUM/TIDAK BEKERJA'],
            ['nama'  => 'MENGURUS RUMAH TANGGA'],
            ['nama'  => 'PELAJAR/MAHASISWA'],
            ['nama'  => 'PENSIUNAN'],
            ['nama'  => 'PEGAWAI NEGERI SIPIL'],
            ['nama'  => 'TENTARA NASIONAL INDONESIA'],
            ['nama'  => 'KEPOLISIAN RI'],
            ['nama'  => 'PERDAGANGAN'],
            ['nama'  => 'PETANI/PEKEBUN'],
            ['nama'  => 'PETERNAK'],
            ['nama'  => 'NELAYAN/PERIKANAN'],
            ['nama'  => 'INDUSTRI'],
            ['nama'  => 'KONSTRUKSI'],
            ['nama'  => 'TRANSPORTASI'],
            ['nama'  => 'KARYAWAN SWASTA'],
            ['nama'  => 'KARYAWAN BUMN'],
            ['nama'  => 'KARYAWAN BUMD'],
            ['nama'  => 'KARYAWAN HONORER'],
            ['nama'  => 'BURUH HARIAN LEPAS'],
            ['nama'  => 'BURUH TANI/PERKEBUNAN'],
            ['nama'  => 'BURUH NELAYAN/PERIKANAN'],
            ['nama'  => 'BURUH PETERNAKAN'],
            ['nama'  => 'PEMBANTU RUMAH TANGGA'],
            ['nama'  => 'TUKANG CUKUR'],
            ['nama'  => 'TUKANG LISTRIK'],
            ['nama'  => 'TUKANG BATU'],
            ['nama'  => 'TUKANG KAYU'],
            ['nama'  => 'TUKANG SOL SEPATU'],
            ['nama'  => 'TUKANG LAS/PANDAI BESI'],
            ['nama'  => 'TUKANG JAHIT'],
            ['nama'  => 'TUKANG GIGI'],
            ['nama'  => 'PENATA RIAS'],
            ['nama'  => 'PENATA BUSANA'],
            ['nama'  => 'PENATA RAMBUT'],
            ['nama'  => 'MEKANIK'],
            ['nama'  => 'SENIMAN'],
            ['nama'  => 'TABIB'],
            ['nama'  => 'PARAJI'],
            ['nama'  => 'PERANCANG BUSANA'],
            ['nama'  => 'PENTERJEMAH'],
            ['nama'  => 'IMAM MESJID'],
            ['nama'  => 'PENDETA'],
            ['nama'  => 'PASTOR'],
            ['nama'  => 'WARTAWAN'],
            ['nama'  => 'USTADZ/MUBALIGH'],
            ['nama'  => 'JURU MASAK'],
            ['nama'  => 'PROMOTOR ACARA'],
            ['nama'  => 'ANGGOTA DPR-RI'],
            ['nama'  => 'ANGGOTA DPD'],
            ['nama'  => 'ANGGOTA BPK'],
            ['nama'  => 'PRESIDEN'],
            ['nama'  => 'WAKIL PRESIDEN'],
            ['nama'  => 'ANGGOTA MAHKAMAH KONSTITUSI'],
            ['nama'  => 'ANGGOTA KABINET/KEMENTERIAN'],
            ['nama'  => 'DUTA BESAR'],
            ['nama'  => 'GUBERNUR'],
            ['nama'  => 'WAKIL GUBERNUR'],
            ['nama'  => 'BUPATI'],
            ['nama'  => 'WAKIL BUPATI'],
            ['nama'  => 'WALIKOTA'],
            ['nama'  => 'WAKIL WALIKOTA'],
            ['nama'  => 'ANGGOTA DPRD PROVINSI'],
            ['nama'  => 'ANGGOTA DPRD KABUPATEN/KOTA'],
            ['nama'  => 'DOSEN'],
            ['nama'  => 'GURU'],
            ['nama'  => 'PILOT'],
            ['nama'  => 'PENGACARA'],
            ['nama'  => 'NOTARIS'],
            ['nama'  => 'ARSITEK'],
            ['nama'  => 'AKUNTAN'],
            ['nama'  => 'KONSULTAN'],
            ['nama'  => 'DOKTER'],
            ['nama'  => 'BIDAN'],
            ['nama'  => 'PERAWAT'],
            ['nama'  => 'APOTEKER'],
            ['nama'  => 'PSIKIATER/PSIKOLOG'],
            ['nama'  => 'PENYIAR TELEVISI'],
            ['nama'  => 'PENYIAR RADIO'],
            ['nama'  => 'PELAUT'],
            ['nama'  => 'PENELITI'],
            ['nama'  => 'SOPIR'],
            ['nama'  => 'PIALANG'],
            ['nama'  => 'PARANORMAL'],
            ['nama'  => 'PEDAGANG'],
            ['nama'  => 'PERANGKAT DESA'],
            ['nama'  => 'KEPALA DESA'],
            ['nama'  => 'BIARAWATI'],
            ['nama'  => 'WIRASWASTA'],
            ['nama'  => 'LAINNYA'],
        ]);
        $this->call([
            IndoRegionSeeder::class,
            // StudentSeeder::class,
            // TeacherSeeder::class,
            // AttendanceSeeder::class,
        ]);
    }
}
