<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValueOfCharsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('value_of_chars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('char')
                ->references('id')
                ->on('char_of_cats')
                ->onDelete('cascade');
            $table->string('value');
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
        Schema::dropIfExists('value_of_chars');
    }
}
