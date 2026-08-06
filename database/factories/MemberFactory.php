<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 year', 'now');
        $expiredDate = (clone $startDate)->modify('+1 year');
        $status = $expiredDate < new \DateTime() ? 'expired' : 'active';

        return [
            'member_id' => 'GYM' . str_pad($this->faker->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
            'name' => $this->faker->name(),
            'whatsapp' => '628' . $this->faker->unique()->numerify('##########'),
            'photo' => null,
            'membership_package' => $this->faker->randomElement(['Basic', 'Standard', 'Premium', 'VIP']),
            'start_date' => $startDate->format('Y-m-d'),
            'expired_date' => $expiredDate->format('Y-m-d'),
            'status' => $status,
            'qr_code' => null,
        ];
    }
}
