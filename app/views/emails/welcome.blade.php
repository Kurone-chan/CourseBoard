<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <link href="//bootswatch.com/paper/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="jumbotron">
      <div class="container">
        <h3>Welcome to {{ Config::get('app.projectname') }}!</h3>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
          <div class="well" style="margin-top:20px;">
            <p class="lead">We're glad to have you join our website! To get started, click <a href="{{ URL::to('') }}">this link</a> to sign in.</p>
            <p class="lead">We hope you will like your experience collaborating with your colleagues on our website!</p>
            <br>
            <p class="lead">Thank you,</p>
            <p class="lead">{{ Config::get('app.projectname') }} Team</p>
          </div>
        </div>
        <div class="col-lg-4"></div>
      </div>
    </div>
  </body>
</html>