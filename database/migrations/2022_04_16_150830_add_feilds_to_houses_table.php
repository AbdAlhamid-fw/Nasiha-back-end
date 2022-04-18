<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeildsToHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('houses', function (Blueprint $table) {
            $table->text('price');
            $table->text('home_space');
            $table->text('number_of_rooms');
            $table->text('number_of_entrances');
            $table->text('cladding_status');
            $table->text('intermediary');
            $table->text('floor');
            $table->text('directione');
            $table->text('city');
            $table->text('region');
            $table->text('offer_type');
            $table->text('detailed_address');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('houses', function (Blueprint $table) {
            //
        });
    }
}
