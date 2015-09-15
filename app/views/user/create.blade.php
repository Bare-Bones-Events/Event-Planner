@extends('layouts.master')

@section('title')
Create User
@stop


@section('content')

<div class="container well col-md-6 col-md-offset-3">
		<h1>Create User</h1>
		{{ Form::open(array('action' => 'UsersController@store', 'files' => true)) }}
			
			<div class="form-group @if($errors->has('first_name')) has-error @endif">
				{{ Form::label('first_name', 'First Name') }}
				{{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Enter First Name']) }}
			</div>

			<div class="form-group @if($errors->has('last_name')) has-error @endif">
				{{ Form::label('last_name', 'Last Name') }}
				{{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Last Name']) }}
			</div>

			<div class="form-group @if($errors->has('username')) has-error @endif">
				{{ Form::label('username', 'Username') }}
				{{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Enter Username']) }}
			</div>

			<div class="form-group @if($errors->has('email')) has-error @endif">
				{{ Form::label('email', 'E-mail') }}
				{{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter E-mail']) }}
			</div>

			<div class="form-group @if($errors->has('password')) has-error @endif">
				{{ Form::label('password', 'Password') }}
				{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter Password']) }}
			</div>

			<div class="form-group @if($errors->has('password_confirmation')) has-error @endif">
				{{ Form::label('password_confirmation', 'Confirm Password') }}
				{{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) }}
			</div>

			<div class="form-group">
				{{ Form::file('image') }}
			</div>

			<div class="form-group">	
				<button class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Submit</button>
				<a class="btn btn-info" type='submit' href="{{{ action('UsersController@login') }}}"><span class="glyphicon glyphicon-ban-circle"></span> Cancel</a> 

				<a class="btn btn-danger" type="submit" id="delete">Delete</a>
			</div>
			
		{{ Form::close() }}
	</div>


@stop

@section('script')
<script>
@stop