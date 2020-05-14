<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objectives', function (Blueprint $table) {
            $table->increments('id');
            $table->text('question');
            $table->text('a');
            $table->text('b');
            $table->text('c')->nullable();
            $table->text('d')->nullable();
            $table->text('e')->nullable();
            $table->enum('answer', ['a','b','c','d','e']);
            $table->enum('difficulty', ['easy', 'moderate', 'hard', 'unclassified']);
            $table->integer('user_id')->unsigned();
            $table->integer('topic_id')->unsigned();
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
        Schema::dropIfExists('objectives');
    }
}
