@extends('layouts.app-view')

@section('content')
    <div class="container materi">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="row">
                    <div class="col-lg-12">

                        {{-- ACCORDION --}}
                        <div id="accordion" class="mt-5">

                            {{-- CARD --}}
                            <div class="card shadow">
                                <div class="" id="headingOne">
                                    <h5 class="align-items-center d-flex justify-content-between mb-0">
                                        <button aria-controls="collapseOne" 
                                        aria-expanded="true" 
                                        class="btn btn-link" 
                                        data-target="#collapseOne" 
                                        data-toggle="collapse">
                                            <i class="icon ion-ios-arrow-dropdown"></i>
                                        </button>
                                        <span>Matematika</span>
                                        <img class="rounded-circle p-1" src="https://via.placeholder.com/40" alt="teacher-img">
                                    </h5>
                                </div>
                                <div aria-labelledby="headingOne" class="collapse show" data-parent="#accordion" id="collapseOne">
                                    <div class="card-body">
                                        <a href="{{ url('task/1') }}">Win a raid</a>
                                        <div class="reward">200<br>pts</div>
                                    </div>
                                    <div class="card-body complete">Task Complete!</div>
                                    <div class="card-body complete">Task Complete!</div>
                                </div>
                            </div>

                            {{-- CARD --}}
                            <div class="card shadow">
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
                            </div>

                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection