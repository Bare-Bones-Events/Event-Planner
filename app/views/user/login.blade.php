@extends('layouts.master')

@section('title')
title
@stop


@section('content')
<div class="container well col-md-6 col-md-offset-3">
		<h1>Login</h1>
		{{ Form::open(array('action' => array('UsersController@doLogin'))) }}
	
			<div class="form-group @if($errors->has('email')) has-error @endif">
				{{ Form::label('email', 'E-mail') }}
				{{ Form::email('email', null, ['class' => 'form-control']) }}
			</div>

			<div class="form-group @if($errors->has('password')) has-error @endif">
				{{ Form::label('password', 'Password') }}
				{{ Form::password('password', ['class' => 'form-control']) }}
			</div>

			<div class="form-group">	
				<button class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Enter</button>
				<a class="btn btn-info" type='submit' href="{{{ action('HomeController@showHome')}}}">
					<span class="glyphicon glyphicon-ban-circle"></span> Cancel</a>
				<a class="btn btn-warning" type="submit" href="{{{ action('UsersController@create')}}}"><span class="glyphicon glyphicon-user"></span> Create User</a>
			</div>
			
		{{ Form::close() }}
	</div>
@stop

@section('script')
<script>
@stop