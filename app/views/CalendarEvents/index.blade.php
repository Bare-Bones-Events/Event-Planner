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
        @foreach($calendarevents as $caleEvent)
            <h3><a href="{{{ action('CalendarEventsController@show', $calendarevents->id) }}}">{{{ $caleEvent->event_name }}}</a></h3>
            <h5>{{{ 'Created By: ' . $caleEvent->user->username }}}</h5>
            <h6>{{{ 'Planned for' . $caleEvent->date}}}</h6>
            <p>{{{ $caleEvent->start_time . ' - ' . $caleEvent->end_time }}}</p>
        @endforeach
        <div>
            {{ $calendarevents->links() }}
        </div>
    </div>
@stop