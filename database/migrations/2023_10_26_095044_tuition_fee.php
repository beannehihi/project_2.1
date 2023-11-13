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
        Schema::create('tuition_fees', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('times')->nullable();
            $table->integer('fee')->nullable();;
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('fee_id')->nullable();

            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('fee_id')->references('id')->on('fees');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tuition_fees');
    }
};
