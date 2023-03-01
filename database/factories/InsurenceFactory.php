<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Insurence>
 */
class InsurenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->company();
        return [
            'name' => strtoupper(preg_split("/[\s,_]+/", $name)[0]),
            'full_name' => $name,
            'kk_label' => fake()->randomFloat(4, 5000, 9999),
        ];
    }
}
