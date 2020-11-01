<div class="table-responsive-sm">
    <table class="table table-striped" id="members-table">
        <thead>
            <th>Photo</th>
            <th>Name</th>
            <th colspan="3">Action</th>
        </thead>
        <tbody>
        @foreach($members as $member)
            <tr>
                <td><img src="{{ ($member->photo == '' || !$member->photo ? asset('images/default.jpg') : asset('storage/member/'.$member->photo.'')) }}" alt=""></td>
                <td>{{ $member->name }}</td>
                <td>
                    {!! Form::open(['route' => ['members.destroy', $member->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('members.show', [$member->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('members.edit', [$member->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>