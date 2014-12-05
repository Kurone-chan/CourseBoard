@extends('layouts.master')
@section('body')
  <div class="jumbotron jumbotron-default" style="margin-top:50px;">
    <div class="container">
      <h3>{{ $course->uid }}: {{ $course->name }}</h3>
      <p>{{ $course->about }}</p>
    </div>
  </div>
@stop
