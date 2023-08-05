<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
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
            'lead_name' => $this->faker->company,
            'status' => $this->faker->numberBetween(1, 3),
            'lead_company' => function () {
                // ここで関連するCustomerのIDをランダムに選択
                return Customer::inRandomOrder()->first()->customer_id;
            },
            'modified_date' => $dummyDate->format('Y-m-d'),
            'created_id' => $this->faker->numberBetween(1, 2),
            'modified_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
