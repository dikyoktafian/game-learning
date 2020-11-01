@extends('layouts.app-view')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/animsition/css/animsition.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
@endsection
@section('content')
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="{{ url('member/login') }}" method="POST">
					{!! csrf_field() !!}
					<span class="login100-form-title p-b-43">
						Login to continue
					</span>
					
					@if ($errors->has('failure'))
						<div class="alert alert-danger" role="alert">
							{{ $errors->first('failure') }}
						</div>
					@endif
					@if ($errors->has('success'))
						<div class="alert alert-primary" role="alert">
							{{ $errors->first('success') }}
						</div>
					@endif


					{{-- Email --}}
					<div>
						<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
							<input class="input100" type="text" name="email">
							<span class="focus-input100"></span>
							<span class="label-input100">Email</span>
						</div>
						<span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
					</div>
					
					{{-- Password --}}
					<div>
						<div class="wrap-input100 validate-input" data-validate="Password is required">
							<input class="input100" type="password" name="password">
							<span class="focus-input100"></span>
							<span class="label-input100">Password</span>
						</div>
						<span class="help-block">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					</div>


					{{-- <div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div> --}}
			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Login
						</button>
						{{-- <a href="{{ url('/home') }}" class="login100-form-btn">
							Login
						</a> --}}
					</div>
					
					{{-- <div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							or sign up using
						</span>
					</div> --}}

					{{-- <div class="login100-form-social flex-c-m">
						<a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
							<i class="fa fa-facebook-f" aria-hidden="true"></i>
						</a>

						<a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
							<i class="fa fa-twitter" aria-hidden="true"></i>
						</a>
					</div> --}}
				</form>

				<div class="login100-more" style="background-image: url('images/bg-01.jpg');">
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
@endsection