<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteGroupTeacherTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::drop('group_teacher');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::create('group_teacher', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('group_id')->unsigned();
			$table->integer('teacher_id')->unsigned();
			$table->integer('year')->unsigned();
			$table->enum('semester',['1','2']);
			$table->timestamps();
		});
	}

}
