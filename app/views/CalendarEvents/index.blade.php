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
        @foreach($posts as $post)
            <h3><a href="{{{ action('CalendarEventsController@show', $calendarevents->id) }}}">{{{ $calendarevents->event_name }}}</a></h3>
            <h5>{{{ 'Created By: ' . $calendarevents->user->username }}}</h5>
            <h6>{{{ 'Planned for' . $calendarevents->date}}}</h6>
            <p>{{{ $calendarevents->start_time->setTimezone('America/Chicago')->format('h A') . $calendarevents->end_time->setTimezone('America/Chicago')->format('h A') }}}</p>
        @endforeach
        <div>
            {{ $posts->links() }}
        </div>
    </div>
@stop