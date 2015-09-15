@extends('layouts.master')

@section('title')
title
@stop


@section('content')
<div class="container col-md-10 col-md-offset-1">
	<div class="well">
		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<th>Image</th>
					<th>ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Username</th>
					<th>Email</th>
					<th>Edit</th>
				</thead>
				<tbody>
					<tr>
						<td><img class="responsive thumbnail" src="/{{ $user->image }}" height="100px" width="100px"/></td>
						<td> {{ $user->id }} </td>
						<td> {{ $user->first_name }} </td>
						<td> {{ $user->last_name }} </td>
						<td> {{ $user->username }} </td>
						<td> {{ $user->email }} </td>
						<td>
							<a class="btn btn-success" href="{{ action('UsersController@edit', $user->id) }}"><span class="glyphicon glyphicon-pencil"> User</a>

							<a class="btn btn-success" href="{{ action('UsersController@updatePassword') }}"><span class="glyphicon glyphicon-pencil"> Password</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop

@section('script')
<script>
@stop