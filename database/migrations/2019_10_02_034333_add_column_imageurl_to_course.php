<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnImageurlToCourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            //
            $table->string('image_url');    //课程列表图片
            $table->integer('course_category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()  //rollback
    {
        Schema::table('courses', function (Blueprint $table) {
            //
            $table->dropColumn('image_url');
            $table->dropColumn('course_category_id');
        });
    }
}
