@extends('errors.template')

@section('title',__('404-Error'))

@section('css')		
	<!-- Lineawesome CSS -->
			<link rel="stylesheet" href="{{asset('assets/css/line-awesome.min.css')}}">
@endsection

@section('content')
<div class="error-box">
	<h1>404</h1>
	<h3><i class="fa fa-warning"></i> Oops! Page not found!</h3>
	<p>The page you requested was not found.</p>
	<a href="{{route('home')}}" class="btn btn-custom">Back to Home</a>
</div>
@endsection

