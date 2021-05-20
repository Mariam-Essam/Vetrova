<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text("description");
            $table->unsignedInteger("price");
            $table->boolean("active")->default(0);
            // Address data
            $table->string("governorate");
            $table->string("street");
            $table->string("address");
            $table->string("house_number")->nullable();
            $table->string("phone1");
            $table->string("phone2")->nullable();
            // Foreign key
            $table->unsignedBigInteger("category_id")->nullable();
            // $table->foreign("category_id")->references("id")->on("categories");
            $table->unsignedBigInteger("type_id")->nullable();
            // $table->foreign("type_id")->references("id")->on("types");
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users");
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
        Schema::dropIfExists('products');
    }
}
