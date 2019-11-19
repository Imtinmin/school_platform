<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCtfachieveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ctfachieve', function (Blueprint $table) {
            $table->Increments('ctfachieve_id');
            $table->integer('user_id');
            $table->integer('qid');
            $table->dateTimeTz('AchieveTime');
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
        Schema::dropIfExists('ctfachieve');
    }
}
