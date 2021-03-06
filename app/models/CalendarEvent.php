<?php

use \Esensi\Model\SoftModel;

class CalendarEvent extends SoftModel {

    protected $table = 'calendar_events';

    protected $rules = array(

    	'event_name' 	=> 'required|max:255',
    	'start_time' 	=> 'required|max:255',
    	'end_time' 		=> 'required|max:255',
    	'cost' 			=> 'max:255',
    	'description' 	=> 'required|max:750'

	);

	protected $fillable = array(

		// code here
	);

    public function location()
    {
        return $this->belongsTo('Location');
    }

	public function user()
	{
		return $this->belongsTo('User', 'creator_id');
	}

	public function renderBody() {
        $parse = new Parsedown;
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);
        $body = $parse->text($this->description);

        return $clean_html = $purifier->purify($body);

    }

    public function uploadImage($file)
    {
        $name = $file->getClientOriginalName();
        $path = 'images/event-imgs/';
        $file->move(public_path() . $path, $name);
        $this->event_image = $path . $name;
    }

}
