<?php

namespace Database\Factories;

use App\Models\Insurence;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Insured>
 */
class InsuredFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kk_label' => fake()->randomElement(Insurence::pluck('kk_label')),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'kvnumber' => strtoupper(fake()->randomLetter()) . fake()->randomNumber(9),
            'birthdate' => fake()->dateTimeBetween('-100 years')->format('Y-m-d'),
        ];
    }
}
