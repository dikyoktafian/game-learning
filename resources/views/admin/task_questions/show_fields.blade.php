<!-- Task Id Field -->
<div class="form-group">
    {!! Form::label('task_id', 'Task Id:') !!}
    <p>{{ $taskQuestion->task_id }}</p>
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', 'Image:') !!}
    <p>{{ $taskQuestion->image }}</p>
</div>

<!-- Attach Field -->
<div class="form-group">
    {!! Form::label('attach', 'Attach:') !!}
    <p>{{ $taskQuestion->attach }}</p>
</div>

<!-- Question Field -->
<div class="form-group">
    {!! Form::label('question', 'Question:') !!}
    <p>{{ $taskQuestion->question }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $taskQuestion->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $taskQuestion->updated_at }}</p>
</div>

