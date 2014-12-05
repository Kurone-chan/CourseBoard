@extends('layouts.master')
@section('body')
  @if($errorid === "private")
    <?php
      $icon = "fa-lock";
      $heading = "This group is private...";
      $content = 'We\'re sorry, but the group you are trying to access is private. Please make sure you are logged in and have proper access to this group. If you are still having trouble, please contact support at <a href="mailto:support@kurone.me" target="_blank">support@kurone.me</a>.';
    ?>
  @elseif($errorid === "no-access")
    <?php
      $icon = "fa-times";
      $heading = "Access Denied.";
      $content = 'We\'re sorry, but you must be signed in to access this page. Use the form at the top right to sign in, or click <a href="' . URL::to('') . '">here</a> to register for a free account.';
    ?>
  @elseif($errorid === "not-owner")
    <?php
      $icon = "fa-times";
      $heading = "Access Denied.";
      $content = 'We\'re sorry, but you must be the owner of this group to access this page. Please make sure you are logged in and are in the right group. If you are still having trouble, please contact support at <a href="mailto:support@kurone.me" target="_blank">support@kurone.me</a>.';
    ?>
  @endif

<div class="container-fluid" style="margin-top:120px;">
  <div class="row-fluid">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
      <div class="media">
        <h1 class="fa {{ $icon }} fa-5x media-object pull-left"></h1>
        <div class="media-body">
          <h1 class="media-heading">{{ $heading }}</h1>
          <p class="lead">{{ $content }}</p>
        </div>
      </div>
    </div>
    <div class="col-lg-3"></div>
  </div>
</div>
@stop