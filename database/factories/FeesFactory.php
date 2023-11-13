<?php

namespace Database\Factories;

use App\Models\Major;
use App\Models\SchoolYear;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fees>
 */
class FeesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'month' => 1,
            'total_fee' => $this->faker->numberBetween(1, 10) * 100000000, // Giới hạn 'total_fee' trong khoảng từ 1.000.000 đến 10.000.000
            'schoolYear_id' => function () {
                return SchoolYear::inRandomOrder()->first()->id;
            },
            'major_id' => function () {
                return Major::inRandomOrder()->first()->id;
            },
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
