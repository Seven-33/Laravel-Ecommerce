<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();

            $table->string("title");
            $table->string("address");
            $table->string("cellphone");
            $table->string("postal_code");
            $table->string("longitude")->nullable();
            $table->string("latitude")->nullable();

            $table->foreignId("user_id");
            $table->foreign("user_id")->references("id")->on("users")->cascadeOnDelete();

            $table->unsignedBigInteger("province_id");
            $table->unsignedBigInteger("city_id");

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
        Schema::dropIfExists('user_addresses');
    }
}
