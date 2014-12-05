@extends('layouts.master')
@section('body')
  <div class="container-fluid" style="margin-top:85px;">
    <div class="row-fluid">
      <div class="col-lg-3"></div>
      <div class="col-lg-6">
        <h3 class="page-header">Thank you for registering, {{ $firstname }}!</h3>
        <p class="lead">We have sent an email to you at {{ $email }} explaining what you should do next to start collaborating within groups and communities. Please check your email when you get the chance!</p>
        <br>
        <p class="lead">Please click <a href="{{ URL::to('') }}">here</a> to return to the homepage.</p>
      </div>
      <div class="col-lg-3"></div>
    </div>
  </div>
@stop