@extends('layouts.master')

@section('title')
Create User
@stop


@section('content')

<div class="container well col-md-8">
		<h1>Create User</h1>
		{{ Form::open(array('action' => array('UsersController@store'))) }}
			
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
				{{ Form::file('image') }}
			</div>

			<div class="form-group">	
				<button class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Submit</button>
				<a class="btn btn-info" type='submit' href="{{{ action('HomeController@login') }}}"><span class="glyphicon glyphicon-ban-circle"></span> Cancel</a> 

				<a class="btn btn-danger" type="submit" id="delete">Delete</a>
			</div>
			
		{{ Form::close() }}
	</div>


@stop

@section('script')
<script>
@stop