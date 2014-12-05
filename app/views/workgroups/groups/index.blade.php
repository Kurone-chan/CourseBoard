@if(!Auth::check())
  {{ Redirect::to('error/no-access') }}


@endif

@extends('layouts.master')
@section('body')

  <div class="jumbotron jumbotron-{{{ $group->headercolor }}}" style="margin-top:50px;">
    <div class="container">
      <h3 class="jheading-{{{ $group->headingcolor }}}">
        @if($group->private)
          <span class="fa fa-lock"></span>
        @endif
        {{ $group->name }}
      </h3>
      <p class="jsub-{{{ $group->desccolor }}}">{{ $group->about }}</p>
    </div>
  </div>

  <div class="container-fluid" style="margin-top:20px;">
    <div class="row-fluid">
      <div class="col-lg-3 col-md-2">
        <div class="list-group">
          <li class="list-group-item"><h4 class="list-group-item-heading">Member List</h4></li>
          <?php $memberlist = unserialize($group->members); ?>
          @foreach($memberlist as $member)
            @if($member === $group->ownerid)
              <?php $memberinfo = User::find($member); ?>
              <li class="list-group-item">
              <h4 class="list-group-item-heading">{{ $memberinfo->firstname . ' ' . $memberinfo->lastname }}</h4>
              <p class="list-group-item-text">
                @if($memberinfo->online === 1)
                  <span class="label label-success">Online</span>
                @else
                  <span class="label label-danger">Offline</span>
                @endif
                 - <span class="label label-primary">Group Owner</span> <a href="mailto:{{ $memberinfo->email }}" target="_blank" class="label label-success">{{ $memberinfo->email }}</a>
              </p>
            </li>
            @else
              <?php $memberinfo = User::find($member); ?>
              <li class="list-group-item">
                <h4 class="list-group-item-heading">{{ $memberinfo->firstname . ' ' . $memberinfo->lastname }}</h4>
                <p class="list-group-item-text">
                  @if($memberinfo->online === 1)
                    <span class="label label-success">Online</span>
                  @else
                    <span class="label label-danger">Offline</span>
                  @endif
                   - <a href="mailto:{{ $memberinfo->email }}" target="_blank" class="label label-success">{{ $memberinfo->email }}</a>
                  @if($group->userIsOwner() or Auth::user()->id == $member)
                    <span class="pull-right"><a href="{{ URL::to('g/' . $group->uid . '/removeuser/' . $memberinfo->id) }}" class="label label-danger">Remove from Group</a></span>
                  @endif
                </p>
              </li>
            @endif
          @endforeach

          @if($group->userIsOwner() === true)
            <li class="list-group-item"><p class="list-group-item-text"><a href="#" data-toggle="modal" data-target="#inviteUserModal"><i class="fa fa-plus"></i> Invite New Member</a></p></li>
          @endif
        </div>
      </div>
      <div class="col-lg-9 col-md-10">

        <!-- // Top Action Bar // -->
        @foreach($memberlist as $u)
          @if(Auth::user()->id === $u)
            <ul class="nav nav-tabs" role="tablist" id="actionbar">
              <li role="presentation" class="active"><a href="#createpost" role="tab" data-toggle="tab"><span class="fa fa-edit"></span> New Post</a></li>
              <li role="presentation"><a href="#createfile" role="tab" data-toggle="tab"><span class="fa fa-file-text-o"></span> Create File Snippet</a></li>

              @if($group->userIsOwner() === true)
                <li role="presentation"><a href="#showsettingspane" role="tab" data-toggle="tab"><span class="fa fa-gear"></span> Group Settings</a></li>
              @endif

            </ul>

            <div class="tab-content" style="margin-bottom:20px;margin-top:-1px;">
              <div role="tabpanel" class="tab-pane fade in active" id="createpost">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <p class="lead">Create a New Post</p>
                  </div>
                </div>
              </div>

              <div role="tabpanel" class="tab-pane fade" id="createfile">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <p class="lead">Create a File Snippet</p>
                    {{ Form::open(array('url' => 'g/createfile', 'class' => 'form-inline')) }}
                    <input type="hidden" name="uid" value="{{ $group->uid }}">
                    {{ Form::text('filename', '', array('class' => 'form-control', 'placeholder' => 'File Name')) }}
                    <select name="filetype" class="form-control">
                      <option disabled>Popular Filetypes</option>
                      <option value="plain_text">Plain Text</option>
                      <option value="html">HTML</option>
                      <option value="javascript">JavaScript</option>
                      <option value="csharp">C#</option>
                      <option value="python">Python</option>
                      <option disabled></option>
                      <option disabled>Other Filetypes</option>
                      <option value="php">PHP</option>
                    </select>
                    <div class="checkbox form-control">
                      {{ Form::checkbox('allowediting', true, false) }}
                      Allow File Editing?
                    </div>
                    {{ Form::token() }}
                    {{ Form::submit('Create File', array('class' => 'btn btn-primary')) }}
                    {{ Form::close() }}
                  </div>
                </div>

              </div>

              @if($group->userIsOwner() === true)
                <div role="tabpanel" class="tab-pane fade" id="showsettingspane">
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <p class="lead">You may edit your group's appearance and under-the-hood options in the <a href="{{ URL::to('g/' . $group->uid . '/settings') }}">Group Settings</a> page.</p>
                    </div>
                  </div>
                </div>
              @endif

            </div>

            <script type="text/javascript">
            $('#actionbar a').click(function (e) {
                e.preventDefault()
                $(this).tab('show')
              })
            </script>

          @endif
         @endforeach

        <!-- // End Action Bar // -->

        <!-- // Begin Post Section // -->
          <?php $posts = Post::where('parent', '=', $group->id)->get(); ?>
          @foreach($posts as $post)

            <div class="panel panel-{{{ $group->headercolor }}}">
              <div class="panel-heading"><div class="panel-title">{{ $post->title }} <span class="pull-right"><span class="fa fa-clock-o"></span> {{ date('F d, Y', strtotime($post->created_at)) . ' at ' . date('g:ia', strtotime($post->created_at)) }}</span></div></div>
              <div class="panel-body">
                <p class="lead">{{ $post->content }}</p>
              </div>
              <div class="panel-footer" id="#commentsection">
                <a data-toggle="collapse" data-parent="#commentsection" href="#showcomments"><span class="fa fa-comments-o"></span> Show Comments</a>
                <div id="showcomments" class="panel-collapse collapse" style="margin-top:15px;">
                  <hr>
                  <div class="media">
                    <p class="lead">First|Last:</p>
                    <div class="media-body">
                      comment
                    </div>
                  </div>
                  <hr>
                  <div class="media">
                    <p class="lead">First|Last:</p>
                    <div class="media-body">
                      another comment
                    </div>
                  </div>
                  <hr>
                  {{ Form::open(array('url' => '#', 'class' => 'form-inline')) }}
                    <div class="input-group col-lg-12">
                      <input name="comment" id="comment" type="text" class="form-control">
                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">Reply</button>
                      </span>
                    </div>
                  {{ Form::close() }}
                </div>
              </div>
            </div>
          @endforeach

        <!-- // End Post Section // -->

      </div>
      <div class="modal fade" id="inviteUserModal" tabindex="-1" role="dialog" aria-labelledby="inviteUserHeader" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="inviteUserHeader">Invite User to Group</h4>
            </div>
            <div class="modal-body">
              <p class="lead">Enter the email address of the user you would like to invite below.</p>
              {{ Form::open(array('url' => 'invitemember', 'class' => 'form-inline')) }}
                <input type="hidden" name="groupid" value="{{ $group->id }}">
                <div class="input-group col-lg-12">
                  {{ Form::email('email', '', array('class' => 'form-control', 'placeholder' => 'Email Address')) }}
                  <span class="input-group-btn">{{ Form::submit('Invite', array('class' => 'btn btn-primary')) }}</span>
                </div>
              {{ Form::close() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@stop
