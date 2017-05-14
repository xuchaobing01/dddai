<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->increments('pid')->comment('主键id');
            $table->integer('uid')->comment('用户uid');
            $table->string('name',10)->comment('用户名');
            $table->integer('money')->comment('贷款金额（分为单位）');
            $table->string('mobile',11)->comment('手机');
            $table->tinyInteger('age')->comment('年龄');
            $table->string('title',50)->comment('项目名称');
            $table->tinyInteger('rate')->comment('利率(百分比)');
            $table->tinyInteger('hrange')->comemnt('还款期限(月为单位)');
            $table->tinyInteger('status')->comment('状态:-1审核失败；0审核中；1招标中；2还款中；3结束');
            $table->integer('recive')->comment('已招标金额');
            $table->integer('pubtime')->comment('项目发布时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projects');
    }
}
