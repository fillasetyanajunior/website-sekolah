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
        return [
            'user_id' => Teacher::first()->id,
            'nama' => 'Teacher',
            'nuptk' => '123456789012',
            'alamat' => 'Jl. Kebon Kacang',
            'nomer' => '08123456789',
            'email' => 'teacher@teacher.com',
            'lulusan' => 'S1',
            'mapel' => 'Matematika',
            'kelas' => 'X',
            'jurusan' => 'IPA',
            'kelas_mengajar' => 'X',
            'status' => 'PNS',
        ];
    }
}
