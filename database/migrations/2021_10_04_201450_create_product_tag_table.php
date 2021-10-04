<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_tag', function (Blueprint $table) {

            $table->foreignId("tags_id");
            $table->foreign("tags_id")->references("id")->on("tags")->cascadeOnDelete();

            $table->foreignId("product_id");
            $table->foreign("product_id")->references("id")->on("products")->cascadeOnDelete();

            $table->primary(['tag_id','product_id']);
            
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
        Schema::dropIfExists('product_tag');
    }
}
