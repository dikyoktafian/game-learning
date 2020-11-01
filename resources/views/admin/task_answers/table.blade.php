<div class="table-responsive-sm">
    <table class="table table-striped" id="taskAnswers-table">
        <thead>
            <th>Question Id</th>
        <th>Answer</th>
        <th>Label</th>
            <th colspan="3">Action</th>
        </thead>
        <tbody>
        @foreach($taskAnswers as $taskAnswer)
            <tr>
                <td>{{ $taskAnswer->question_id }}</td>
            <td>{{ $taskAnswer->answer }}</td>
            <td>{{ $taskAnswer->label }}</td>
                <td>
                    {!! Form::open(['route' => ['taskAnswers.destroy', $taskAnswer->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('taskAnswers.show', [$taskAnswer->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('taskAnswers.edit', [$taskAnswer->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>