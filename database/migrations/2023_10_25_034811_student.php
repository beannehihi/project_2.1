<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_code')->nullable();
            $table->string('name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('location')->nullable();
            $table->string('scholarship')->nullable();
            $table->smallInteger('gender')->nullable();
            $table->smallInteger('role')->default('3');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('schoolYear_id')->nullable();
            $table->unsignedBigInteger('major_id')->nullable();

            $table->timestamps();

            // Định nghĩa các khóa ngoại
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('major_id')->references('id')->on('majors')->nullable();
            $table->foreign('schoolYear_id')->references('id')->on('school_years')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
