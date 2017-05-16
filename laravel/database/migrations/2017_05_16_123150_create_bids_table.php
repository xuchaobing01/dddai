<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->increments('bid')->comment('id号');
            $table->integer('uid')->comment('用户uid');
            $table->integer('pid')->comment('项目pid');
            $table->string('title',60)->comment('项目名称');
            $table->integer('amount')->comment('投资金额');
            $table->integer('pubtime')->comment('投标时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bids');
    }
}
