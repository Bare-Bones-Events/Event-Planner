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
			$table->string('created_by');
			$table->foreign('created_by')->references('id')->on('users');
			$table->string('location');
			$table->foreign('location')->references('location_name')->on('locations');
			$table->string('start_time');
			$table->string('end_time');
			$table->string('date');
			$table->integer('cost');
			$table->string('description');
			$table->string('rsvp');

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
