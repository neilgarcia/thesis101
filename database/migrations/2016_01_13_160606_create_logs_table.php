<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logs', function(Blueprint $table)
		{
			$table->increments('log_id')->unsigned();
			$table->unsignedInteger('equation_id');
			$table->string('equation', 20);
			$table->string('status', 20);
			$table->string('emotion', 20);
			$table->timestamps();

			$table->foreign('equation_id')
						->references('equation_id')
						->on('equations')
						->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::drop('logs');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
