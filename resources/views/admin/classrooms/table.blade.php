<div class="table-responsive-sm">
    <table class="table table-striped" id="classrooms-table">
        <thead>
            <th>Name</th>
            <th colspan="3">Action</th>
        </thead>
        <tbody>
        @foreach($classrooms as $classroom)
            <tr>
                <td>{{ $classroom->name }}</td>
                <td>
                    {!! Form::open(['route' => ['classrooms.destroy', $classroom->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('classrooms.show', [$classroom->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('classrooms.edit', [$classroom->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>