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
			$table->string('student_number', 20);
			$table->string('equation', 20);
			$table->integer('correct')->unsigned();
			$table->integer('wrong')->unsigned();
			$table->integer('hints_used')->unsigned();

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
		Schema::drop('logs');
	}

}
