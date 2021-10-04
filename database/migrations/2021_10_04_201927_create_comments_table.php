<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->foreignId("user_id");
            $table->foreign("user_id")->references("id")->on("users")->cascadeOnDelete();

            $table->foreignId("product_id");
            $table->foreign("product_id")->references("id")->on("products")->cascadeOnDelete();

            $table->boolean("approved")->default(0)->comment("0:not_1:approved");
            $table->text("text");

            $table->softDeletes();
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
        Schema::dropIfExists('comments');
    }
}
