@extends(layouts.master)

@section('title')
Edit User
@stop


@section('content')
<div class="container well col-md-8 col-md-offset-2">
	<h1>Edit User</h1>
	{{ Form::model($user, array('action' => array('UsersController@update', $user->id), 'method' => 'PUT')) }}
		
		<div class="form-group @if($errors->has('first_name')) has-error @endif">
			{{ Form::label('first_name', 'First Name') }}
			{{ Form::text('first_name', null, ['class' => 'form-control']) }}
		</div>

		<div class="form-group @if($errors->has('last_name')) has-error @endif">
			{{ Form::label('last_name', 'Last Name') }}
			{{ Form::text('last_name', null, ['class' => 'form-control']) }}
		</div>

		<div class="form-group @if($errors->has('username')) has-error @endif">
			{{ Form::label('username', 'Username') }}
			{{ Form::email('username', null, ['class' => 'form-control']) }}
		</div>

		<div class="form-group @if($errors->has('email')) has-error @endif">
			{{ Form::label('email', 'E-mail') }}
			{{ Form::email('email', null, ['class' => 'form-control']) }}
		</div>

		<div class="form-group @if($errors->has('password')) has-error @endif">
			{{ Form::label('password', 'Password') }}
			{{ Form::password('password', ['class' => 'form-control']) }}
		</div>

		<div class="form-group @if($errors->has('passwordConfirmation')) has-error @endif">
			{{ Form::label('passwordConfirmation', 'Confirm Password') }}
			{{ Form::password('passwordConfirmation', ['class' => 'form-control']) }}
		</div>

		<div class="form-group">
			{{ Form::file('image', array('value' => $user->image)) }}
		</div>

		<div class="form-group">	
			<button class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Submit</button>

			<a class="btn btn-info" type='submit' href="{{{ action('UsersController@show') }}}"><span class="glyphicon glyphicon-ban-circle"></span> Cancel</a> 

			<a class="btn btn-danger" type="submit" id="delete">
				<span class="glyphicon glyphicon-remove"></span> Delete</a>
		</div>

	{{ Form::close() }}

	{{ Form::open(array('action' => array('UsersController@destroy', $user->id), 'method' => 'DELETE', 'id' => 'formDelete')) }}
	{{ Form::close() }}	

</div>

@stop

@section('script')
<script>
@stop