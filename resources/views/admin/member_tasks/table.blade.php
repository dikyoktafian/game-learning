<div class="table-responsive-sm">
    <table class="table table-striped" id="memberTasks-table">
        <thead>
            <th>Member Id</th>
        <th>Task Id</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </thead>
        <tbody>
        @foreach($memberTasks as $memberTask)
            <tr>
                <td>{{ $memberTask->member_id }}</td>
            <td>{{ $memberTask->task_id }}</td>
            <td>{{ $memberTask->status }}</td>
                <td>
                    {!! Form::open(['route' => ['memberTasks.destroy', $memberTask->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('memberTasks.show', [$memberTask->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('memberTasks.edit', [$memberTask->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>