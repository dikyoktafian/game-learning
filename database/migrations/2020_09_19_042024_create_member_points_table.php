<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMemberPointsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id');
            $table->string('model_type');
            $table->integer('model_id');
            $table->integer('point')->integer(5)->default(20);
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
        Schema::drop('member_points');
    }
}
