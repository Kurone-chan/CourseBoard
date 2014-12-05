<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#appnav">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ URL::to('') }}">{{ Config::get('app.projectname') }}</a>
    </div>

    <div class="collapse navbar-collapse" id="appnav">
      <ul class="nav navbar-nav">
        @if(Auth::check())
          <li><a href="{{ URL::to('') }}">Home</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Courses <span class="fa fa-angle-down"></span></a>
            <ul class="dropdown-menu" role="menu">
              <?php $mycourses = unserialize(Auth::user()->courseids) ?>
              @forelse($mycourses as $course)
                <?php $courseinfo = Course::where('uid', '=', $course)->first(); ?>
                <li><a href="{{ URL::to('c/' . $course) }}">{{ $course }}: {{ $courseinfo->name }}</a></li>
              @empty
                <li><a><i>No Courses Found!</i></a></li>
              @endforelse
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Groups <span class="fa fa-angle-down"></span></a>
            <ul class="dropdown-menu" role="menu">
              <?php $allgroups = Group::all(); ?>
              @forelse($allgroups as $g)
                <?php $gmembers = unserialize($g->members); ?>
                @forelse($gmembers as $gm)
                  @if($gm === Auth::user()->id)
                    <li><a href="{{ URL::to('g/' . $g->uid) }}">{{ $g->name }}</a></li>
                  @endif
                @empty
                  <li><a><i>No Groups Found!</i></a></li>
                @endforelse
              @empty
                <li><a><i>No Groups Found!</i></a></li>
              @endforelse
            </ul>
          </li>
        @else
          <!-- <li><a href="#">About {{ Config::get('app.projectname') }}</a></li> -->
          <!-- <li><a href="#">Embed {{ Config::get('app.projectname') }} in your company</a></li> -->
          <!-- <li><a href="#">Developer API</a></li> -->
          <!-- <li><a href="#">Contact us</a></li> -->
        @endif
      </ul>
      @if(Auth::check())
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello, {{ Auth::user()->firstname }}! <span class="fa fa-chevron-down"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ URL::to('') }}"><span class="fa fa-desktop"></span> My Dashboard</a></li>
              <li><a href="{{ URL::to('logout') }}"><span class="text-danger"><span class="fa fa-sign-out"></span> Sign out</span></a></li>
            </ul>
          </li>
        </ul>
        {{ Form::open(array('url' => 'search', 'class' => 'navbar-form navbar-right')) }}
          <div class="form-group">
            <div class="input-group">
              {{ Form::text('search', '', array('class' => 'form-control', 'placeholder' => 'Search for Groups')) }}
              <span class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </div>
        {{ Form::close() }}
      @else
        {{ Form::open(array('url' => 'login', 'class' => 'navbar-form navbar-right')) }}
          <div class="form-group">
            {{ Form::email('email', '', array('class' => 'form-control', 'placeholder' => 'Email Address')) }}
          </div>
          <div class="form-group">
            {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
          </div>
          {{ Form::token() }}
          {{ Form::submit('Sign In', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
      @endif
    </div>
  </div>
</nav>
