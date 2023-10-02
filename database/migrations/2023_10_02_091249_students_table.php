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
            $table->text('img')->nullable();
            $table->string('name');
            $table->date('date_of_birth')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('location')->nullable();
            $table->boolean('status')->default(false);

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('major_id');
            $table->unsignedBigInteger('tuition_fee_id');
            $table->timestamps();

            // Định nghĩa các khóa ngoại
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('major_id')->references('id')->on('majors');
            $table->foreign('tuition_fee_id')->references('id')->on('tuition_fees');
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
