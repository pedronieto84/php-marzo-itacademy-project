<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $typeOfInstitution = ['Empresa Pública','ONG o empreses del 3er sector','Empresa Privada','Altres'][rand(0,3)];
        
        $email = $this->faker->unique()->safeEmail();
        return [
            'name' => $this->faker->name(),
            'email' => $email,
            // 'email_verified_at' => rand(0,1) ? null : now(),
            'email_verified_at' => rand(0,1) ? null : $this->faker->dateTimeBetween(new DateTime('-9 weeks'), new DateTime('-3 weeks')),
            'password' => Hash::make(strstr($email, '@', true)), // el password es el email sin el dominio
            'admin' => $this->faker->numberBetween(0,1),
            'remember_token' => Str::random(10),
            'typeOfInstitution' => $typeOfInstitution
        ];
    }
    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
