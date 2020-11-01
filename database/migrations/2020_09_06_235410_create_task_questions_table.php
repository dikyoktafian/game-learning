<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaskQuestionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id')->length(11);
            $table->string('image')->length(100)->nullable();
            $table->string('attach')->length(100)->nullable();
            $table->string('question')->length(150);
            $table->integer('point')->length(150);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('task_questions');
    }
}
