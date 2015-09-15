
 
    {{ Form::token() }}

        <div class="form-group @if($errors->has('event_name')) has-error @endif">
            {{ Form::label('event_name', 'Event Name') }}
            {{ Form::text('event_name', null, ['class' => 'form-control']) }}
        </div>
        <div>
            {{ Form::label('location', 'Location') }}
            {{ Form::text('location', null, ['class' => 'form-control']) }}
        </div>
        <div>
            {{ Form::label('cost', 'Price') }}
            {{ Form::number('cost', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group @if($errors->has('date')) has-error @endif">
            {{ Form::label('start_time', 'Start Time/Date') }}
            {{ Form::text('start_time', null, ['class' => 'form-control', 'id' => 'startsAtDateTimePicker']) }}
        </div>
        <div>
            {{ Form::label('end_time', 'End Time/Date') }}
            {{ Form::text('end_time', null, ['class' => 'form-control', 'id' => 'endsAtDateTimePicker']) }}
        </div>
        <div class="form-group @if($errors->has('description')) has-error @endif">
            <label for="description">Description</label>
            <div class="wmd-panel">
                <div id="wmd-button-bar"></div>
                @if(!empty($calEvent->description))
                    <textarea class="wmd-input form-control" name="body" cols="50" rows="10" id="wmd-input">{{{$events->description}}}
                    </textarea>
                @else
                    <textarea class="wmd-input form-control" name="body" cols="50" rows="10" id="wmd-input"></textarea>
                @endif
            </div>
            <label>Preview:</label>
            <div id="wmd-preview" class="wmd-panel wmd-preview"></div>
            <br/>
        </div>
        <div class="form-group">
            {{ Form::label('event_image', 'Upload an Image') }}
            {{ Form::file('event_image', ['class' => 'form-control']) }}
        </div>
        

