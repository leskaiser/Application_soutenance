@extends('layouts.template_other')

@section('title', __('WAN | Reset Password'))

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
				<h3 class="account-title">{{__("Reset Password")}}</h3>
				<p class="account-subtitle">{{__("Your are forgotten your password")}}</p>
				@include('layouts.flash-message')
				<!-- Account Form -->
				<form action="{{route('resetPassword')}}" method="POST">
					@csrf
					<div class="form-group">
						<label>{{__("Email Address")}}</label>
						<input class="form-control  @error('email') is-invalid @enderror" value="{{old('email')}}" type="email" placeholder="your-email@example.com" name="email" id="email" required>
					</div>
					<div class="form-group text-center">
						<button class="btn btn-primary account-btn" type="submit">{{__("Send Email")}}</button>
					</div>
					<div class="account-footer">
						<p>{{__("Don't have an account yet?")}} <a href="register.html">{{__("Register")}}</a></p>
					</div>
				</form>
				<!-- /Account Form -->
				
			</div>
		</div>
	</div>
</div>
@endsection