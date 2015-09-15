@extends('layouts.master')

@section('title')
Index
@stop

@section('content')
    <div class="container jumbotron responsive">
        <h1>Events</h1>
        <form class="form align-right responsive">
            <input type="text" name="search" id="search" class="search-query" placeholder="Search">
        </form>
        @foreach($calendarevents as $calEvent)
            <h3><a href="{{{ action('CalendarEventsController@show', $calEvent->id) }}}">{{{ $calEvent->event_name }}}</a></h3>
            <h5>{{{ 'Location: ' . $calEvent->location }}}</h5>
            <p>{{{ 'Created at: ' . $calEvent->created_at }}}</p>
           <p>{{{ 'Planned for: ' . $calEvent->start_time . ' - ' . $calEvent->end_time }}}</p>
        @endforeach
        <div>
            {{ $calendarevents->links() }}
        </div>
    </div>
@stop