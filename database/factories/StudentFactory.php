<?php

namespace Database\Factories;

use App\Models\Classes;
use App\Models\Major;
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
            'img' => $this->faker->imageUrl(), // URL hình ảnh ngẫu nhiên
            'name' => $this->faker->name,
            'date_of_birth' => $this->faker->date,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('$studentCode'), // Mật khẩu mẫu
            'location' => $this->faker->address,
            'gender' => $this->faker->randomElement(['0', '1']), // Giới tính ngẫu nhiên
            'role' => '3', // Vai trò mặc định
            'user_id' => User::inRandomOrder()->first()->id,
            'class_id' => Classes::inRandomOrder()->first()->id,
            'major_id' => Major::inRandomOrder()->first()->id,
            // 'tuition_fee_id' => Tuition_fee::inRandomOrder()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
