<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('category_id');
            $table->float('price');
            $table->string('image');
            $table->enum('has_offer', ['yes','no'])->default('no');
            $table->enum('is_top', ['yes','no'])->default('no');
            $table->enum('status', ['active','inactive'])->default('active');
            $table->float('offer_price')->nullable();
            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('restrict');
            $table->string('slug');
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
