<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cuisineTypes = [
            'Italian', 'Chinese', 'Mexican', 'Japanese', 'Indian',
            'Thai', 'French', 'Mediterranean', 'American', 'Greek'
        ];

        return [
            'name' => $this->faker->company() . ' ' . $this->faker->randomElement(['Restaurant', 'Bistro', 'Café', 'Eatery', 'Diner']),
            'description' => $this->faker->paragraph(),
            'cuisine_type' => $this->faker->randomElement($cuisineTypes),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'postal_code' => $this->faker->postcode(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'website' => $this->faker->url(),
            'opening_hours' => $this->faker->randomElement([
                '9:00 AM - 10:00 PM',
                '11:00 AM - 11:00 PM',
                '8:00 AM - 9:00 PM',
                '10:00 AM - 12:00 AM',
                '24 hours'
            ]),
            'rating' => $this->faker->randomFloat(1, 1, 5),
            'price_range' => $this->faker->numberBetween(1, 4),
            'featured' => $this->faker->boolean(20), // 20% chance of being featured
            'image' => 'https://via.placeholder.com/640x480.png/'.substr($this->faker->hexColor(), 1).'/ffffff?text=Restaurant',
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'delivery_available' => $this->faker->boolean(70),
            'takeout_available' => $this->faker->boolean(80),
            'reservation_available' => $this->faker->boolean(90),
        ];
    }

    /**
     * Indicate that the restaurant is featured.
     */
    public function featured()
    {
        return $this->state(function (array $attributes) {
            return [
                'featured' => true,
            ];
        });
    }

    /**
     * Indicate that the restaurant has a high rating.
     */
    public function highRated()
    {
        return $this->state(function (array $attributes) {
            return [
                'rating' => $this->faker->randomFloat(1, 4, 5),
            ];
        });
    }
}
