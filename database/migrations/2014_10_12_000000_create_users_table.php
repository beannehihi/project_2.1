<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->text('img')->nullable();
            $table->string('name');
            $table->date('date');
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('location')->nullable();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->text('about')->nullable();
            $table->smallInteger('role')->default('2');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
