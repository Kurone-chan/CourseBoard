@extends('layouts.master')
@section('body')

<div class="container-fluid" style="margin-top:120px;">
  <div class="row-fluid">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">

      <p class="text-danger">
        {{ $errors->first('email') }}
        {{ $errors->first('password') }}
      </p>

      <h3 class="page-header">Sign in to {{ Config::get('app.projectname') }}</h3>
      {{ Form::open(array('url' => 'login')) }}

        <div class="form-group">
          {{ Form::label('email', 'Email') }}
          {{ Form::email('email', '', array('class' => 'form-control', 'placeholder' => 'Email Address')) }}
        </div>

        <div class="form-group">
          {{ Form::label('password', 'Password') }}
          {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
        </div>

        {{ Form::token() }}

        {{ Form::submit('Sign In', array('class' => 'btn btn-primary')) }}

      {{ Form::close() }}
    </div>
    <div class="col-lg-3"></div>
  </div>
</div>

@stop