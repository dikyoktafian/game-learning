<div class="row">
    <div class="col-sm-8">
        <!-- Name Field -->
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Email Field -->
        <div class="form-group">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Password Field -->
        <div class="form-group">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>

        {{-- Password Confirmation Field --}}
        <div class="form-group">
            {!! Form::label('password_confirmation', 'Password Confirmation:') !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-sm-4">
        <!-- Role Id Field -->
        <div class="form-group">
            {!! Form::label('role_id', 'Role Id:') !!}
            {!! Form::select('role_id', $role, null, ['class' => 'form-control select2', 'placeholder' => 'Select Role']) !!}
        </div>

        @if ($auth['role']['name'] === 'superadministrator')
            <!-- Subject Id Field -->
            <div class="form-group">
                {!! Form::label('subject_id', 'Subject Id:') !!}
                {!! Form::select('subject_id', $subject, null, ['class' => 'form-control select2', 'placeholder' => 'Select Subject']) !!}
            </div>

            <!-- Photo Field -->
            <div class="form-group">
                {!! Form::label('photo', 'Photo:') !!}
                {{-- {!! Form::file('photo', ['class' => 'form-control dropify', 'data-default-file' => asset('storage/user/'.(@$user->photo == '' || !$user->photo ? 'default.jpg' : $user->photo) )]) !!} --}}
                {!! Form::file('photo', ['class' => 'form-control dropify', 'data-default-file' => (@$user->photo == '' || !$user->photo ? asset('images/default.jpg') : asset('storage/user/'.$user->photo.'') ) ]) !!}
            </div>
        @endif
    </div>
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
</div>
