<?php

namespace Database\Seeders;


use App\Models\Employer;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::truncate();
        User::factory(17)->create();

        Employer::truncate();
        Employer::factory(5)->create();

        $this->call(JobSeeder::class);
    }
}
