<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->increments('uid')->comment('主键id');
            $table->string('name')->comment('用户名');
            $table->string('email')->unique()->comment('点子邮箱');
            $table->string('password', 60)->comment('密码');
            $table->string('mobile',11)->comment("手机号");
            $table->rememberToken()->comment('记住密码');
            $table->integer('regtime')->comment('注册时间');
            $table->integer('lastlogin')->comment('上次登录时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
