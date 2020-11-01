<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMemberTasksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->length('11');
            $table->integer('task_id')->length('11');
            $table->enum('status', ['done', 'progress']);
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
        Schema::drop('member_tasks');
    }
}
