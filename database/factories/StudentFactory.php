<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\This;

class StudentFactory extends Factory
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
            'password'              => Hash::make('students'),
            'password_encrypted'    => Crypt::encrypt('students'),
        ];
    }
}
