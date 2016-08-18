<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterExamStudentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('exam_student', function(Blueprint $table)
		{
			$table->boolean('pending')->after('id');
			$table->integer('intent')->after('pending');
			$table->integer('calification')->after('intent');
			$table->string('token_access')->after('calification');
			$table->time('start')->after('token_access');
			$table->time('end')->after('start');
			$table->string('content',500)->after('end');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
