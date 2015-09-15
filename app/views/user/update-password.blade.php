@extends('layouts.master')

@section('title')
title
@stop


@section('content')
<div class="container well col-md-6 col-md-offset-3">
	<h1>Update Password</h1>
	{{ Form::model($user, array('action' => array('UsersController@saveNewPassword', $user->id), 'method' => 'PUT')) }}

	<div class="form-group @if($errors->has('password')) has-error @endif">
		{{ Form::label('password', 'Password') }}
		{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter New Password']) }}
	</div>

	<div class="form-group @if($errors->has('password_confirmation')) has-error @endif">
		{{ Form::label('password_confirmation', 'Confirm Password') }}
		{{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm New Password']) }}
	</div>

	<div class="form-group">

		<button class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Submit</button>
		<a class="btn btn-info" type='submit' href="{{{ action('UsersController@login') }}}"><span class="glyphicon glyphicon-ban-circle"></span> Cancel</a> 

	</div>


@stop

@section('script')
<script>
@stop