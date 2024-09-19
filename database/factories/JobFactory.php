<?php

namespace Database\Factories;

use App\Models\Employer;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employer_id'=>Employer::inRandomOrder()->first()->id,
            'title' => fake()->jobTitle(),
            'salary' => fake()->numberBetween(5000,100000)-(fake()->numberBetween(5000,10000)%100)
        ];
    }

    public function salary(): static
    {
        return $this->state(fn(array $attributes)=>[
        'salary'=>10000,
        ]);
    }
}

