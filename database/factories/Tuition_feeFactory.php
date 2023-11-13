<?php

namespace Database\Factories;

use App\Models\Fees;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Tuition_feeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'times' => 0,
            'fee' => $this->faker->randomNumber(5), // Ví dụ về một số nguyên ngẫu nhiên có năm chữ số
            'student_id' => function () {
                return Student::factory()->create()->id; // Tạo một sinh viên và lấy id của nó
            },
            'fee_id' => function () {
                return Fees::factory()->create()->id; // Tạo một khoản phí và lấy id của nó
            },
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
