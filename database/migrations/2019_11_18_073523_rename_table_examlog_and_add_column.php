<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTableExamlogAndAddColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::rename("examlog", "examlogs");
        Schema::table('examlogs', function (Blueprint $table) {
            //
            $table->integer('score')->after('correct_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('examlogs', function (Blueprint $table) {
            //
            $table->dropColumn('score');
        });
        Schema::rename("examlogs", "examlog");
    }
}
