<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->integer("price")->nullable();
            $table->string("status");
            $table->text("description");

            $table->unsignedBigInteger("customer_id");
            $table->unsignedBigInteger("designer_id");
            $table->unsignedBigInteger("product_id");
            $table->unsignedBigInteger("order_id");
            $table->unsignedBigInteger("shipping_id")->nullable();
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
        Schema::dropIfExists('requests');
    }
}
