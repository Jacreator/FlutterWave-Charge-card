<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $customer = Customer::factory()->create();
        return [
            'customer_id' => $customer->id,
            'amount' => $this->faker->randomFloat(2, 0, 100),
            'type' => 'card',
            'status' => $this->faker->randomElement(['pending', 'success', 'failed']),
            'reference' => $this->faker->uuid,
        ];
        
    }
}
