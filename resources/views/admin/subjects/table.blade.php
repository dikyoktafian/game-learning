<div class="table-responsive-sm">
    <table class="table table-striped" id="subjects-table">
        <thead>
            <th>Name</th>
            <th colspan="3">Action</th>
        </thead>
        <tbody>
        @foreach($subjects as $subject)
            <tr>
                <td>{{ $subject->name }}</td>
                <td>
                    {!! Form::open(['route' => ['subjects.destroy', $subject->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('subjects.show', [$subject->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('subjects.edit', [$subject->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>