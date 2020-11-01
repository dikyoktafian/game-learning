<!-- Member Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('member_id', 'Member Id:') !!}
    {!! Form::text('member_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Task Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('task_id', 'Task Id:') !!}
    {!! Form::text('task_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Question Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question_id', 'Question Id:') !!}
    {!! Form::text('question_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Answer Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('answer_id', 'Answer Id:') !!}
    {!! Form::text('answer_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('memberAnswers.index') }}" class="btn btn-secondary">Cancel</a>
</div>
