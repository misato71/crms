<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dummyDate = $this->faker->dateTimeThisMonth;
        
        return [
            'customer_company_name' => $this->faker->company,
            'customer_manager_name' => $this->faker->name,
            'customer_type' => $this->faker->jobTitle,
            'customer_email' => $this->faker->email,
            'customer_phone' => $this->faker->phoneNumber,
            'customer_address' => $this->faker->address,
            'our_manager' => $this->faker->numberBetween(1, 100),
            'modified_date' => $dummyDate->format('Y-m-d'),
            'created_id' => $this->faker->numberBetween(1, 2),
            'modified_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
