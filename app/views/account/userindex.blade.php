<div class="jumbotron jumbotron-primary" style="margin-top:50px;">
  <div class="container">
    <h3 class="jheading-white">Welcome back, {{ Auth::user()->firstname }}!</h3>
    <p class="jsub-white">{{ Auth::user()->acctype }} / {{ Config::get('app.companyname') }} / Member since {{ date('F d, Y', strtotime(Auth::user()->created_at)) }}</p>
  </div>
</div>

<div class="panel panel-default navsub-bg" style="margin-top:-30px;">
  <div class="container">
    <div class="panel-body navsub">
      <ul class="nav navbar-nav">
        <li class="active"><a href="{{ URL::to('') }}"><i class="fa fa-desktop"></i> Dashboard</a></li>
        <li><a href="{{ URL::to('account') }}"><i class="fa fa-gear"></i> Account Settings</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ URL::to('logout') }}"><i class="fa fa-sign-out"></i> Sign Out</a></li>
      </ul>
    </div>
  </div>
</div>

<div class="container-fluid" style="margin-top:30px;">
  <div class="row-fluid">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
      <div class="row-fluid">
        <div class="col-lg-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <div class="panel-title">My Workgroups</div>
            </div>
            <div class="panel-body">
              <p class="lead">My Courses</p>
              <table class="table table-condensed">
                <?php $mycourses = unserialize(Auth::user()->courseids); ?>
                @forelse($mycourses as $courseid)
                  <?php $course = Course::where('uid', '=', $courseid)->first(); ?>
                  <tr><td><a href="{{ URL::to('c/' . $courseid) }}">{{ $courseid }}: {{ $course->name }}</a></td></tr>
                @empty
                  <tr><td><i>You do not belong to any course groups! Please contact your instructor to add you to the course group.</i></td></tr>
                @endforelse
              </table>
              <hr>
              <p class="lead">My Groups</p>
              <table class="table table-condensed">
                <?php $allgroups = Group::all(); ?>
                @forelse($allgroups as $g)
                  <?php $gmembers = unserialize($g->members); ?>
                  @forelse($gmembers as $gm)
                    @if($gm === Auth::user()->id)
                      <tr><td><a href="{{ URL::to('g/' . $g->uid) }}">{{ $g->name }}</a></td></tr>
                    @endif
                  @empty
                    <tr><td><i>You do not belong to any groups! Create a group by clicking the 'Create Group' link at the right or search for a group to join using the search bar at the top right of the page.</i></td></tr>
                  @endforelse
                @empty
                  <tr><td><i>There are no groups available to join. Click the 'Create Group' link at the right to create a new group!</i></td></tr>
                @endforelse
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <div class="panel-title">My Created Groups <a class="pull-right" data-toggle="modal" data-target="#createGroupModal" style="cursor:pointer;"><span class="fa fa-plus"></span> Create Group</a></div>
            </div>
            <div class="panel-body">
              <table class="table table-condensed">
                <?php $gcount = Group::where('ownerid', '=', Auth::user()->id)->count() ?>
                @if($gcount === 0)
                  <tr><td><i>You have not created any groups! Click the 'Create Group' link above to create a new group!</i></td></tr>
                @else
                  <?php $groups = DB::table('groups')->where('ownerid', '=', Auth::user()->id)->get() ?>
                  @foreach($groups as $group)
                    <tr><td><a href="{{ URL::to('g/' . $group->uid) }}">{{ $group->name }}</a></td></tr>
                  @endforeach
                @endif
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-1"></div>
  </div>
</div>

<div class="modal fade" id="createGroupModal" tabindex="-1" role="dialog" aria-labelledby="createGroupModalHeader" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="createGroupModalHeader">Create New Workgroup</h4>
      </div>
      <div class="modal-body">
        <p class="lead">Enter the information below to create a new workgroup.</p>
        {{ Form::open(array('url' => 'creategroup')) }}
          <div class="form-group">
            {{ Form::text('uid', '', array('class' => 'form-control', 'placeholder' => 'Group Identifier')) }}
          </div>
          <div class="form-group">
            {{ Form::text('name', '', array('class' => 'form-control', 'placeholder' => 'Group Name')) }}
          </div>
          <div class="form-group">
            {{ Form::text('about', '', array('class' => 'form-control', 'placeholder' => 'Group Description')) }}
          </div>
          <div class="form-group">
            <div class="checkbox form-control">
              {{ Form::checkbox('private', true, false) }}
              Make Group Private?
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <!-- <button type="button" class="btn btn-primary">Create</button> -->
        {{ Form::submit('Create Group', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>
