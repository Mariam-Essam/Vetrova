<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("fname");
            $table->string("lname");
            $table->string("governorate");
            $table->string("street");
            $table->string("address");
            $table->string("house_number")->nullable();
            $table->string("phone1")->nullable();
            $table->string("phone2")->nullable();
            $table->integer("shipping");
            $table->boolean("completed")->default(false);
            $table->dateTime('start_at')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();

            // Paypal
            $table->unsignedInteger("payment_id")->nullable();

            $table->unsignedBigInteger("user_id");
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
        Schema::dropIfExists('orders');
    }
}
