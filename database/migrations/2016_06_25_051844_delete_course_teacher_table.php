<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteCourseTeacherTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::drop('course_teacher');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::create('course_teacher', function(Blueprint $table){
			$table->increments('id');
			$table->integer('course_id')->unsigned();
			$table->integer('teacher_id')->unsigned();
			$table->timestamps();
		});
	}

}
