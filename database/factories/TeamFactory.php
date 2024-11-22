<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $teamName = $this->faker->unique()->word . ' Team';
        $players = [];

        for ($j = 1; $j <= 12; $j++) {
            $players[] = $this->faker->name; // Generate a random name
        }

        return [
            'name' => $teamName,
            'players' => json_encode($players), // Store players as JSON
        ];
    }
}
