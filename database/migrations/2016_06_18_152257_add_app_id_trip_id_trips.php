<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAppIdTripIdTrips extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trips', function ($table) {

					$table->integer('app_trip_id')->unsigned();
					$table->string('app_id', 255);

				});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trips', function ($table) {

					$table->dropColumn('app_id');
					$table->dropColumn('app_trip_id');

				});
    }
}
