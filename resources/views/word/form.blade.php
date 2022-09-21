<div class="box box-info padding-1">
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $word->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name', 'autocomplete'=>'off']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('translation') }}
            {{ Form::text('translation', $word->translation, ['class' => 'form-control' . ($errors->has('translation') ? ' is-invalid' : ''), 'placeholder' => 'Translation', 'autocomplete'=>'off']) }}
            {!! $errors->first('translation', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('name_info') }}
            {{ Form::text('name_info', $word->name_info, ['class' => 'form-control' . ($errors->has('name_info') ? ' is-invalid' : ''), 'placeholder' => 'Informacja do nazwy']) }}
            {!! $errors->first('name_info', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('translation_info') }}
            {{ Form::text('translation_info', $word->translation_info, ['class' => 'form-control' . ($errors->has('translation_info') ? ' is-invalid' : ''), 'placeholder' => 'Informacja do tłumaczenia']) }}
            {!! $errors->first('translation_info', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('mw', 'Multisłowo') }}
            {{ Form::checkbox('mw', null, $word->mw, ['class' => '' . ($errors->has('mw') ? ' is-invalid' : ''), 'id' => 'mw']) }}
            {!! $errors->first('mw', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('iw', 'Odmiana') }}
            {{ Form::checkbox('iw', null, $word->iw, ['class' => '' . ($errors->has('iw') ? ' is-invalid' : ''), 'id' => 'iw']) }}
            {!! $errors->first('iw', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('mt', 'Multitłumaczenia') }}
            {{ Form::checkbox('mt', null, $word->mt, ['class' => '' . ($errors->has('mt') ? ' is-invalid' : ''), 'id' => 'mt']) }}
            {!! $errors->first('mt', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>