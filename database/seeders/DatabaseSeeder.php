<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\Fees;
use App\Models\Major;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\Tuition_fee;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(2)->create();
        SchoolYear::factory()->count(10)->create();
        $majors = [
            ['name' => 'IT'],
            ['name' => 'Marketing'],
            ['name' => 'Quản trị mạng'],
            ['name' => 'Thiết kế đồ họa'],
        ];

        DB::table('majors')->insert($majors);
        Fees::factory()->count(10)->create();

        // Student::factory()->count(10)->create()->each(function ($student) {
        //     // Tìm một phí tồn tại hoặc tạo mới nếu không có
        //     $fee = Fees::inRandomOrder()->first() ?? factory(Fees::class)->create();

        //     $totalFee = $fee->total_fee;
        //     $scholarship = $student->scholarship ?? 0;

        //     try {
        //         Tuition_fee::factory()->create([
        //             'times' => 0,
        //             'fee' => ($totalFee - $scholarship) / 30,
        //             'student_id' => $student->id,
        //             'fee_id' => $fee->id,
        //         ]);
        //     } catch (\Exception $e) {
        //         // Log or dd() the exception message to identify the issue
        //         dd($e->getMessage());
        //     }
        // });
    }
}
