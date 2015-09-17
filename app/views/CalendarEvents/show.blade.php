@extends('layouts.master')

@section('title')
Reader
@stop

@section('content')
    <div class="jumbotron responsive">
        <form class="form align-right responsive">
            <input type="text" name="search" id="search" class="search-query" placeholder="Search">
        </form>
        <h1>{{{ $event->event_name }}}</h1>
        <h3>{{{ "{$event->location->location_name} {$event->location->location_street}, {$event->location->location_city}, {$event->location->location_state}" }}}</h3>
        <h3>{{{ '$' . $event->cost }}}</h3>
        <h4>{{{ $event->start_time . ' - ' . $event->end_time }}}</h4>
        <h5>{{{ 'Posted By: ' . $event->user->username }}}</h5>

       <h6>{{{ 'Event Created on: ' . $event->created_at->setTimezone('America/Chicago')->format('l, F jS Y @ h:i A') }}}</h6>
        {{ $event->renderBody() }}
        <div class="col-md-3">
            <img class="responsive thumbnail" src="/{{ $event->event_image }}" alt="event_image"/>
        </div>
        <div class="clearfix"></div>
    </div>
    {{-- @if(Auth::check() $$ Auth::id() == $event->user_id) --}}
    <a href="{{{ action('CalendarEventsController@index') }}}"><button class="btn btn-primary" ><span class="glyphicon glyphicon-fast-backward responsive"></span> Back to All</button></a>

    @if(Auth::check() && (Auth::id() == $event->creator_id || Auth::id() == $event->user->where('role', 'admin')))

        <a href="{{{ action('CalendarEventsController@edit', $event->id) }}}"><button class="btn btn-warning" ><span class="glyphicon glyphicon-wrench"></span> Edit This Post</button></a>

        <button id="delete" class="btn btn-danger" ><span class="glyphicon glyphicon-remove"></span> Delete</button>
        {{ Form::open(array('action' => array('CalendarEventsController@destroy', $event->id), 'method' => 'DELETE', 'id' => 'formDelete')) }}
        {{ Form::close() }}
    @endif
@stop

@section('script')
    <script>


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
