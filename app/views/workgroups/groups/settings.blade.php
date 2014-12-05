@extends('layouts.master')
@section('body')
  <div class="jumbotron jumbotron-default" style="margin-top:50px;">
    <div class="container">
      <h3>Change Group Settings</h3>
      <p>Editing {{ $groupinfo->name }}</p>
    </div>
  </div>

  <div class="container-fluid" style="margin-top:20px;">
    <div class="row-fluid">
      <div class="col-lg-3 col-md-2"></div>
      <div class="col-lg-6 col-md-8" style="padding-bottom:40px;">
        <h3 class="page-header">Basic Information</h3>
        {{ Form::open(array('url' => 'g/updatebasicinfo')) }}
          <input type="hidden" name="id" value="{{ $groupinfo->id }}">
          <div class="form-group">
            <label class="control-label">Group Identifier</label>
            <p class="form-control-static">{{ Config::Get('app.url') . '/g/' }}<a href="{{ URL::to('g/' . $groupinfo->uid) }}">{{ $groupinfo->uid }}</a></p>
          </div>
          <div class="form-group">
            {{ Form::label('name', 'Group Name') }}
            {{ Form::text('name', $groupinfo->name, array('class' => 'form-control')) }}
          </div>
          <div class="form-group">
            {{ Form::label('about', 'Group Description') }}
            {{ Form::text('about', $groupinfo->about, array('class' => 'form-control')) }}
          </div>
          <div class="form-group">
            <div class="checkbox" style="padding-left:20px;">
              {{ Form::checkbox('private', 1, $groupinfo->private) }}
              Make Group Private?
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('headercolor', 'Banner Color') }}
            {{ Form::select('headercolor', array('default' => 'Default', 'primary' => 'Blue', 'success' => 'Green', 'info' => 'Purple', 'warning' => 'Orange', 'danger' => 'Red')) }}
          </div>
          <div class="form-group">
            {{ Form::label('headingcolor', 'Group Title Color') }}
            {{ Form::select('headingcolor', array('default' => 'Default', 'white' => 'White'), array('class' => 'form-control')) }}
          </div>
          <div class="form-group">
            {{ Form::label('desccolor', 'Group About Color') }}
            {{ Form::select('desccolor', array('default' => 'Default', 'white' => 'White'), array('class' => 'form-control')) }}
          </div>
          {{ Form::token() }}
          {{ Form::submit('Update Information', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}

        <h3 class="page-header">Group Options</h3>
        {{ Form::open(array('url' => 'g/updateownership')) }}
          <p class="lead">Transfer Ownership</p>
          <p>If you would like to change the owner of the group, then input the new owner's email here.</p>
          <p class="text-danger">Once you transfer ownership, you can NOT reverse it! The new owner must transfer it back.</p>
          <div class="form-group">
            {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'New Owner\'s Email Address. Must be a registered user.')) }}
          </div>
          <input type="hidden" name="gid" value="{{ $groupinfo->id }}">
          {{ Form::token() }}
          {{ Form::submit('Transfer Ownership', array('class' => 'btn btn-danger')) }}
        {{ Form::close() }}
        <hr>
        <p class="lead">Delete Group</p>
        <p>If you would like to delete your group, use this.</p>
        <p class="text-danger">Once you delete your group, all settings, files, posts, and everything else will be permanently deleted! There is no turning back!</p>
        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteGroup">Delete Group</a>
      </div>
      <div class="col-lg-3 col-md-2"></div>
    </div>
  </div>

  <div class="modal fade" id="deleteGroup" tabindex="-1" role="dialog" aria-labelledby="deleteGroupLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="deleteGroupLabel">Are you sure?</h4>
        </div>
        <div class="modal-body">
          <p class="lead text-danger">All files will be permanently deleted!</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <a href="{{ URL::to('g/' . $groupinfo->uid . '/delgroup') }}" class="btn btn-danger">Confirm</a>
        </div>
      </div>
    </div>
  </div>
@stop
