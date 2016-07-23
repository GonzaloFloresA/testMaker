<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMultipleQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('multiplequestions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('question_id');
			$table->json('solution')->nullable();
			$table->string('desc_solution')->nullable();
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
		Schema::drop('multiplequestions');
	}

}
