@extends('layouts.master')
@section('body')
<div class="jumbotron jumbotron-primary" style="margin-top:50px;">
  <div class="container">
    <h3 class="jheading-white">Account Settings</h3>
    <p class="jsub-white">Change your account information here.</p>
  </div>
</div>

<div class="panel panel-default navsub-bg" style="margin-top:-30px;">
  <div class="container">
    <div class="panel-body navsub">
      <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('') }}"><i class="fa fa-desktop"></i> Dashboard</a></li>
        <li class="active"><a href="{{ URL::to('account') }}"><i class="fa fa-gear"></i> Account Settings</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ URL::to('logout') }}"><i class="fa fa-sign-out"></i> Sign Out</a></li>
      </ul>
    </div>
  </div>
</div>

<div class="container-fluid" style="margin-top:30px;">
  <div class="row-fluid">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
      <h3 class="page-header">Account Information</h3>
      {{ Form::open(array('url' => 'updateaccountinfo')) }}
      <div class="form-group">
        {{ Form::label('firstname', 'First Name') }}
        {{ Form::text('firstname', Auth::user()->firstname, array('class' => 'form-control')) }}
      </div>
      <div class="form-group">
        {{ Form::label('lastname', 'Last Name') }}
        {{ Form::text('lastname', Auth::user()->lastname, array('class' => 'form-control')) }}
      </div>
      <div class="form-group">
        {{ Form::label('email', 'Email Address') }}
        {{ Form::text('email', Auth::user()->email, array('class' => 'form-control')) }}
      </div>
      {{ Form::token() }}
      {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
      {{ Form::close() }}
    <div class="col-lg-1"></div>
  </div>
</div>
@stop
