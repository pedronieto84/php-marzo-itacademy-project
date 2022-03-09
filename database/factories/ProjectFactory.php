<?php

namespace Database\Factories;

use App\Models\User;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $state = ['accepted','published','refused','doing','finished'][rand(0,4)];

        return [
            'user_id' => $this->faker->numberBetween(User::all()->first()->id, User::all()->last()->id),
            'title' => ucwords ( str_replace('.','',$this->faker->sentence(2)) . ' Project' ),
            'publishedDate' => $this->faker->dateTimeBetween(new DateTime('+3 weeks'), new DateTime('+6 weeks')),
            'deadline' => $this->faker->dateTimeBetween(new DateTime('+8 weeks'), new DateTime('+21 weeks')),
            'shortExplanation' => $this->faker->paragraph(2,false),
            'state' => $state,
            'bid' => $this->faker->randomFloat(2,1000,100000)
        ];
    }
}
