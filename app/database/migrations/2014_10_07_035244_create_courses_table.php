<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('courses', function($table)
		{
			$table->increments('id');
			$table->string('uid');
			$table->string('name');
			$table->text('about');
			$table->integer('ownerid');
			$table->string('members');
			$table->integer('boards');
			$table->string('files');
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
		Schema::drop('courses');
	}

}
