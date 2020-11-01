<!-- Member Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('member_id', 'Member Id:') !!}
    {!! Form::text('member_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Model Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('model_type', 'Model Type:') !!}
    {!! Form::text('model_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Model Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('model_id', 'Model Id:') !!}
    {!! Form::text('model_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Point Field -->
<div class="form-group col-sm-6">
    {!! Form::label('point', 'Point:') !!}
    {!! Form::text('point', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('memberPoints.index') }}" class="btn btn-secondary">Cancel</a>
</div>
