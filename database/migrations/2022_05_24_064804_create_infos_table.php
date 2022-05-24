<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->time("eta");
            $table->string("time_to_get_up");
            $table->string("residence_longitude");
            $table->string("residence_latitude");
            $table->string("destination_longitude");
            $table->string("destination_latitude");
            $table->string("");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infos');
    }
};
