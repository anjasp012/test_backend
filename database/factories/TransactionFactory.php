<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "TransactionDate" => now(),
            "Description" => $this->faker->sentence(),
            "DebitCreditStatus" => "C",
            "Amount" => rand(5000, 100000)
        ];
    }
}
