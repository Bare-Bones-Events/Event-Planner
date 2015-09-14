@extends('layouts.master')

@section('title')
Users
@stop


@section('content')
<div class="container col-md-10 col-md-offset-1">
	<div class="well">
		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<th>ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Username</th>
					<th>Email</th>
					<th>Edit</th>
				</thead>
				<tbody>
					@foreach ($users as $user)
						<tr>
							<td> {{ $user->id }} </td>
							<td> {{ $user->first_name }} </td>
							<td> {{ $user->last_name }} </td>
							<td> {{ $user->username }} </td>
							<td> {{ $user->email }} </td>
							<td><a class="btn btn-danger">placeholder</a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
	

@stop

@section('script')
<script>
@stop