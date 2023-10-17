<?php

namespace Database\Factories;

use App\Models\Classes;
use App\Models\Major;
use App\Models\Tuition_fee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'img' => $this->faker->imageUrl(), // Thay thế bằng đường dẫn thực tế đến hình ảnh (nếu có)
            'name' => $this->faker->name,
            'date_of_birth' => $this->faker->date,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // Thay 'password' bằng mật khẩu mặc định nếu cần
            'email_verified_at' => now(),
            'location' => $this->faker->address,
            'gender' => $this->faker->randomElement([0, 1]), // 0: Nam, 1: Nữ
            'role' => 3, // Mặc định là 3
            'user_id' => User::inRandomOrder()->first()->id,
            'class_id' => Classes::inRandomOrder()->first()->id,
            'major_id' => Major::inRandomOrder()->first()->id,
            // 'tuition_fee_id' => Tuition_fee::inRandomOrder()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
