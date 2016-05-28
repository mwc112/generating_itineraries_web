<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
						$table->dateTime('start_date_time');
						$table->string('hotel', 256);
						$table->json('waypoints');
						$table->json('times_to_stay');
						$table->json('route');
						$table->string('transport_method', 256);
						$table->unsignedInteger('creator');
            $table->timestamps();
        });

				Schema::table('trips', function ($table) {
						$table->foreign('creator')->references('id')->on('users');
				});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('trips');
    }
}
