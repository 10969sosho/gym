<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'member_id' => \App\Models\Member::factory(),
            'invoice_number' => 'INV' . str_pad($this->faker->unique()->numberBetween(1, 99999), 5, '0', STR_PAD_LEFT),
            'transaction_date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'membership_period' => $this->faker->randomElement(['1 Month', '3 Months', '6 Months', '12 Months']),
            'amount' => $this->faker->randomElement([150000, 300000, 500000, 750000, 1000000, 1500000]),
            'payment_status' => $this->faker->randomElement(['pending', 'paid', 'overdue']),
            'invoice_file' => null,
        ];
    }
}
