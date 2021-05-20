<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
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

            $table->unsignedBigInteger("order_id")->nullable();

            $table->unsignedBigInteger("price");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("product_id");
            $table->unsignedBigInteger("customer_id");

            $table->boolean("rated")->default(false);
            $table->integer("rate")->default(0);

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
        Schema::dropIfExists('product_user');
    }
}
