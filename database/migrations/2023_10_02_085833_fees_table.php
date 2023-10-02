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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string('month')->nullable();
            $table->float('total_fee')->nullable();


            $table->unsignedBigInteger('schoolYear_id');
            $table->unsignedBigInteger('major_id');

            $table->foreign('schoolYear_id')->references('id')->on('schoolYears');
            $table->foreign('major_id')->references('id')->on('majors');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};