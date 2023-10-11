<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SchoolYear>
 */
class SchoolYearFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $number = 1;

        return [
            'name' => 'K' . str_pad($number++, 2, '0', STR_PAD_LEFT), // Định dạng "D01", "D02", ...
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
