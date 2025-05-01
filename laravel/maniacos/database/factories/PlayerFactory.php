<?php

namespace Database\Factories;

use app\Enums\Category;
use App\Models\Player;
use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'birthdate' => $this->faker->dateTimeBetween('-30 years', '-15 years')->format('Y-m-d'),
            'category' => $this->faker->randomElement(Category::cases())->value,
            'height' => $this->faker->numberBetween(160, 200),
            'weight' => $this->faker->numberBetween(55, 90),
            'isSuspended' => $this->faker->boolean(10),
        ];
    }

    public function withPositions()
    {
        return $this->afterCreating(function (Player $player) {
           $positions = Position::whereIn('id', range(1, 5))
               ->inRandomOrder()
               ->limit(rand(1, 2))
               ->get();

           $player->positions()->attach($positions);
        });
    }
}
