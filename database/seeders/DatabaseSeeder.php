<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\Fees;
use App\Models\Major;
use App\Models\SchoolYear;
use App\Models\Student;
use Illuminate\Database\Seeder;
use App\Models\User;


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
        Major::factory()->count(20)->create();
        Fees::factory()->count(10)->create();
        // Student::factory()->count(50)->create();
    }
}
