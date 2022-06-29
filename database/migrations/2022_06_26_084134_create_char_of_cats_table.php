<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharOfCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('char_of_cats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->string('tittle');
            $table->integer('numberInFilter');
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
        Schema::dropIfExists('char_of_cats');
    }
}
