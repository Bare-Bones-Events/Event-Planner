<?php

class UsersController extends \BaseController {

	public function __construct ()
	{
		parent::__construct();

		$this->beforeFilter('auth', array('except' => array('login', 'doLogin', 'create', 'store')));

		// Filter for isAdmin
		$this->beforeFilter('isAdmin', array('only' => array('index')));
		
		// Filter for isOwnerAdmin
		$this->beforeFilter('isOwnerAdmin', array('only' => array('edit', 'update', 'destroy', 'updatePassword', 'saveNewPassword')));

	}


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

		Log::info('Log Message', array(' = New User Creation with: ', Input::all()));

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
	public function show($id)
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
		if(Auth::user()->role != 'admin') {

			$id = Auth::id();
			$user = User::find($id);
			return View::make('user.edit')->with('user', $user);

		} else {

			$user = User::find($id);
			return View::make('user.edit')->with('user', $user);
		}
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

		$uploads_directory = 'images/uploads/';
		
		$user->first_name =  Input::get('first_name');
		$user->last_name =  Input::get('last_name');
		$user->username =  Input::get('username');
		$user->email =  Input::get('email');

		if(Input::hasFile('image')) {
			$filename = Input::file('image')->getClientOriginalName();	
			$user->image = Input::file('image')->move($uploads_directory, $filename);
		}

		$user->save();
		
		return Redirect::action('UsersController@show');
	}

	public function updatePassword () 
	{
		$id = Auth::id();
		$user = User::find($id);
		return View::make('user.update-password')->with('user', $user);
	}

	public function saveNewPassword () {

		$id = Auth::id();
		
		$user = User::find($id);

		if(Auth::attempt(array('id' => $id, 'password' => Input::get('old_password')))) {

			$user->password =  Input::get('password');

			$user->password_confirmation =  Input::get('password_confirmation');

			$user->save();
		
		return Redirect::action('UsersController@show'); 

		} else {
			$message = "Password Error";

			Log::error($message);

			Session::flash('errorMessage', 'Old Password Incorrect.  Please resubmit');

			return Redirect::action('UsersController@updatePassword'); 

		}

	    if(!$user) {

	    	$message = "User not found.";

	    	Log::warning($message);
		
			Session::flash('errorMessage', "User not found");

			App::abort(404);
		}
		
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
		$email_or_username = Input::get('email_or_username');
		$password = Input::get('password');

		if (Auth::attempt(array('email' => $email_or_username, 'password' => $password), true) ||
			Auth::attempt(array('username' => $email_or_username, 'password' => $password), true)) {
			Log::info('Login Successful - ', array('User = ' => Input::get('email_or_username')));
		    return Redirect::intended('/events');
		  
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

		Session::flash('successMessage', 'User successfully deleted.');

		return Redirect::action('UsersController@login');
	}

}