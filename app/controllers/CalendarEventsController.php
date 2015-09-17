<?php

class CalendarEventsController extends \BaseController {

	/**
	 * Display a listing of calendarevents
	 *
	 * @return Response
	 */
	public function index()
	{

		$query = CalendarEvent::with('user');


		$search = Input::get('search');

		if (!empty($search)) {
			$query->where('event_name', 'like', $search . '%');

			$query->orWhere('event_name', 'like', '%' . $search . '%');

			$query->orWhere('event_name', 'like', '%' . $search);

		}

		$events = $query->orderBy('start_time', 'DESC')->paginate(10);

		return View::make('calendarevents.index')->with(array('events' => $events));
	}

	public function getManage()
	{

		if(!Auth::check()){
			return Redirect::action('CalendarEventsController@index');
		}elseif(Auth::check() && Auth::user()->role == 'admin'){
			$events = CalendarEvent::all();
			return View::make('calendarevents.manage')->with('events', $events);
		}else{
			$query = CalendarEvent::all();
			$query->where('creator_id', Auth::id());
			$events = $query->orderBy('created_at', 'DESC');
			return View::make('calendarevents.manage')->with('events', $events);
		}
	}

	/**
	 * Show the form for creating a new calendarevent
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!Auth::check()){
			return Redirect::action('UsersController@doLogin');
		}
		$locations    = Location::all();
		$dropdown     = [];
		$dropdown[-1] = 'Add new address';
		foreach ($locations as $location) {
			$dropdown[$location->id] = $location->location_name . " - " . $location->location_city . ', ' . $location->location_state;
		}

		return View::make('calendarevents.create')->with('dropdown', $dropdown);
	}

	/**
	 * Store a newly created calendarevent in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$event = new CalendarEvent();
		$location = new Location();

		Log::info("Event created successfully");
		Log::info("Log Message", array('context' => Input::all()));

		return $this->validateAndSave($event, $location);
	}

	/**
	 * Display the specified calendarevent.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$event = Calendarevent::findOrFail($id);


		return View::make('calendarevents.show', compact('event'));

	}

	/**
	 * Show the form for editing the specified calendarevent.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$event = Calendarevent::find($id);

		if (!$event) {
			App::abort(404);
		}
		
		if(!Auth::check()){
			return Redirect::action('UsersController@doLogin');
		}elseif ((Auth::id() == $event->creator_id) || (Auth::user()->role == 'admin')) {
			$locations    = Location::all();
		$dropdown     = [];
		$dropdown[-1] = 'Add new address';
		foreach ($locations as $location) {
			$dropdown[$location->id] = $location->location_name . " - " . $location->location_city . ', ' . $location->location_state;
		}
			return View::make('calendarevents.edit', compact('event', 'dropdown'));
		}else{
			Session::flash('errorMessage', 'Access not authorized');
			return Redirect::action('CalendarEventsController@index');
		}
	}

	/**
	 * Update the specified calendarevent in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$event = CalendarEvent::findOrFail($id);

		$location = Location::findOrFail($event->location_id);

		if(!$event){
			App::abort(404);
		}

		return $this->validateAndSave($event, $location);
	}

	/**
	 * Remove the specified calendarevent from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$event = CalendarEvent::findOrFail($id);
		$event->delete();
        if (Request::wantsJson()) {
            return Response::json(array('Status' => 'Request Succeeded'));
        } else {
			Session::flash('successMessage', 'This event has been successfully deleted.');
            return Redirect::action('CalendarEventsController@index');
        }
	}


	public function validateAndSave($event, $location)
	{

		try {

			$uploads_directory = 'images/uploads/';

			if(Input::hasFile('event_image')) {
				$filename = Input::file('event_image')->getClientOriginalName();
				$event->event_image = Input::file('event_image')->move($uploads_directory, $filename);
			}

			if (Input::get('location') == '-1') {
		    	$location->location_name   	= Input::get('location_name');
		    	$location->location_street 	= Input::get('location_street');
		    	$location->location_city    = Input::get('location_city');
		    	$location->location_state   = Input::get('location_state');
		    	$location->location_zip 	= Input::get('location_zip');
		    	$location->saveOrFail();
		    } else {
		    	$location = Location::findOrFail(Input::get('location'));
		    }

	    	$event->start_time  = Input::get('start_time');
	    	$event->end_time    = Input::get('end_time');
			$event->event_name 	= Input::get('event_name');
			$event->description = Input::get('description');
			$event->cost 		= Input::get('cost');

			$event->location_id = $location->id;
			$event->creator_id 	= Auth::id();

			$event->saveOrFail();
			if (Request::wantsJson()) {
				return Response::json(array('Status' => 'Request Succeeded'));
	        } else {
				Session::flash('successMessage', 'Your event has been successfully saved.');
				return Redirect::action('CalendarEventsController@show', array($event->id));
			}
		} catch(Watson\Validating\ValidationException $e) {
			Session::flash('errorMessage',
				'Ohh no! Something went wrong. You should be seeing some errors down below.');
	    	Log::info('Validator failed', Input::all());
	        return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
	}

}
