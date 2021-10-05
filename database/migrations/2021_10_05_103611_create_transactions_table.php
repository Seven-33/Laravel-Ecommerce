<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger("amount");
            $table->string("ref_id")->nullable();
            $table->string("token")->nullable();
            $table->text("description")->nullable();
            $table->enum("gateway_name",["zarinpal", "pay"]);
            $table->tinyInteger("status")->default(0);

            $table->foreignId("user_id");
            $table->foreign("user_id")->references("id")->on("users")->cascadeOnDelete();

            $table->foreignId("order_id");
            $table->foreign("order_id")->references("id")->on("orders")->cascadeOnDelete();

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
        Schema::dropIfExists('transactions');
    }
}
