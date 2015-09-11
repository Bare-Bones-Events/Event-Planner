<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCalendarEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('CalendarEvents', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('event_name');
			$table->integer('creator_id')->unsigned();
			$table->foreign('creator_id')->references('id')->on('users');
			$table->integer('location_id')->unsigned();
			$table->foreign('location_id')->references('id')->on('locations');
			$table->string('start_time');
			$table->string('end_time');
			$table->string('date');
			$table->integer('cost');
			$table->string('description');

			$table->softDeletes();

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
		Schema::drop('CalendarEvents');
	}

}
