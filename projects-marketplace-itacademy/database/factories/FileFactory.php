<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $extension = ['pdf','jpg','png'][rand(0,2)];
        return [
            'project_id' => $this->faker->numberBetween(Project::all()->first()->id, Project::all()->last()->id),
            'filename' => $this->faker->word() . '.' . $extension,
            /* 'filetype' => $this->faker->mimetype(), */ // devuelve un mimetype, descartado
            'filetype' => $extension,
            'route' => 'upload/' . $this->faker->date('Y_m_d') // puede devolver por ejemplo upload/2013_03_08
        ];
    }
}
