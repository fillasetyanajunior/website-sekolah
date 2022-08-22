<?php

namespace Database\Factories;

use App\Models\Teacher;
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
            'name'                  => $this->faker->name(),
            'username'              => $this->faker->userName(),
            'password'              => Hash::make('teachers'),
            'password_encrypted'    => Crypt::encrypt('teachers'),
        ];
    }
}
