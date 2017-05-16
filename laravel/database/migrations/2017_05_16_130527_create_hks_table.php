<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hks', function (Blueprint $table) {
            $table->increments('hid')->comment('主键hid');
            $table->integer('uid')->comment('用户uid');
            $table->integer('pid')->comment('项目pid');
            $table->string('title',60)->comment('项目名称');
            $table->integer('amount')->comment('每月还款金额');
            $table->date('paydate')->comment('账单日');
            $table->tinyInteger('status')->comment('是否已还：0未还；1已还;');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hks');
    }
}
