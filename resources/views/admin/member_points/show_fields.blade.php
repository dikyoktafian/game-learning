<!-- Member Id Field -->
<div class="form-group">
    {!! Form::label('member_id', 'Member Id:') !!}
    <p>{{ $memberPoint->member_id }}</p>
</div>

<!-- Model Type Field -->
<div class="form-group">
    {!! Form::label('model_type', 'Model Type:') !!}
    <p>{{ $memberPoint->model_type }}</p>
</div>

<!-- Model Id Field -->
<div class="form-group">
    {!! Form::label('model_id', 'Model Id:') !!}
    <p>{{ $memberPoint->model_id }}</p>
</div>

<!-- Point Field -->
<div class="form-group">
    {!! Form::label('point', 'Point:') !!}
    <p>{{ $memberPoint->point }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $memberPoint->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $memberPoint->updated_at }}</p>
</div>

