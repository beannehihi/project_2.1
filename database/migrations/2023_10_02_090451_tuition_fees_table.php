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
            $table->float('fee_payment')->nullable();
            $table->float('fee_in_one')->nullable();
            $table->float('total_fee_debt')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('fee_id');
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
