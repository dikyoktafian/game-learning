@section('css')
    <style>
        /* .answ {
            background-color: gray;
            padding: 15px;
            min-height: 80px;
            color: white;
        } */
        td.table-danger.table-success {
            background-color: #c3e6cb;
        }

    </style>
@endsection

<!-- Task Field -->
<div class="form-group">
    {!! Form::label('task', 'Task:') !!}
    <p>{{ $task->task }}</p>
</div>

<!-- Summary Field -->
<div class="form-group">
    {!! Form::label('summary', 'Summary:') !!}
    <p>{{ $task->summary }}</p>
</div>

<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{{ $task->created_by }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $task->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $task->updated_at }}</p>
</div>


{{-- <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Question</th>
                <th scope="col">Image</th>
                <th scope="col">Answer A</th>
                <th scope="col">Answer B</th>
                <th scope="col">Answer C</th>
                <th scope="col">Answer D</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit eligendi eum, nisi earum natus optio, vitae doloribus et quidem aliquam dolor, cupiditate veritatis recusandae iste a at. Quos, expedita autem?</td>
                <td><img src="https://via.placeholder.com/800x400" alt="img" width="400px"></td>
                <td>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quos, quae.</td>
                <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nihil, ipsa.</td>
                <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Numquam, accusantium.</td>
                <td>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Pariatur, nemo.</td>
            </tr>
        </tbody>
    </table>
</div> --}}

<div id="accordion">
    @foreach ($answer as $key => $item)
        <div class="card mb-2">
            <div class="card-header" id="heading{{ $key }}">
                <h5 class="mb-0"><button aria-controls="collapse{{$key}}" aria-expanded="false" class="btn btn-link" data-target="#collapse{{$key}}" data-toggle="collapse">{{ $item->member->name }}</button></h5>
            </div>
            <div aria-labelledby="heading{{ $key }}" class="collapse" data-parent="#accordion" id="collapse{{$key}}">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Question</th>
                                <th scope="col">Image</th>
                                <th scope="col">Answer A</th>
                                <th scope="col">Answer B</th>
                                <th scope="col">Answer C</th>
                                <th scope="col">Answer D</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->task->question as $keyIn => $itemIn)
                                <tr>
                                    <th scope="row">{{ $keyIn+1 }}</th>
                                    <td>{{ $itemIn->question }}</td>
                                    <td>
                                        @if (!empty($itemIn->image))
                                            <img src="{{ asset('storage/question/'.$itemIn->image) }}" alt="{{ $itemIn->question }}" width="400px">
                                        @endif
                                    </td>
                                    @foreach ($itemIn->answer as $keyInx => $itemx)
                                        {{-- <td class="{{ $itemx->correct === 1 ? 'table-success' : '' }} {{ $answer[$key]['correct']['correct'] === 1 && $itemx->correct === 1 ? 'tes' : '' }}">{{$itemx->answer}}</td> --}}
                                        <td class="{{ $itemx->id === $item->answer[$keyIn]->answer_id ? 'table-danger' : '' }} {{ $itemx->correct === 1 ? 'table-success' : '' }}">{{$itemx->answer}}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- <div class="card-body">
                   <h3>Question </h3>
                   <img src="https://via.placeholder.com/800x400" alt="question" width="400px">
                   <div class="row mt-3">
                        <div class="col-sm-6">
                            <div class="answ mb-3">Answer </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="answ mb-3">Answer </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="answ mb-3">Answer </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="answ mb-3">Answer </div>
                        </div>
                   </div>
                </div>
                <div class="card-body">
                   <h3>Question </h3>
                   <img src="https://via.placeholder.com/800x400" alt="question" width="400px">
                   <div class="row mt-3">
                        <div class="col-sm-6">
                            <div class="answ mb-3">Answer </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="answ mb-3">Answer </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="answ mb-3">Answer </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="answ mb-3">Answer </div>
                        </div>
                   </div>
                </div> --}}
            </div>
        </div>
    @endforeach
</div>


