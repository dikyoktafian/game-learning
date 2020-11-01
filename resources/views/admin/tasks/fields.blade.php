<div class="row">
    <div class="col-sm-9">
        {!! Form::hidden('created_by', Auth::user()->id) !!}

        <!-- Task Field -->
        <div class="form-group">
            {!! Form::label('task', 'Task *:') !!}
            {!! Form::text('task', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>

        <!-- Summary Field -->
        <div class="form-group">
            {!! Form::label('summary', 'Summary *:') !!}
            {!! Form::textarea('summary', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>

    </div>
    <div class="col-sm-3">
        <!-- Classroom Field -->
        <div class="form-group">
            {!! Form::label('classroom_id', 'Classroom *:') !!}
            {!! Form::select('classroom_id', $classroom, null, ['class' => 'form-control select2', 'placeholder' => 'Select Classroom', 'required' => 'required']) !!}
        </div>

        <!-- Point Field -->
        <div class="form-group">
            {!! Form::label('point', 'Point *:') !!}
            {!! Form::number('point', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 warp-add">
        @if (@$task)
            @foreach ($task->question as $key => $item)
                <div class="card card-question">
                    {!! Form::hidden('question['.$key.'][id]', @$item->id) !!}
                    {!! Form::hidden('question['.$key.'][task_id]', @$task->id) !!}
                    {!! Form::hidden('question['.$key.'][attach]', null) !!}
                    <div class="align-items-center card-header d-flex justify-content-between">
                        <h5 class="mb-0">Question #{{$key+1}}</h5>
                        <div class="btn btn-danger remove" data-id="{{ $item->id }}"><ion-icon name="close"></ion-icon></div>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-9">
                                {{-- Question --}}
                                <div class="form-group">
                                    {!! Form::label('question', 'Question *:') !!}
                                    {!! Form::text('question['.$key.'][question]', @$item->question, ['class' => 'form-control', 'required' => 'required']) !!}
                                </div>

                                {{-- Answer --}}
                                <div class="row">
                                    @foreach ($item->answer as $keyIn => $itemIn)
                                        {!! Form::hidden('question['.$key.'][answer]['.$keyIn.'][id]', null) !!}
                                        {!! Form::hidden('question['.$key.'][answer]['.$keyIn.'][question_id]', null) !!}
                                        {!! Form::hidden('question['.$key.'][answer]['.$keyIn.'][label]', $label[$keyIn]) !!}
                                        <div class="form-group col-sm-6">
                                            {!! Form::label('question['.$key.'][answer]['.$keyIn.'][answer]', 'Answer '.$label[$keyIn]. ' *:') !!}
                                            {!! Form::text('question['.$key.'][answer]['.$keyIn.'][answer]', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                            <div class="custom-control custom-radio">
                                                <input type="radio" {{ ($itemIn->correct === 1)? "checked" : "" }} id="question-{{$key.'-'.$keyIn}}" name="question[{{$key}}][answer][{{$keyIn}}][correct]" class="custom-control-input input-{{$key}}" value="1">
                                                <label class="custom-control-label" for="question-{{$key.'-'.$keyIn}}">Make this answer true</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                            </div>
                            <div class="col-sm-3">

                                {{-- Point --}}
                                <div class="form-group">
                                    {!! Form::label('question['.$key.'][point]', 'Point *:') !!}
                                    {!! Form::number('question['.$key.'][point]', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                </div>

                                {{-- Image Field --}}
                                <div class="form-group">
                                    {!! Form::label('question['.$key.'][image_new]', 'Image:') !!}
                                    {!! Form::file('question['.$key.'][image_new]', ['class' => 'form-control dropify', 'data-default-file' => asset('storage/question/'.$item['image'])]) !!}
                                    {!! Form::hidden('question['.$key.'][image]', null) !!}
                                    <small id="imageHelp" class="form-text text-muted">Boleh kosong.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="col-sm-12">
        <div class="btn btn-primary mb-5 w-100" href="" role="button" id="add">+ Add Question</div>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::hidden('del', null, ['class' => 'form-control']) !!}
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
</div>


@section('scripts')
    <script>
        function checked() {
            $('.card-question').each(function (i,v) {
                $('input[type=radio].input-'+i+'').change(function() {
                    $('input[type=radio].input-'+i+':checked').not(this).prop('checked', false);
                });
            })
        }

        $(document).ready(function () {
            checked();
        })

        $(document).on('click', '#add', function (){
            var leng = $('.warp-add > .card-question').length;
            $('.warp-add').append(`
                <div class="card card-question">
                    {!! Form::hidden('question[${leng}][id]', null) !!}
                    {!! Form::hidden('question[${leng}][task_id]', null) !!}
                    {!! Form::hidden('question[${leng}][attach]', null) !!}
                    <div class="align-items-center card-header d-flex justify-content-between">
                        <h5 class="mb-0">Question #${leng + 1}</h5>
                        <div class="btn btn-danger remove"><ion-icon name="close"></ion-icon></div>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-9">
                                {{-- Question --}}
                                <div class="form-group">
                                    {!! Form::label('question', 'Question *:') !!}
                                    {!! Form::text('question[${leng}][question]', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                </div>

                                {{-- Answer --}}
                                <div class="row">
                                    @foreach ($label as $keyIn => $itemIn)
                                        {!! Form::hidden('question[${leng}][answer]['.$keyIn.'][id]', null) !!}
                                        {!! Form::hidden('question[${leng}][answer]['.$keyIn.'][question_id]', null) !!}
                                        {!! Form::hidden('question[${leng}][answer]['.$keyIn.'][label]', $label[$keyIn]) !!}
                                        <div class="form-group col-sm-6">
                                            {!! Form::label('question[${leng}][answer]['.$keyIn.'][answer]', 'Answer '.$label[$keyIn]. ' *:') !!}
                                            {!! Form::text('question[${leng}][answer]['.$keyIn.'][answer]', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="question-${leng}-{{$keyIn}}" name="question[${leng}][answer][{{$keyIn}}][correct]" class="custom-control-input input-${leng}" value="1">
                                                <label class="custom-control-label" for="question-${leng}-{{$keyIn}}">Make this answer true</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                            </div>
                            <div class="col-sm-3">

                                {{-- Point --}}
                                <div class="form-group">
                                    {!! Form::label('question[${leng}][point]', 'Point *:') !!}
                                    {!! Form::number('question[${leng}][point]', null, ['class' => 'form-control']) !!}
                                </div>

                                {{-- Image Field --}}
                                <div class="form-group">
                                    {!! Form::label('question[${leng}][image_new]', 'Image:') !!}
                                    {!! Form::file('question[${leng}][image_new]', ['class' => 'form-control dropify']) !!}
                                    {!! Form::hidden('question[${leng}][image]', null) !!}
                                    <small id="imageHelp" class="form-text text-muted">Boleh kosong.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `);
            dropify(); // app-blade
            checked();
        });

        // Delete data
        var del = [];
        $(document).on('click', '.remove', function (){
            var id = $(this).data('id');
            del.push(id);
            
            $(this).parents('.card-question').remove();
            $('input[name=del]').val(del);
        });

    </script>
@endsection