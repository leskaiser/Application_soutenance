@extends('layouts.template_other')

@section('title', __('Lock-Screen'))

@section('content')
<div class="account-content">
	<div class="container">
	
		<!-- Account Logo -->
		<div class="account-logo">
			<a href="index.html"><img src="{{asset('assets/img/logo2.png')}}" alt="Dreamguy's Technologies"></a>
		</div>
		<!-- /Account Logo -->
		
		<div class="account-box">
			<div class="account-wrapper">

				<!-- Lock User Img -->
				<div class="lock-user">
					<img alt="" src="{{asset('assets/img/profiles/avatar-02.jpg')}}" class="rounded-circle">
					<h4>John Doe</h4>
				</div>
				<!-- /Lock User Img -->
				
				<!-- Account Form -->
				<form action="index.html">
					<div class="form-group">
						<label>Password</label>
						<input class="form-control" type="password" placeholder="*********">
					</div>
					<div class="form-group text-center">
						<button class="btn btn-primary account-btn" type="submit">Enter</button>
					</div>
					<div class="account-footer">
						<p>Sign in as a different user? <a href="register.html">Login</a></p>
					</div>
				</form>
				<!-- /Account Form -->
				
			</div>
		</div>
	</div>
</div>
@endsection