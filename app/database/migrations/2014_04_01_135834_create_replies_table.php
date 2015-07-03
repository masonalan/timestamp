<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('replies', function($table)
		{
			$table->increments('id');
			$table->string('content', 512);
			$table->integer('user_id');
			$table->integer('post_id');
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
		//
		Schema::drop('replies');
	}

}
