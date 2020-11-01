<!-- Member Id Field -->
<div class="form-group">
    {!! Form::label('member_id', 'Member Id:') !!}
    <p>{{ $memberAnswer->member_id }}</p>
</div>

<!-- Task Id Field -->
<div class="form-group">
    {!! Form::label('task_id', 'Task Id:') !!}
    <p>{{ $memberAnswer->task_id }}</p>
</div>

<!-- Question Id Field -->
<div class="form-group">
    {!! Form::label('question_id', 'Question Id:') !!}
    <p>{{ $memberAnswer->question_id }}</p>
</div>

<!-- Answer Id Field -->
<div class="form-group">
    {!! Form::label('answer_id', 'Answer Id:') !!}
    <p>{{ $memberAnswer->answer_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $memberAnswer->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $memberAnswer->updated_at }}</p>
</div>

