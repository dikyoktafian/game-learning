<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('students', 'Student:') !!}
    @if (!empty($classroom))
        {!! Form::select('students[]', $students, @$classroom['students']->pluck('student.id'), ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
    @else
        {!! Form::select('students[]', $students, null, ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
    @endif
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('classrooms.index') }}" class="btn btn-secondary">Cancel</a>
</div>
