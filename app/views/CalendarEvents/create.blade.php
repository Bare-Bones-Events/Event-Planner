@extends('layouts.master')

@section('title')
Create Event
@stop


@section('pageTitle') 
    <div class="jumbotron">   
        <h1>Create an Event</h1>
    </div>
@stop


@section('content')
    <div class="container">
    
         @foreach($errors->all() as $error)
            <div class="alert alert-warning" role="alert">{{{ $error }}}</div>
        @endforeach
        {{ Form::open(array('action' => 'CalendarEventsController@store', 'files' => true)) }}
        @include('CalendarEvents.create-edit-form')
        <div class="btn-group btn-group-justified">
            <div class="btn">
                {{ Form::button('<span class="glyphicon glyphicon-pencil"></span> Save Post', array('class' => 'btn btn-success pull-left', 'type' => 'submit')) }}
            </div>
    {{ Form::close() }}
    
        

    </form>
    </div>

    
@stop

@section('script')
<script src="/js/Markdown.Sanitizer.js"></script>
<script src="/js/Markdown.Converter.js"></script>
<script src="/js/Markdown.Editor.js"></script>
<script src="jquery.js"></script>
<script src="/js/jquery.datetimepicker.js"></script>
<script src="http://momentjs.com/downloads/moment.min.js"></script>
<script>
   Date.parseDate = function( input, format ){
     return moment(input,format).toDate();
   };
   Date.prototype.dateFormat = function( format ){
     return moment(this).format(format);
   };

   jQuery('#startsAtDateTimePicker').datetimepicker({
       format:'YYYY-MM-DD h:mm:ss',
       formatTime:'h:mm a',
       formatDate:'DD-MM-YYYY'
   });
   jQuery('#endsAtDateTimePicker').datetimepicker({
       format:'YYYY-MM-DD h:mm:ss',
       formatTime:'h:mm a',
       formatDate:'DD-MM-YYYY'
   });
</script>
<script type="text/javascript">
  
    (function () {
        
        var converter = new Markdown.Converter();
        
        var editor = new Markdown.Editor(converter);
        
        editor.run();
    })();
</script>
@stop