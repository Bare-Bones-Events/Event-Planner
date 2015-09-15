<?php

class CalendarEventsController extends \BaseController {

	/**
	 * Display a listing of calendarevents
	 *
	 * @return Response
	 */
	public function index()
	{
		// $calendarevents = Calendarevent::all();

		$query = CalendarEvent::with('user');


		$search = Input::get('search');

		if (!empty($search)) {
			$query->where('event_name', 'like', $search . '%');

			$query->orWhere('event_name', 'like', '%' . $search . '%');

			$query->orWhere('event_name', 'like', '%' . $search);

		}

		$calendarevents = $query->orderBy('start_time', 'DESC')->paginate(10);

		return View::make('calendarevents.index')->with(array('calendarevents' => $calendarevents));
	}

	/**
	 * Show the form for creating a new calendarevent
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('calendarevents.create');
	}

	/**
	 * Store a newly created calendarevent in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$uploads_directory = 'eventImages/uploads/';

		$calEvent = new Calendarevent();
		$calEvent->creator_id = Auth::id();
		$calEvent->event_name =  Input::get('event_name');
		// $calEvent->location =  Input::get('location');
		$calEvent->cost =  Input::get('cost');
		$calEvent->start_time =  Input::get('start_time');
		$calEvent->end_time =  Input::get('end_time');
		$calEvent->description =  Input::get('description');

		if(Input::hasFile('image')) {
			$filename = Input::file('image')->getClientOriginalName();
			$calEvent->event_image = Input::file('image')->move($uploads_directory, $filename);
		}

		$result = $calEvent->save();

		Log::info('Log Message', Input::all());

		Session::flash('successMessage', 'Event successfully created');

		if ($result == false) {

			Session::flash('errorMessage', 'Error occurred during submission.  Please retry');
			Log::info('Validator failed', Input::all());
			return Redirect::back()->withInput()->withErrors($calEvent->getErrors());
		}

		if (Request::wantsJson()) {
			return Response::json(array('Status' => 'Request Succeeded'));
	    } else {
			return Redirect::action('CalendarEventsController@show', array($calEvent->id));
		}
	}

	/**
	 * Display the specified calendarevent.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$calendarevent = Calendarevent::findOrFail($id);

		return View::make('calendarevents.show', compact('calendarevent'));
	}

	/**
	 * Show the form for editing the specified calendarevent.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$calendarevent = Calendarevent::find($id);

		return View::make('calendarevents.edit', compact('calendarevent'));
	}

	/**
	 * Update the specified calendarevent in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$calendarevent = Calendarevent::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Calendarevent::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$calendarevent->update($data);

		return Redirect::route('calendarevents.index');
	}

	/**
	 * Remove the specified calendarevent from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Calendarevent::destroy($id);

		return Redirect::route('calendarevents.index');
	}

}
