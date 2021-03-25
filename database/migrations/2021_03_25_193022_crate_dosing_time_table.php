<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrateDosingTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosing_times', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->datetime('dosing_time');
            $table->string('drug_name', 255);
            $table->text('note');
            $table->boolean('dosing_flag');
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
        Schema::dropIfExists('dosing_times');
    }
}
