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
            $table->increments('id');
            $table->string('username', 25);
            $table->string('password');
            $table->string('fullName', 50);
            $table->string('email', 50)->unique();
            $table->double('phone')->nullable();
            $table->string('role', 20);
            $table->string('staffID', 10)->nullable();
            $table->string('position', 25)->nullable();
            $table->integer('schoolID')->nullable();
            $table->date('dateOfBirth')->nullable();
            $table->string('occupation', 30)->nullable();
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
