<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $lesson->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('day') }}
            {{ Form::select('day', [1 => 'Poniedzialek', 2 => 'Wtorek', 3 => 'Środa', 4 => 'Czwartek', 5 => 'Piątek', 6 => 'Sobota', 7 => 'Niedziela'], $lesson->day, ['class' => 'form-control' . ($errors->has('day') ? ' is-invalid' : ''), 'placeholder' => 'Day']) }}
            {!! $errors->first('day', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('lesson_number') }}
            {{ Form::number('lesson_number', $lesson->lesson_number, ['class' => 'form-control' . ($errors->has('lesson_number') ? ' is-invalid' : ''), 'placeholder' => 'Lesson Number']) }}
            {!! $errors->first('lesson_number', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('classroom_number') }}
            {{ Form::text('classroom_number', $lesson->classroom_number, ['class' => 'form-control' . ($errors->has('classroom_number') ? ' is-invalid' : ''), 'placeholder' => 'Classroom Number']) }}
            {!! $errors->first('classroom_number', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', $lesson->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>