<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("path");
            // Sizes
            $table->integer("s")->default(0);
            $table->integer("m")->default(0);
            $table->integer("l")->default(0);
            $table->integer("xl")->default(0);
            $table->integer("xxl")->default(0);
            $table->integer("more")->default(0);
            
            $table->string("color")->nullable();
            $table->string("color_name")->nullable();
            
            $table->integer("rate_value")->default(0);
            $table->integer("rate_number")->default(1); // For math error


            // Foreig keys
            $table->unsignedBigInteger("post_id");
            $table->foreign("post_id")->references("id")->on("posts")->onDelete("CASCADE");
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
