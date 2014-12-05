@extends('layouts.master')
@section('body')
<div class="container-fluid" style="margin-top:120px;">
  <div class="row-fluid">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
      <h3>Delete Successful</h3>
      <p class="lead">The group was deleted successfully. Click <a href="{{ URL::to('') }}">here</a> to go to the home page.</p>
    </div>
    <div class="col-lg-3"></div>
  </div>
</div>
@stop