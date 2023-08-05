<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
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
            'staff_name' => $this->faker->name,
            'staff_email' => $this->faker->email,
            'staff_phone' => $this->faker->phoneNumber,
            'staff_department' => $this->faker->jobTitle,
            'modified_date' => $dummyDate->format('Y-m-d'),
            'created_id' => $this->faker->numberBetween(1, 2),
            'modified_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
