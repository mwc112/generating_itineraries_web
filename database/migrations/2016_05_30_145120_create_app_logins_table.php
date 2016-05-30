<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_logins', function (Blueprint $table) {
            $table->increments('id');
						$table->integer('user_id')->unsigned();
						$table->string('app_id', 255);
						$table->string('key', 255);
						$table->timestamp('valid_until');
            $table->timestamps();
        });

				Schema::table('app_logins', function(Blueprint $table) {
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
        Schema::drop('app_logins');
    }
}
