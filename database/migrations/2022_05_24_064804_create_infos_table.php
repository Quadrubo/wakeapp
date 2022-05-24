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
            $table->float("residence_longitude", 9, 6);
            $table->float("residence_latitude", 8, 6);
            $table->float("destination_longitude", 9, 6);
            $table->float("destination_latitude", 8, 6);
            $table->string("transport_type");

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
