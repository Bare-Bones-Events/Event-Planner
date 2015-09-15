@extends('layouts.master')

@section('title')
Edit Event
@stop

@section('pageTitle')
    <div class="jumbotron responsive">
        <h1>Edit Event</h1>
    
@stop

@section('content')
    
        <div class="container responsive">
            <h3>{{{ calendarevent->event_name }}}</h3>
            <h5>{{{ calendarevent->date }}}</h5>
            {{ calendarevent->parse }}
        </div>
    </div>
    <div class="container responsive">
     @foreach($errors->all() as $error)
            <div class="alert alert-warning" role="alert">{{{ $error }}}</div>
        @endforeach
        {{ Form::model(calendarevent, array('action' => array('PostsController@update', calendarevent->id), 'method' => 'PUT', 'files' => true)) }}
        @include('posts.create-edit-form')
        <div class="btn-group btn-group-justified">
            <div class="btn">
                {{ Form::button('<span class="glyphicon glyphicon-pencil"></span> Save Edits', array('class' => 'btn btn-success pull-left', 'type' => 'submit')) }}
            </div>
    {{ Form::close() }}
    
        
        

    </form>
    </div>

@stop

@section('script')
<script src="/js/Markdown.Sanitizer.js"></script>
<script src="/js/Markdown.Converter.js"></script>
<script src="/js/Markdown.Editor.js"></script>
<script type="text/javascript">
    (function () {
        
        var converter = new Markdown.Converter();
        
        var editor = new Markdown.Editor(converter);
        
        editor.run();
    })();
</script>
@stop