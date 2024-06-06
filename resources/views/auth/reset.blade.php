@extends('layouts.template_other')

@section('title', __('WAN | Reset Password'))

@section('content')
<div class="account-content">
	<div class="container">
		<!-- Account Logo -->
		<div class="account-logo">
			<a href="index.html"><img src="{{asset('assets/img/logo2.png')}}" alt="Wanzoou" title="Wanzoou Logo"></a>
		</div>
		<!-- /Account Logo -->
		
		<div class="account-box">
			<div class="account-wrapper">
				<h3 class="account-title">{{__("Reset Password")}}</h3>
				<p class="account-subtitle">{{__("Your are forgotten your password")}}</p>
				@include('layouts.flash-message')
				<!-- Account Form -->
				<form action="{{route('password.resetProcess')}}" method="POST" id="formResetID">
					@csrf
          <input type="hidden" name="token" value="{{old('token', $token)}}">
					<div class="form-group">
						<label for="email">{{__("Email Address")}}</label>
						<input class="form-control readonly  @error('email') is-invalid @enderror" value="{{old('email', $email)}}" type="email" placeholder="your-email@example.com" name="email" id="email" required readonly>
					</div>
					<div class="form-group">
						<label for="password">{{__("New Password")}}</label>
						<input class="form-control" type="password" placeholder="********" name="password" id="password" required>
					</div>
					<div class="form-group">
						<label for="password_confirmation">{{__("Confirm Password")}}</label>
						<input class="form-control" type="password" placeholder="********" name="password_confirmation" id="password_confirmation" required>
					</div>
					<div class="form-group text-center">
						<button class="btn btn-primary account-btn" type="submit">{{__("Reset Password")}}</button>
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

@section('scripts')
<script>
  $(document).ready(function() {
    $('#formResetID').submit(function(event) {
        var password = $('#password').val();
        var confirmPassword = $('#password_confirmation').val();

        if (password.length < 8) {
          event.preventDefault();
          Swal.fire({title: "Error", text: "Password must consist of at least 8 characters", icon: "error"});
        }
        else if (password !== confirmPassword) {
          event.preventDefault();
          Swal.fire({title: "Error", text: "Password and Password Confirmation doesn't match", icon: "error"});
        }
    });
});
</script>
@endsection