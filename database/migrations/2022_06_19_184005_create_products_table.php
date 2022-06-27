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
            $table->foreignId('category')->references('id')->on('categories');
            $table->string('tittle');
            $table->string('slug');
            $table->string('description');
            $table->decimal('price');
            $table->boolean('isAvailable');
            $table->boolean('isFavorite');
            $table->string('mainImage');
            $table->string('img_1')->nullable();
            $table->string('img_2')->nullable();
            $table->string('img_3')->nullable();
            $table->string('img_4')->nullable();
            $table->string('img_5')->nullable();
            $table->string('img_6')->nullable();
            $table->string('img_7')->nullable();
            $table->string('img_8')->nullable();
            $table->string('img_9')->nullable();
            $table->string('img_10')->nullable();
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
