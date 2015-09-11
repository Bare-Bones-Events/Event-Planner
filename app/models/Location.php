<?php

use \Esensi\Model\SoftModel;

class Location extends SoftModel {
	protected $fillable = [];

	protected $rules = array (

		'location_name' => 'required|max:255',
		'location_street' => 'required|max:255',
		'location_city' => 'required|max:255',
		'location_state' => 'required|max:255',
		'location_zip' => 'required|max:11'

	);

	public function calendarEvents()
	{
		return $this->hasMany('CalendarEvent');
	}

}