<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTimestamp extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('equations', function(Blueprint $table)
		{
			$table->dateTime('time_started')->default(Carbon::now());
			$table->dateTime('time_finished');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Equations', function(Blueprint $table)
		{
			//
		});
	}

}
