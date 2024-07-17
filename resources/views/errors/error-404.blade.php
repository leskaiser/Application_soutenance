@extends('errors.template')

@section('title',__('404-Error'))

@section('css')
	<!-- Lineawesome CSS -->
			<link rel="stylesheet" href="{{asset('assets/css/line-awesome.min.css')}}">

@endsection

@section('content')
<div class="error-box">
	<h1>{{ $errorCode }}</h1>
	<h3><i class="fa fa-warning"></i> An Error Occurred</h3>
	<h4>{{ $errorMessage }}</h4>
  <p>We apologize for the inconvenience. Please try again later or contact support if the problem persists.</p>
	<a href="{{route('home')}}" class="btn btn-custom">Back to Home</a>
</div>
@endsection

