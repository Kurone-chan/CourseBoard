@extends('layouts.master')
@section('body')

<div class="container-fluid" style="margin-top:85px;">
  <div class="row-fluid">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">

      <h3 class="page-header">Welcome to {{ Config::get('app.projectname') }}!</h3>
      <p class="lead">{{ Config::get('app.projectname') }} is an easy way for students and faculty to simply and effortlessly share course information, notes, ideas, and anything else.</p>

      <div class="media">
        <span class="fa-stack fa-lg fa-3x pull-left media-object">
          <i class="fa fa-circle-thin fa-stack-2x"></i>
          <i class="fa fa-exchange fa-stack-1x"></i>
        </span>
        <div class="media-body">
          <h4 class="media-heading" style="margin-top:23px;">Collaborate and Exchange Information</h4>
          {{ Config::get('app.projectname') }} allows members of the academic community to join together and publically or privately share information through institution-created or privately-created workgroups. Professors can create class groups to provide notes, assignments, or files to their students. Anyone can also create private workgroups to share files between the members invited to these workgroups.
        </div>
      </div>

      <div class="media">
        <span class="fa-stack fa-lg fa-3x pull-left media-object">
          <i class="fa fa-circle-thin fa-stack-2x"></i>
          <i class="fa fa-graduation-cap fa-stack-1x"></i>
        </span>
        <div class="media-body">
          <h4 class="media-heading" style="margin-top:23px;">Created by Students, For Students</h4>
          Lets face it, companies and organizations do not know how students work. {{ Config::get('app.projectname') }} was created by college students who actually know what it is like to <i>be a student</i>. This collaboration tool was created with students in mind, allowing flexability and ease-of-access in a otherwise stressful and hard-working environment that students have to live through.
        </div>
      </div>

      <div class="media">
        <span class="fa-stack fa-lg fa-3x pull-left media-object">
          <i class="fa fa-usd fa-stack-1x"></i>
          <i class="fa fa-ban fa-stack-2x"></i>
        </span>
        <div class="media-body">
          <h4 class="media-heading" style="margin-top:23px;">No Fees or Subscriptions</h4>
          There are no costs, subscriptions, or hidden fees. Nothing. No credit cards required. Why? Because we beileve that tools like this should be free for anyone to use and made publically available. <i>Also the fact that most college students are broke...</i>
        </div>
      </div>

    </div>
    <div class="col-lg-3"></div>
  </div>
</div>

<div class="jumbotron" style="margin-top:80px;">
  <div class="container">
    <h3>Ready to join? Create a free account below!</h3>
    {{ Form::open(array('url' => 'register')) }}

      <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', '', array('class' => 'form-control', 'placeholder' => 'Email Address')) }}
      </div>

      <div class="form-group">
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
      </div>

      <div class="form-group">
        {{ Form::label('firstname', 'First Name') }}
        {{ Form::text('firstname', '', array('class' => 'form-control', 'placeholder' => 'First')) }}
      </div>

      <div class="form-group">
        {{ Form::label('lastname', 'Last Name') }}
        {{ Form::text('lastname', '', array('class' => 'form-control', 'placeholder' => 'Last')) }}
      </div>

      {{ Form::submit('Create Account', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
  </div>
</div>

@stop