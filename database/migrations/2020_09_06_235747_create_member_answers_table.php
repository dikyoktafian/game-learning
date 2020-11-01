<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMemberAnswersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_task_id')->length(11);
            $table->integer('question_id')->length(11);
            $table->integer('answer_id')->length(11);
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
        Schema::drop('member_answers');
    }
}
