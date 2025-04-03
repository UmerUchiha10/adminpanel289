<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::all();
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'category_id' => Category::inRandomOrder()->first()->id,
            'location' => $this->faker->city(),
            'type' => $this->faker->randomElement(['Conference', 'Festival', 'Summit', 'Workshop', 'Meetup']),
            'price' => $this->faker->numberBetween(0, 5000),
            'start_date' => Carbon::now()->addDays(rand(1, 30)),
            'end_date' => Carbon::now()->addDays(rand(31, 60)),
            'max_attendees' => $this->faker->numberBetween(10, 5000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
