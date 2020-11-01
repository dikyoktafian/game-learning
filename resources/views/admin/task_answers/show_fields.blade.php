<!-- Question Id Field -->
<div class="form-group">
    {!! Form::label('question_id', 'Question Id:') !!}
    <p>{{ $taskAnswer->question_id }}</p>
</div>

<!-- Answer Field -->
<div class="form-group">
    {!! Form::label('answer', 'Answer:') !!}
    <p>{{ $taskAnswer->answer }}</p>
</div>

<!-- Label Field -->
<div class="form-group">
    {!! Form::label('label', 'Label:') !!}
    <p>{{ $taskAnswer->label }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $taskAnswer->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $taskAnswer->updated_at }}</p>
</div>

