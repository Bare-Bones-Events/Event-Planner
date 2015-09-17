@extends('layouts.master')

@section('title')
My Events
@stop


@section('content')
<div class="container col-md-10 col-md-offset-1">
	<div class="well">
		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<th>Event</th>
					<th>Created On</th>
					<th>Cost</th>
					<th>Start Time</th>
					<th>End Time</th>
					<th>Manage</th>
				</thead>
				<tbody>
					@foreach ($events as $event)
						<tr>
							<td> {{ $event->event_name }} </td>
							<td> {{ $event->created_at }} </td>
							<td> {{ $event->cost }} </td>
							<td> {{ $event->start_time }} </td>
							<td> {{ $event->end_time }} </td>
							<td><a class="btn btn-warning" href="{{ action('CalendarEventsController@edit', $event->id) }}">
								<span class="glyphicon glyphicon-pencil"></a>
                                <a href="#" class="btn btn-danger" id="delete"><span class="glyphicon glyphicon-remove"></span></a>
                                {{ Form::open(array('action' => array('CalendarEventsController@destroy', $event->id), 'method' => 'DELETE', 'id' => 'formDelete')) }}
                                {{ Form::close() }}
                            </td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>



@stop

@section('script')
<script type="text/javascript">
(function(){
"use strict"
    $('#delete').on('click', function(){
        var onConfirm = confirm('Are you sure you want to delete this post?');

        if (onConfirm) {
            $('#formDelete').submit();
        };
    });

})();
</script>
@stop
