<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseTeacherTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('course_teacher', function(Blueprint $table){
			$table->increments('id');
			$table->integer('course_id')->unsigned();
			$table->integer('teacher_id')->unsigned();
			$table->integer('group');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('course_teacher');
	}

}
