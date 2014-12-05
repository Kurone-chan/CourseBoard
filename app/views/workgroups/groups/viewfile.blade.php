@extends('layouts.master')
@section('body')
  <div class="jumbotron jumbotron-default" style="margin-top:50px;">
    <div class="container">
      <h3>Viewing {{ $fdata->name }}</h3>
    </div>
  </div>

  <div class="container-fluid" style="margin-top:20px;">
    <div class="row-fluid">
      <div class="col-lg-3 col-md-2">
        <div class="list-group">
          <li class="list-group-item"><h4 class="list-group-item-heading">File Options</h4></li>
          @if($fdata->userIsOwner())
            <a class="list-group-item" href="{{ URL::to('/g/' . $group->uid . '/edit/' . $fdata->id) }}"><i class="fa fa-edit"></i> Edit File</a>
          @endif
          <a class="list-group-item" href="#"><i class="fa fa-copy"></i> Duplicate File</a>
          <!-- <a class="list-group-item" href="#"><i class="fa fa-link"></i> Share Link</a> -->
          <li class="list-group-item"><h4 class="list-group-item-heading">File Information</h4></li>
          <li class="list-group-item"><i class="fa fa-code"></i> Syntax: {{ $fdata->filetype }}</li>
          <li class="list-group-item"><i class="fa fa-user"></i> Uploader: {{ User::find($fdata->uploader)->firstname . ' ' . User::find($fdata->uploader)->lastname }}</li>
          <li class="list-group-item"><i class="fa fa-calendar-o"></i> Last edit: {{ date('F d, Y', strtotime($fdata->updated_at)) . ' at ' . date('g:ia', strtotime($fdata->updated_at)) }}</li>
          <!-- <li class="list-group-item"><h4 class="list-group-item-heading">File Owner</h4><p class="list-group-item-text">Zack Devine <span class="label label-success">zdevine@me.com</span></p></li> -->
        </div>
      </div>
      <div class="col-lg-9 col-md-10">
        <div style="padding-bottom: 50%;">
          <div id="editor">{{{ $fdata->content or "Could not load file contents. Please try again."}}}</div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('assets/ace/ace.js') }}" type="text/javascript" charset="utf-8"></script>
  <script>
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/textmate");
    editor.getSession().setMode("ace/mode/{{ $fdata->filetype }}");
    editor.setReadOnly(true);
  </script>
@stop
