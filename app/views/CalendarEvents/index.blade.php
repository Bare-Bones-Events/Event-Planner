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
        @foreach($events as $event)
            <h3><a href="{{{ action('CalendarEventsController@show', $event->id) }}}">{{{ $event->event_name }}}</a></h3>
            <h5>{{{ 'Location: ' . $event->location->location_name }}}</h5>
            <h6>{{{ 'Created By: ' . $event->user->username }}}</h6>
            <p>{{{ 'Created at: ' . $event->created_at }}}</p>
           <p>{{{ 'Planned for: ' . $event->start_time . ' - ' . $event->end_time }}}</p>
           @if($event->event_image)
           <a href="{{{ action('CalendarEventsController@show', $event->id) }}}"><img class="responsive thumbnail" src="/{{ $event->event_image }}" alt="event_image" height="100px" width="100px"/></a>
           @endif
        @endforeach
        <div>
            {{ $events->links() }}
        </div>
    </div>
@stop
