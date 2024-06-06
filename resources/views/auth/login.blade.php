@extends('layouts.template_other')

@section('title', __('WAN | Login Page'))

@section('content')
<div class="account-content">
	<div class="container">
		<!-- Account Logo -->
		<div class="account-logo">
			<a href="index.html"><img src="{{__('assets/img/logo2.png')}}" alt="Dreamguy's Technologies"></a>
		</div>
		<!-- /Account Logo -->
		
		<div class="account-box">
			<div class="account-wrapper">
				<h3 class="account-title">Login</h3>
				<p class="account-subtitle">Access to our dashboard</p>
				@include('layouts.flash-message')
				<!-- Account Form -->
				<form action="{{route('sign-in')}}" method="POST">
					@csrf
					<div class="form-group">
						<label>Email Address</label>
						<input class="form-control  @error('email') is-invalid @enderror" value="{{old('email')}}" type="email" placeholder="your-email@example.com" name="email" id="email" required>
						@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col">
								<label>Password</label>
							</div>
							<div class="col-auto">
								<a class="text-muted" href="{{route('forgotPassword')}}">
									Forgot password?
								</a>
							</div>
						</div>
						<input class="form-control  @error('password') is-invalid @enderror" type="password" placeholder="*********" name="password" id="password" required>
						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					{{-- <div class="form-check">
						<input class="form-check-input" type="checkbox" name="remember" id="remember">
						<label for="remember" class="form-check-label">Remember me</label>
					</div> --}}
					<div class="form-group text-center">
						<button class="btn btn-primary account-btn" type="submit">Login</button>
					</div>
					<div class="account-footer">
						<p>Don't have an account yet? <a href="register.html">Register</a></p>
					</div>
				</form>
				<!-- /Account Form -->
				
			</div>
		</div>
	</div>
</div>
@endsection