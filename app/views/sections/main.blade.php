<div class="container-fluid" style="margin-top:85px;">
  <div class="row-fluid">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">

      <h3 class="page-header">Welcome to {{ Config::get('app.projectname') }}.</h3>
      <p class="lead">{{ Config::get('app.projectname') }} is an easy and secure way for students and faculty to simply and effortlessly share course information, notes, ideas, and anything else.</p>

      <div class="media">
        <span class="fa-stack fa-lg fa-3x pull-left media-object">
          <i class="fa fa-circle-thin fa-stack-2x"></i>
          <i class="fa fa-exchange fa-stack-1x"></i>
        </span>
        <div class="media-body">
          <h4 class="media-heading" style="margin-top:23px;">Collaborate and Exchange Information</h4>
          {{ Config::get('app.projectname') }} allows members of the academic community to join together and openly or privately share information through institution-created or privately-created groups. Professors can create class groups to provide notes, assignments, or files to their students. Additionally, anyone can also create public (or private) groups to share files between the members invited to these groups.
        </div>
      </div>

      <div class="media">
        <span class="fa-stack fa-lg fa-3x pull-left media-object">
          <i class="fa fa-circle-thin fa-stack-2x"></i>
          <i class="fa fa-graduation-cap fa-stack-1x"></i>
        </span>
        <div class="media-body">
          <h4 class="media-heading" style="margin-top:23px;">Created by Students, For Students</h4>
          Lets face it, companies and organizations do not know how students work. {{ Config::get('app.projectname') }} was created by college students who actually know what it is like to <i>be a student</i>. This collaboration tool was built with students in mind, allowing flexibility and ease-of-access in an otherwise stressful or hard-working environment that students have to live through.
        </div>
      </div>

      <div class="media">
        <span class="fa-stack fa-lg fa-3x pull-left media-object">
          <i class="fa fa-usd fa-stack-1x"></i>
          <i class="fa fa-ban fa-stack-2x"></i>
        </span>
        <div class="media-body">
          <h4 class="media-heading" style="margin-top:23px;">No Fees or Subscriptions</h4>
          There are no costs, subscriptions, or hidden fees. Nothing. No credit cards required. Why? Because we believe that tools like this should be free for anyone to use and made openly available.
        </div>
      </div>

    </div>
    <div class="col-lg-1"></div>
  </div>
</div>

<div class="jumbotron jumbotron-default" style="margin-top:80px; margin-bottom:-30px;">
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

      <div class="form-group">
        <label class="control-label">Company</label>
        <!-- <div class="col-sm-10"> -->
          <p class="form-control-static">{{ Config::get('app.companyname') }}</p>
        <!-- </div> -->
      </div>

      {{ Form::submit('Create Account', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
  </div>
</div>
