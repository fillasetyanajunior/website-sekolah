<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $teacher = Teacher::first();
        if ($teacher == null) {
            $id_guru = 1;
        } else {
            $id_guru = Teacher::orderBy('id', 'DESC')->first()->id + 1;
        }

        return [
            'user_id'               => $id_guru,
            'nama'                  => $this->faker->name(),
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
        ];
    }
}
