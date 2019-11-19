<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToSelectchallenge extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('selectchallenge', function (Blueprint $table) {
            $table->string('answer')->after('option4');
            $table->string('is_multiple')->after('answer')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('selectchallenge', function (Blueprint $table) {
            //
            $table->dropColumn('answer');
            $table->dropColumn('is_multiple');
        });
    }
}
