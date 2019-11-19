<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelectchallengeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selectchallenge', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('option1');
            $table->string('option2');
            $table->string('option3');
            $table->string('option4');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('selectchallenge');
    }
}
