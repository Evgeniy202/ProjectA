<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharOfProdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('char_of_prods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('char')->references('id')->on('char_of_cats');
            $table->foreignId('value')->references('id')->on('value_of_chars');
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
        Schema::dropIfExists('char_of_prods');
    }
}
