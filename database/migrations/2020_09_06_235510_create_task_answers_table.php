<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaskAnswersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id')->length(100);
            $table->string('answer')->length(191);
            $table->enum('label', ['a', 'b', 'c', 'd']);
            $table->boolean('correct')->default(false)->nullable();
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
        Schema::drop('task_answers');
    }
}
