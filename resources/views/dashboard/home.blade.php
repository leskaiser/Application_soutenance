@extends('layouts.template')

@section('content')
    {{Auth::user()->first_name}}
@endsection