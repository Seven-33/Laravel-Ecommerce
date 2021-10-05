<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();

            $table->string("name");
            $table->string("code");
            $table->enum("type",["amount", "percentage"]);
            $table->unsignedBigInteger("amount")->nullable();
            $table->unsignedBigInteger("percantage")->nullable();
            $table->unsignedBigInteger("max_percantage_amount")->nullable();
            $table->timestamp("expired_at");
            $table->text("description")->nullable();

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
        Schema::dropIfExists('coupons');
    }
}
