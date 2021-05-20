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
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string("fname");
            $table->string("lname");
            $table->enum("gender", ["male", "female"])->default("male");
            $table->string("image")->nullable();
            $table->enum("type", ["admin", "customer", "designer"])->default("designer");
            $table->string("governorate")->nullable();
            $table->string("about")->nullable();
            $table->string("phone")->nullable();
            $table->string("day")->nullable();
            $table->string("month")->nullable();
            $table->string("year")->nullable();
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
