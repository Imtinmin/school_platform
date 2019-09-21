<?php

use Illuminate\Support\Facades\Schema;
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
            $table->bigIncrements('user_id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->dateTimeTz('signUpTime');
            $table->dateTimeTz('lastLoginTime');
            $table->decimal('score')->default(0);
            $table->string('token');
            $table->boolean('banned')->default(0);    //禁用用户
            $table->rememberToken();
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
/*
 * mysql> desc users;
+----------------+---------------------+------+-----+---------+----------------+
| Field          | Type                | Null | Key | Default | Extra          |
+----------------+---------------------+------+-----+---------+----------------+
| user_id        | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| name           | varchar(255)        | NO   | UNI | NULL    |                |
| email          | varchar(255)        | NO   | UNI | NULL    |                |
| password       | varchar(255)        | NO   |     | NULL    |                |
| signUpTime     | datetime            | NO   |     | NULL    |                |
| lastLoginTime  | datetime            | NO   |     | NULL    |                |
| score          | decimal(8,2)        | NO   |     | 0.00    |                |
| banned         | tinyint(1)          | NO   |     | 0       |                |
| remember_token | varchar(100)        | YES  |     | NULL    |                |
| admin          | tinyint(1)          | NO   |     | 0       |                |
+----------------+---------------------+------+-----+---------+----------------+

 */
