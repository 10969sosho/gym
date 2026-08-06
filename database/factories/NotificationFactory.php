<?php

namespace Database\Factories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraphs(3, true),
            'category' => $this->faker->randomElement(['membership', 'payment', 'announcement', 'promotion', 'event', 'operational']),
            'publish_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
        ];
    }
}
