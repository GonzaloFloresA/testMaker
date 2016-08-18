<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEvaluation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('evaluations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('exam_id');
			$table->boolean('pending');
			$table->integer('intent');
			$table->integer('calification');
			$table->string('token_access');
			$table->datetime('start');
			$table->datetime('end');
			$table->string('content',500);
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
		Schema::drop('evaluations');
	}

}
