@extends('layouts.app-view')

@section('content')
    <div class="container task">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="row">
                    <div class="col-lg-12 mt-3">

                        {{-- Back --}}
                        <a class="my-3 d-inline-block" href="{{ url('/home') }}"><ion-icon size="large" name="ios-arrow-round-back"></ion-icon></a>

                        {{-- ACCORDION --}}
                        <div id="accordion">

                            {{-- <a class="btn btn-danger mb-4" href="{{ url('home') }}">Back</a> --}}

                            {{-- CARD --}}
                            @foreach ($task as $key => $item)
                                <div class="card shadow">
                                    <div class="" id="heading{{$key}}">
                                        <h5 class="align-items-center d-flex justify-content-between mb-0">
                                            <button aria-controls="collapse{{$key}}" 
                                            aria-expanded="{{ $key == 0 ? 'true' : 'false' }}" 
                                            class="btn btn-link" 
                                            data-target="#collapse{{$key}}" 
                                            data-toggle="collapse">
                                                <i class="icon ion-ios-arrow-dropdown"></i>
                                            </button>
                                            <span>{{ $item['name'] }}</span>
                                            <img class="rounded-circle p-1" src="{{ ($item['teacher']['photo'] ? asset('storage/user/'.$item['teacher']['photo'].'') : asset('images/default.jpg') ) }}" alt="teacher-img">
                                        </h5>
                                    </div>
                                    <div aria-labelledby="heading{{$key}}" class="collapse {{ $key == 0 ? 'show' : '' }}" data-parent="#accordion" id="collapse{{$key}}">
                                        @foreach ($item['teacher']['task'] as $task)
                                            @if ($task['membertask'])
                                                <a class="card-body complete" href="{{ url('task/'.$task['id']) }}">Task Complete!</a>
                                            @else
                                                <div class="card-body">
                                                    <a href="{{ url('task/'.$task['id']) }}">{{ $task['task'] }}</a>
                                                    <div class="reward">{{ $task['point'] }}<br>pts</div>
                                                </div>
                                            @endif
                                        @endforeach
                                        {{-- <div class="card-body complete">Task Complete!</div> --}}
                                        {{-- <div class="card-body complete">Task Complete!</div> --}}
                                    </div>
                                </div>
                            @endforeach

                            {{-- CARD --}}
                            {{-- <div class="card shadow">
                                <div class="" id="headingTwo">
                                    <h5 class="align-items-center d-flex justify-content-between mb-0">
                                        <button aria-controls="collapseTwo" 
                                        aria-expanded="false" 
                                        class="btn btn-link" 
                                        data-target="#collapseTwo" 
                                        data-toggle="collapse">
                                            <i class="icon ion-ios-arrow-dropdown"></i>
                                        </button>
                                        <span>Matematika</span>
                                        <img class="rounded-circle p-1" src="https://via.placeholder.com/40" alt="teacher-img">
                                    </h5>
                                </div>
                                <div aria-labelledby="headingTwo" class="collapse" data-parent="#accordion" id="collapseTwo">
                                    <div class="card-body">
                                        <a href="{{ url('task/1') }}">Win a raid</a>
                                        <div class="reward">200<br>pts</div>
                                    </div>
                                    <div class="card-body complete">Task Complete!</div>
                                    <div class="card-body complete">Task Complete!</div>
                                </div>
                            </div> --}}

                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection