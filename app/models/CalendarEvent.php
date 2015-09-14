<?php

use \Esensi\Model\SoftModel;

class CalendarEvent extends SoftModel {

    protected $table = 'calendar_events';

    protected $rules = array(

    	'event_name' 	=> 'required|max:255',
    	'start_time' 	=> 'required|max:255',
    	'end_time' 		=> 'required|max:255',
    	'date' 			=> 'required|max:255',
    	'cost' 			=> 'max:255',
    	'description' 	=> 'required|max:750'

	);

	protected $fillable = array(

		// code here
	);


	public function user ()
	{
		return $this->belongsTo('User', 'user_id');
	}

	public function userEvents ()
	{
		return $this->hasMany('User');
	}

}