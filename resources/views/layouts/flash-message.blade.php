<?php $message = Session::get('message')?>
@if (Session::has('success'))
<div class="message success alert alert alert-border-bottom alert-success bg-gradient alert-dismissible " onclick="this.classList.add('hidden')">
    <i class="fa fa-check pr10"></i>
    <span class="alert-text"><strong>Success!</strong> {{$message}}</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
  </div>
@endif


@if (Session::has('error'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
    <span class="alert-text"><strong>Error!</strong> {{$message}}</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>
@endif

@if (Session::has('warning'))
<div class="alert alert-warning alert-dismissible " role="alert">
    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
    <span class="alert-text"><strong>Warning!</strong> {{$message}}</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>
@endif

@if (Session::has('primary'))
<div class="alert alert-primary alert-dismissible " role="alert">
    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
    <span class="alert-text"><strong>Info!</strong> {{$message}}</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>
@endif

@if ( Session::has('default'))
<div class="alert alert-default alert-dismissible fade show" role="alert">
    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
    <span class="alert-text"><strong>Info!</strong> {{$message}}</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>
@endif


@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>
@endif