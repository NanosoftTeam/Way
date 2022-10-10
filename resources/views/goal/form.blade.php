<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $goal->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::textarea('description', $goal->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('type') }}
            {{ Form::text('type', $goal->type, ['class' => 'form-control' . ($errors->has('type') ? ' is-invalid' : ''), 'placeholder' => 'Type']) }}
            {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('priority') }}
            {{ Form::number('priority', $goal->priority, ['class' => 'form-control' . ($errors->has('priority') ? ' is-invalid' : ''), 'placeholder' => 'Priority']) }}
            {!! $errors->first('priority', '<div class="invalid-feedback">:message</div>') !!}
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
        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Zapisz</button>
    </div>
</div>