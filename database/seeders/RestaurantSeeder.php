<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 20 random restaurants
        Restaurant::factory()->count(20)->create();

        // Create 5 featured restaurants
        Restaurant::factory()->featured()->count(5)->create();

        // Create 10 high-rated restaurants
        Restaurant::factory()->highRated()->count(10)->create();

        // Create some restaurants with specific cuisine types
        $cuisines = ['Italian', 'Chinese', 'Mexican', 'Japanese', 'Indian'];
        foreach ($cuisines as $cuisine) {
            Restaurant::factory()->count(3)->create([
                'cuisine_type' => $cuisine,
            ]);
        }
    }
}
