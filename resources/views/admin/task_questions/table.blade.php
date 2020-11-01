<div class="table-responsive-sm">
    <table class="table table-striped" id="taskQuestions-table">
        <thead>
            <th>Task Id</th>
        <th>Image</th>
        <th>Attach</th>
        <th>Question</th>
            <th colspan="3">Action</th>
        </thead>
        <tbody>
        @foreach($taskQuestions as $taskQuestion)
            <tr>
                <td>{{ $taskQuestion->task_id }}</td>
            <td>{{ $taskQuestion->image }}</td>
            <td>{{ $taskQuestion->attach }}</td>
            <td>{{ $taskQuestion->question }}</td>
                <td>
                    {!! Form::open(['route' => ['taskQuestions.destroy', $taskQuestion->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('taskQuestions.show', [$taskQuestion->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('taskQuestions.edit', [$taskQuestion->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>