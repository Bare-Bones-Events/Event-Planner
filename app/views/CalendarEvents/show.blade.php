@extends('layouts.master')

@section('title')
Reader
@stop

@section('content')
    <div class="jumbotron responsive">
        <form class="form align-right responsive">
            <input type="text" name="search" id="search" class="search-query" placeholder="Search">
        </form>
        <h1>{{{ $calendarevent->event_name }}}</h1>
        <h3>{{{ $calendarevent->date }}}</h3>
{{--         <h5>{{{ 'Posted By: ' . $calendarevent->user->username }}}</h5>
 --}}        <h6>{{{ 'Event Created on: ' . $calendarevent->created_at->setTimezone('America/Chicago')->format('l, F jS Y @ h:i A') }}}</h6>
        {{ $calendarevent->renderBody() }}
        <div class="col-md-3">
            <img src="{{ $calendarevent->image }}" alt="">
        </div>
        <div class="clearfix"></div>
    </div>
    {{-- @if(Auth::check() $$ Auth::id() == $calendarevent->user_id) --}}
    <a href="{{{ action('CalendarEventsController@index') }}}"><button class="btn btn-primary" ><span class="glyphicon glyphicon-fast-backward responsive"></span> Back to All</button></a>

    @if(Auth::check() && Auth::id() == $calendarevent->user_id)
    
        <a href="{{{ action('PostsController@edit', $calendarevent->id) }}}"><button class="btn btn-warning" ><span class="glyphicon glyphicon-wrench"></span> Edit This Post</button></a>

        <button id="delete" class="btn btn-danger" ><span class="glyphicon glyphicon-remove"></span> Delete</button>
        {{ Form::open(array('action' => array('PostsController@destroy', $calendarevent->id), 'method' => 'DELETE', 'id' => 'formDelete')) }}
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