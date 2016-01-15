<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHintsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hints', function(Blueprint $table)
		{
			$table->increments('hint_id');
			$table->string('equation', 100);
			$table->unsignedInteger('equation_id')->unsigned();
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
		Schema::drop('hints');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
