<?php

namespace Database\Factories;

use App\Models\Employer;
use App\Models\User;

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
            'device_model' => fake()->randomElement([
                'Dell XPS 13',
                'MacBook Pro 16',
                'HP Spectre x360',
                'Lenovo ThinkPad X1 Carbon',
                'Microsoft Surface Laptop 4',
                'Acer Aspire 5',
                'ASUS ROG Zephyrus G14',
                'MacBook Air M1',
                'HP Envy 13',
                'Razer Blade 15',
                'Lenovo Yoga 9i',
                'Samsung Galaxy Book Pro',
                'Alienware m15',
                'LG Gram 17',
                'Dell Inspiron 15',
                'ASUS VivoBook S15'
            ]),
            'issue' => fake()->randomElement([
                'Computer won’t start',
                'Blue screen error',
                'Internet connection issues',
                'Application crashing frequently',
                'Slow performance',
                'Overheating issues',
                'Unresponsive touchscreen',
                'Battery drains quickly',
                'Keyboard not working',
                'Screen flickering',
                'Audio issues',
                'Virus or malware infection',
                'Cannot connect to printer',
                'Software update failed',
                'External drive not recognized'
            ]),
            'user_id'=>User::inRandomOrder()->first()->id,
            
        ];
        
    }
}

