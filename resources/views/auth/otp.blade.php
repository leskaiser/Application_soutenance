@extends('layouts.template_other')

@section('title', __('OTP'))

@section('content')
<div class="account-content">
	<div class="container">
	
		<!-- Account Logo -->
		<div class="account-logo">
			<a href="index.html"><img src="assets/img/logo2.png" alt="Dreamguy's Technologies"></a>
		</div>
		<!-- /Account Logo -->
		
		<div class="account-box">
			<div class="account-wrapper">
				<h3 class="account-title">OTP</h3>
				<p class="account-subtitle">Verification your account</p>
				
				<!-- Account Form -->
				<form action="index.html">
					<div class="otp-wrap">
						<input type="text" placeholder="0" maxlength="1" class="otp-input">
						<input type="text" placeholder="0" maxlength="1" class="otp-input">
						<input type="text" placeholder="0" maxlength="1" class="otp-input">
						<input type="text" placeholder="0" maxlength="1" class="otp-input">
					</div>
					<div class="form-group text-center">
						<button class="btn btn-primary account-btn" type="submit">Enter</button>
					</div>
					<div class="account-footer">
						<p>Not yet received? <a href="javascript:void(0);">Resend OTP</a></p>
					</div>
				</form>
				<!-- /Account Form -->
				
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
</script>
@endsection