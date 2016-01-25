<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('equations', function(Blueprint $table)
		{
			$table->increments('equation_id');
			$table->string('equation', 100);
			$table->string('student_number', 20);
			$table->string('status', 20)->default('abandoned');
			$table->timestamps();

			$table->foreign('student_number')
					->references('student_number')
					->on('students')
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
		Schema::drop('equations');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
