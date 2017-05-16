<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grows', function (Blueprint $table) {
            $table->increments('gid')->comment('主键gid');
            $table->integer('uid')->comment('用户uid');
            $table->integer('pid')->comment('项目pid');
            $table->string('title',60)->comment('项目名称');
            $table->integer('amount')->comment('每天利息');
            $table->date('paydate')->comment('收益日期');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('grows');
    }
}
