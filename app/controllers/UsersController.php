<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{
		// create the validator
	    $validator = Validator::make(Input::all(), User::$rules);

	    // attempt validation
	    if ($validator->fails()) {
	        // validation failed, redirect to the user create page with validation errors and old inputs

	        Session::flash('errorMessage', 'An error has occurred.  Please see below for error: ');

	        return Redirect::back()->withInput()->withErrors($validator);
	    } else {
	        // validation succeeded, create and save the user
			
			$uploads_directory = 'images/uploads/';

			$user = new User();
			$user->first_name =  Input::get('first_name');
			$user->last_name =  Input::get('last_name');
			$user->username =  Input::get('username');
			$user->email =  Input::get('email');
			$user->password =  Input::get('password');
			$user->passwordConfirmation =  Input::get('passwordConfirmation');
			
			if(Input::hasFile('image')) {
				$filename = Input::file('image')->getClientOriginalName();	
				$user->image = Input::file('image')->move($uploads_directory, $filename);
			}

			$user->save();

			Log::info('Log Message', Input::all());

			Session::flash('successMessage', 'Submission successfully completed');

			return Redirect::action('UserController@login');
	    }
	}

	/**
	 * Display the specified resource.
	 * GET /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /users/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$id = Auth::id();
		$user = User::find($id);
		return View::make('edit-user')->with('user', $user);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}