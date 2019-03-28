<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalculatedPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculated_positions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('network_id')->unsigned();
            $table->foreign('network_id')->references('id')->on('networks');
            $table->decimal('lat', 10, 8)->unsigned();
            $table->decimal('lng', 11, 8)->unsigned();
            $table->decimal('size', 5, 3)->unsigned();
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
        Schema::table('calculated_positions', function (Blueprint $table) {
            $table->dropForeign(['network_id']);
        });
        Schema::dropIfExists('calculated_positions');
    }
}
