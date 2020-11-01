@extends('layouts.app-view')

@section('content')
    <div class="container home">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                
                <section class="home-user">
                    {{-- USER --}}
                    <div class="row user">
                        <div class="col-sm-2">
                            <a href="#"><img width="100%" src="{{ ($user['photo'] ? asset('storage/member/'.$user['photo'].'') : asset('images/default.jpg') ) }}" alt="user" class="user-img"></a>
                        </div>
                        <div class="col-sm">
                            <h2 class="h1"><a href="#">{{ $user['name'] }}</a></h2>
                        </div>
                        <div class="logout">
                            <a class="btn btn-danger" href="{{ url('/member/logout') }}">Logout</a>
                        </div>
                    </div>
    
                    {{-- POINT - RANK --}}
                    <div class="row points">
                        <div class="col-6">
                            <div class="key">Rank</div>
                            <div class="value h2"><a href="{{ url('leaderboard') }}">{{ ($user['point'] === 0 ? 0 : $user['rank']) }}</a></div>
                        </div>
                        <div class="col-6">
                            <div class="key">Points</div>
                            <div class="value h2">{{ $user['point'] }}</div>
                        </div>
                    </div>
                </section>
                <section class="home-card">

                    {{-- CARD --}}
                    <div class="row cards">
                        <div class="col-6">
                            <a href="{{ url('task') }}" class="card shadow">
                                <div class="title h5">Tugas 
                                    {{-- <span class="badge badge-danger">9</span> --}}
                                    <span class="line"></span>
                                </div>
                                <div class="icon">
                                    <img src="https://via.placeholder.com/70" alt="play-icon">
                                </div>
                            </a>
                        </div>
                        {{-- <div class="col-6">
                            <a href="{{ url('class') }}" class="card shadow">
                                <div class="title h5">Materi <span class="badge badge-danger">5</span>
                                    <span class="line"></span>
                                </div>
                                <div class="icon">
                                    <img src="https://via.placeholder.com/70" alt="play-icon">
                                </div>
                            </a>
                        </div> --}}
                        {{-- <div class="col-6">
                            <a href="{{ url('absent') }}" class="card shadow">
                                <div class="title h5">Exam <span class="badge badge-danger">2</span>
                                    <span class="line"></span>
                                </div>
                                <div class="icon">
                                    <img src="https://via.placeholder.com/70" alt="play-icon">
                                </div>
                            </a>
                        </div> --}}
                        {{-- <div class="col-6">
                            <a href="#" class="card shadow">
                                <div class="title h5">Calendar
                                    <span class="line"></span>
                                </div>
                                <div class="icon">
                                    <img src="https://via.placeholder.com/70" alt="play-icon">
                                </div>
                            </a>
                        </div> --}}
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection