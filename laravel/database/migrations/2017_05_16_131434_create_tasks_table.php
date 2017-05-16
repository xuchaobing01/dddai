<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('tid')->comment('主键tid');
            $table->integer('uid')->comment('用户uid');
            $table->integer('pid')->comment('项目pid');
            $table->string('title',60)->comment('项目名称');
            $table->integer('amount')->comment('每日利息');
            $table->date('enddate')->comment('收利息截止日');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tasks');
    }
}
