<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $deadline->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('date') }}
            {{ Form::date('date', $deadline->date, ['class' => 'form-control' . ($errors->has('date') ? ' is-invalid' : ''), 'placeholder' => 'Date']) }}
            {!! $errors->first('date', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('type') }}
            {{ Form::text('type', $deadline->type, ['class' => 'form-control' . ($errors->has('type') ? ' is-invalid' : ''), 'placeholder' => 'Type']) }}
            {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::textarea('description', $deadline->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('priority') }}
            {{ Form::select('priority', [0 => 0, 1 => 1, 2 => 2, 3 => 3, 4 => 4], $deadline->priority, ['min' => 0, 'max' => 4, 'class' => 'form-control' . ($errors->has('priority') ? ' is-invalid' : ''), 'placeholder' => 'Priority']) }}
            {!! $errors->first('priority', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('is_planned') }}
            {{ Form::select('is_planned', ["Niezaplanowane ❌", "Zaplanowane 👍"], $deadline->is_planned, ['class' => 'form-control' . ($errors->has('is_planned') ? ' is-invalid' : ''), 'placeholder' => 'Czy zaplanowane?']) }}
            {!! $errors->first('is_planned', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('goal_id') }}
            {{ Form::select('goal_id', $goals, $deadline->goal_id, ['class' => 'form-control' . ($errors->has('goal_id') ? ' is-invalid' : ''), 'placeholder' => 'Goal id']) }}
            {!! $errors->first('goal_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            @if($team_name != "")
                {{ Form::label("Widoczne dla: ".$team_name) }}
            @else
                {{ Form::label("Prywatne") }}
            @endif
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>