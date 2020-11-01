<!-- Classroom Id Field -->
<div class="form-group">
    {!! Form::label('classroom_id', 'Classroom Id:') !!}
    <p>{{ $classroomDetail->classroom_id }}</p>
</div>

<!-- Member Id Field -->
<div class="form-group">
    {!! Form::label('member_id', 'Member Id:') !!}
    <p>{{ $classroomDetail->member_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $classroomDetail->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $classroomDetail->updated_at }}</p>
</div>

