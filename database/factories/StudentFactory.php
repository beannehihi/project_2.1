<?php

namespace Database\Factories;

use App\Models\Classes;
use App\Models\Fees;
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
        $faker = \Faker\Factory::create('vi_VN'); // Sử dụng ngôn ngữ tiếng Việt

        $studentCode = 'BKC-' . mt_rand(1000, 9999);

        // Hàm để đảm bảo scholarship là số tròn không lẻ
        $evenScholarship = function () use ($faker) {
            return $faker->numberBetween(0, 10000000) * 2;
        };

        return [
            'student_code' => $studentCode,
            'name' => $faker->name,
            'date_of_birth' => $faker->date,
            'phone' => $faker->phoneNumber, // Số điện thoại Việt Nam
            'email' => $faker->unique()->safeEmail,
            'password' => bcrypt($studentCode),
            'location' => $faker->address, // Địa chỉ Việt Nam
            'scholarship' => $evenScholarship(),
            'gender' => $faker->randomElement(['0', '1']),
            'role' => '3',
            'user_id' => User::inRandomOrder()->first()->id,
            'fee_id' => Fees::inRandomOrder()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
