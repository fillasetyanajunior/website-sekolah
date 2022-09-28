<?php

namespace Database\Seeders;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {

            Attendance::create([
                'id_siswa'      => 1,
                'nis'           => '72651380',
                'matapelajaran' => rand(1,4),
                'guru'          => 1,
                'tahun'         => 1,
                'jurusan'         => 2,
                'kelas'         => 'X',
                'semester'      => 'Ganjil',
                'tanggal'       => Carbon::now()->isoFormat('Y-M-d'),
                'jam'           => date('H:i:s'),
            ]);
        }
    }
}
