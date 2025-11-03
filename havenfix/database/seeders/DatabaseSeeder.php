<?php

namespace Database\Seeders;

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
        User::factory(3)->create();

        // User::factory(3)->create([
        //     'first_name' => fake()->firstName(),
        //     'last_name'=>fake()->lastName(),
        //     'email' => fake()->email(),
        //     'password' => fake()->password()
        // ]);
    }
}
