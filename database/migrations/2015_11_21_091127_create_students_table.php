<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students', function(Blueprint $table)
		{
			$table->string('student_number', 20);
			$table->string('first_name', 100);
			$table->string('last_name', 100);
			$table->timestamps();

			$table->primary('student_number');

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
		Schema::drop('students');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
