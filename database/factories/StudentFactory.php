<?php

namespace Database\Factories;

use App\Models\Classes;
use App\Models\Major;
use App\Models\SchoolYear;
use App\Models\Tuition_fee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {



        $studentCode = 'BKC-' . mt_rand(1000, 9999);
        return [
            'student_code' => $studentCode, // Mã sinh viên ngẫu nhiên từ 1000 đến 9999
            'name' => $this->faker->name,
            'date_of_birth' => $this->faker->date,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $studentCode, // Mật khẩu mẫu
            'location' => $this->faker->address,
            'scholarship' => $this->faker->numberBetween(1, 100) * 1000000,
            'gender' => $this->faker->randomElement(['0', '1']), // Giới tính ngẫu nhiên
            'role' => '3', // Vai trò mặc định
            'user_id' => User::inRandomOrder()->first()->id,
            'major_id' => null,
            'schoolYear_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
