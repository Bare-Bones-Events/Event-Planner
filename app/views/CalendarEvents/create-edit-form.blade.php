

    {{ Form::token() }}
        <div id="where_section">
            <div class="form-group @if($errors->has('event_name')) has-error @endif">
                {{ Form::label('event_name', 'Event Name') }}
                {{ Form::text('event_name', null, ['class' => 'form-control']) }}
            </div>
            <div class="row">
        		{{ Form::label('where', 'Where') }}<br>
        		<div class="dropdown form-group col-md-3" id="location">
    				{{ Form::select('location', $dropdown, null, ['class' => 'form-control dropdown-toggle btn btn-default' ]) }}
        		</div>
        	</div>

        	<div class="row">
        		<div class="form-group col-md-6" id="location-name">
                    {{ Form::label('location_name', 'Location Name') }}
        			{{ Form::text('location_name', null, ['class' => 'form-control', 'placeholder' => 'Location Name']) }}
        		</div>

        		<div class="form-group col-md-6" id="location-street">
                    {{ Form::label('location_street', 'Street') }}
        			{{ Form::text('location_street', null, ['class' => 'form-control', 'placeholder' => 'Street Address']) }}
        		</div>
        	</div>
        	<div class="row">
        		<div class="form-group col-md-5" id="location-city">
                    {{ Form::label('location_city', 'City') }}
        			{{ Form::text('location_city', null, ['class' => 'form-control', 'placeholder' => 'City']) }}
        		</div>

        		<div class="dropdown form-group col-md-3" id="location-state">
                    {{ Form::label('location_state', 'State') }}
                    @include('/layouts/partials/states')
    		</div>

    		<div class="form-group col-md-4" id="location-zip">
                {{ Form::label('location_zip', 'Zip') }}
    			{{ Form::number('location_zip', null, ['class' => 'form-control', 'placeholder' => 'Zip']) }}
    		</div>
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
                    <textarea class="wmd-input form-control" name="description" cols="50" rows="10" id="wmd-input">{{{$events->description}}}
                    </textarea>
                @else
                    <textarea class="wmd-input form-control" name="description" cols="50" rows="10" id="wmd-input"></textarea>
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
