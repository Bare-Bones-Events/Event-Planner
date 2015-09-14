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
		
		$users = User::paginate(10);

		return View::make('user.index')->with('users', $users);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('user.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{
	
		$uploads_directory = 'images/uploads/';

		$user = new User();
		$user->first_name =  Input::get('first_name');
		$user->last_name =  Input::get('last_name');
		$user->username =  Input::get('username');
		$user->email =  Input::get('email');
		$user->password =  Input::get('password');
		$user->password_confirmation =  Input::get('password_confirmation');
		
		if(Input::hasFile('image')) {
			$filename = Input::file('image')->getClientOriginalName();	
			$user->image = Input::file('image')->move($uploads_directory, $filename);
		}

		$result = $user->save();

		Log::info('Log Message', Input::all());

		Session::flash('successMessage', 'User successfully created');

		if ($result == false) {

			Log::error('Log Message', "User Creation Error");

			Session::flash('errorMessage', 'Error occurred during submission.  Please retry');
		}

		return Redirect::action('UsersController@login');


	}

	/**
	 * Display the specified resource.
	 * GET /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
		$id = Auth::id();

		$user = User::find($id);

		if(!$user) {

			$message = "User not found";

			Log::error($message);

			Session::flash('errorMessage', 'User not found');


			return Redirect::action('UsersController@login');
		}

		return View::make('user.show')->with('user', $user);
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
		return View::make('user.edit')->with('user', $user);
	}

	public function login()
	{
		return View::make('user.login');
	}
	
	public function logout()
	{
		return View::make('user.logout');
	}

	public function doLogin()
	{
		$email = Input::get('email');
		$password = Input::get('password');
		if (Auth::attempt(array('email' => $email, 'password' => $password), true)) {
			Log::info('Login Successful - ', array('Login for = ' => Input::get('email')));
		    return Redirect::intended('/'); // TODO : hook this to /events when method is built
		  
		} else {
			
			Log::error('Login Error on : ', Input::get('email'));
			Session::flash('errorMessage', 'Problem with email and/or password. Please resubmit');

		    return Redirect::action('UsersController@login');
		}
	}
	
	public function doLogout()
	{
		Auth::logout();

		Session::flash('successMessage', 'Logout successfully completed');

		return Redirect::to('/');
		
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
		$id = Auth::id();
		
		$user = User::find($id);

	    if(!$user) {

	    	$message = "User not found.";

	    	Log::warning($message);
		
			Session::flash('errorMessage', "User not found");

			App::abort(404);
		}
		
		$user->first_name =  Input::get('first_name');
		$user->last_name =  Input::get('last_name');
		$user->username =  Input::get('username');
		$user->email =  Input::get('email');
		$user->save();
		
		return Redirect::action('UsersController@show');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		$id = Auth::id();

		User::find($id)->delete();
		Log::info('User Deleted with attached information: ', Input::all());
		return Redirect::action('UsersController@login');
	}

}