@if(!$fdata->userIsOwner())
  {{-- Redirect::to('error/no-access') --}}
@endif

@extends('layouts.master')
@section('body')
  <div class="jumbotron jumbotron-default" style="margin-top:50px;">
    <div class="container">
      <h3>Editing {{ $fdata->name }}</h3>
    </div>
  </div>

  <!-- Success Overlay -->
  <div class="alert-overlay">
    <div class="alert alert-success" id="updatesuccess" role="alert">
      <strong>Saved changes to file.</strong>
    </div>
    <!-- Error Overlay -->
    <div class="alert alert-danger alert-dismissible" id="updatefail" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <strong>Error saving changes to the file.</strong> Please try again. If this problem persists, please contact <a href="#" class="alert-link">support</a>.
    </div>
  </div>

  <div class="container-fluid" style="margin-top:20px;">
    <div class="row-fluid">
      <div class="col-lg-3 col-md-2">
        <div class="list-group">
          <li class="list-group-item"><h4 class="list-group-item-heading">File Options</h4></li>
          <a class="list-group-item" onclick="updateContent()"><i class="fa fa-save"></i> Save Changes</a>
          <a class="list-group-item" href="#"><i class="fa fa-copy"></i> Duplicate File</a>
          <!-- <a class="list-group-item" href="#"><i class="fa fa-link"></i> Share Link</a> -->
          <li class="list-group-item"><h4 class="list-group-item-heading">File Information</h4></li>
          <a class="list-group-item" href="#"><i class="fa fa-code"></i> Syntax: {{ $fdata->filetype }}</a>
          <li class="list-group-item"><i class="fa fa-user"></i> Uploader: {{ User::find($fdata->uploader)->firstname . ' ' . User::find($fdata->uploader)->lastname }}</li>
          <li class="list-group-item"><i class="fa fa-calendar-o"></i> Last edit: {{ date('F d, Y', strtotime($fdata->updated_at)) . ' at ' . date('g:ia', strtotime($fdata->updated_at)) }}</li>
          <!-- <li class="list-group-item"><h4 class="list-group-item-heading">File Owner</h4><p class="list-group-item-text">Zack Devine <span class="label label-success">zdevine@me.com</span></p></li> -->
        </div>
      </div>
      <div class="col-lg-9 col-md-10">
        <div style="padding-bottom: 50%;">
          <div id="editor">{{{ $fdata->content or "Blank file."}}}</div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('assets/ace/ace.js') }}" type="text/javascript" charset="utf-8"></script>
  <script>
    $(document).ready(function(){
      $("#updatesuccess").hide();
      $("#updatefail").hide();
    });

    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/textmate");
    editor.getSession().setMode("ace/mode/{{ $fdata->filetype }}");

    function updateContent(){
      $.ajax({
        url: '/file/{{ $fdata->id }}',
        dataType:'json',
        type: 'POST',
        data: {content: editor.getValue()},
        success: function(data){ if(data.success == 'yes'){ SaveComplete(); }else{ SaveFailed(); } }
      });
    }

    function SaveComplete(){
      $("#updatesuccess").fadeIn('fast').delay(2000).fadeOut('fast');
    }

    function SaveFailed(){
      $("#updatefail").fadeIn('fast');
    }
  </script>
@stop
