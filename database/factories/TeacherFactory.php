<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Teacher',
            'username' => 'teachers',
            'password' => Hash::make('teachers'),
            'password_encrypted' => Crypt::encrypt('teachers'),
        ];
    }
}
