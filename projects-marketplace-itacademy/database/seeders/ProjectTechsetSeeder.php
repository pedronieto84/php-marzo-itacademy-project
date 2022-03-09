<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectTechset;
use App\Models\Techset;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProjectTechsetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        ProjectTechset::factory()
            ->count(50)
            ->create();
        */

        $this->faker = Faker::create();
        for($c=1; $c<=50; $c++) {
            ProjectTechset::firstOrCreate(
                [
                    'project_id' => $this->faker->numberBetween(Project::all()->first()->id, Project::all()->last()->id),
                    'techset_id' => $this->faker->numberBetween(Techset::all()->first()->id, Techset::all()->last()->id)
                ]
            );
        }            

    }
}
