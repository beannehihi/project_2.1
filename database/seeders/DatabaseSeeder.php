<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\Major;
use App\Models\SchoolYear;
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
        Classes::factory()->count(10)->create();
        Major::factory()->count(10)->create();
    }
}
