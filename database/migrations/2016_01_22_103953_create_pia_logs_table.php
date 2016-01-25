<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePiaLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pia_logs', function(Blueprint $table)
		{
			$table->increments('pia_log_id');
			$table->string('student_number', 20);
			$table->integer('equation_id')->unsigned();
			$table->string('reaction',100);
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
		Schema::drop('pia_logs');
	}

}
