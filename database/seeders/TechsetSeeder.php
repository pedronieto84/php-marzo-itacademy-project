<?php

namespace Database\Seeders;

use App\Models\Techset;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechsetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $techsets = ['html','css','ajax','php','vue', 'node'];
        foreach ($techsets as $techset) {
            Techset::create([ 'name' => $techset ]);
        }
    }
}

