<!-- Classroom Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('classroom_id', 'Classroom Id:') !!}
    {!! Form::text('classroom_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Member Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('member_id', 'Member Id:') !!}
    {!! Form::text('member_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('classroomDetails.index') }}" class="btn btn-secondary">Cancel</a>
</div>
