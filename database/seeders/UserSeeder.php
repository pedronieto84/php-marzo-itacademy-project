<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(10)
            ->create();
            $typeOfInstitution = ['Empresa Pública','ONG o empreses del 3er sector','Empresa Privada','Altres'][rand(0,3)];        
            $faker = Factory::create();
            $email = $faker->unique()->safeEmail();
            User::create ([
                'name' => $faker->name(),
                'email' => 'admin@example.org',
                'email_verified_at' => $faker->dateTimeBetween(new DateTime('-9 weeks'), new DateTime('-3 weeks')),
                'password' => Hash::make('adm123'), // el password es el email sin el dominio
                'admin' => true,
                'remember_token' => Str::random(10),
                'typeOfInstitution' => $typeOfInstitution
            ]);            
            User::create ([
                'name' => $faker->name(),
                'email' => 'noadmin@example.org',
                'email_verified_at' => $faker->dateTimeBetween(new DateTime('-9 weeks'), new DateTime('-3 weeks')),
                'password' => Hash::make('adm123'), // el password es el email sin el dominio
                'admin' => false,
                'remember_token' => Str::random(10),
                'typeOfInstitution' => $typeOfInstitution
            ]);            
    }
}

