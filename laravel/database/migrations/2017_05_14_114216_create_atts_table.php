<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atts', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->increments('aid')->comment('主键id ');
            $table->integer('uid')->comment('用户uid');
            $table->integer('pid')->comment('项目pid');
            $table->string('title')->comment('项目名称');
            $table->string('realname',10)->comment('真实姓名');
            $table->enum('gender',['男','女'])->comment("性别");
            $table->tinyInteger('salary')->comment('工资收入(千为单位)');
            $table->string('jobcity')->comment('工作城市');
            $table->string('udesc')->comment('用户描述');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('atts');
    }
}
