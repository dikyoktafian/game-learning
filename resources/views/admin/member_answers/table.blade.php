<div class="table-responsive-sm">
    <table class="table table-striped" id="memberAnswers-table">
        <thead>
            <th>Member Id</th>
        <th>Task Id</th>
        <th>Question Id</th>
        <th>Answer Id</th>
            <th colspan="3">Action</th>
        </thead>
        <tbody>
        @foreach($memberAnswers as $memberAnswer)
            <tr>
                <td>{{ $memberAnswer->member_id }}</td>
            <td>{{ $memberAnswer->task_id }}</td>
            <td>{{ $memberAnswer->question_id }}</td>
            <td>{{ $memberAnswer->answer_id }}</td>
                <td>
                    {!! Form::open(['route' => ['memberAnswers.destroy', $memberAnswer->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('memberAnswers.show', [$memberAnswer->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('memberAnswers.edit', [$memberAnswer->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>