<div class="row">
    <div class="col-sm-8">
        {{-- Name Field --}}
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        {{-- Email Field --}}
        <div class="form-group">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>

        {{-- Password Field --}}
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

        {{-- Image Field --}}
        <div class="form-group">
            {!! Form::label('photo', 'Image:') !!}
            {{-- {!! Form::file('photo', ['class' => 'form-control dropify', 'data-default-file' => asset('storage/member/'.(@$member->photo == '' || !$member->photo ? 'default.jpg' : $member->photo))]) !!} --}}
            {!! Form::file('photo', ['class' => 'form-control dropify', 'data-default-file' => (@$member->photo == '' || !$member->photo ? asset('images/default.jpg') : asset('storage/member/'.$member->photo.'') ) ]) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <!-- Submit Field -->
        <div class="form-group">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('members.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</div>