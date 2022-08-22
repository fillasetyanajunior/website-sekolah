<?php

namespace Database\Factories;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $student = Student::first();
        if ($student == null) {
            $id_siswa = 1;
        } else {
            $id_siswa = Student::orderBy('id', 'DESC')->first()->id + 1;
        }

        return [
            'user_id'               => $id_siswa,
            'nama'                  => $this->faker->name(),
            'nisn'                  => '123456789012',
            'tempat_lahir'          => 'Jl. Kebon Kacang',
            'tanggal_lahir'         => '2000-01-01',
            'jenis_kelamin'         => 'Laki-laki',
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
        ];
    }
}
