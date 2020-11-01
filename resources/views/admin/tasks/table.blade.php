<div class="table-responsive-sm">
    <table class="table table-striped" id="tasks-table">
        <thead>
            <th>Task</th>
        <th>Summary</th>
        <th>Created By</th>
            <th colspan="3">Action</th>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr>
                <td>{{ $task->task }}</td>
            <td>{{ $task->summary }}</td>
            <td>{{ $task->created_by }}</td>
                <td>
                    {!! Form::open(['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('tasks.show', [$task->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('tasks.edit', [$task->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>