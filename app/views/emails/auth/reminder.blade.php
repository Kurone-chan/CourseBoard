<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <link href="//bootswatch.com/paper/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <h3 class="page-header">Password Reset Request</h3>
    <div class="well">
    	<p class="lead">To reset your password, please complete this form: {{ URL::to('password/reset', array()) }}.</p>
    	<p class="lead">This link will expire in <span class="text-danger">{{ Config::get('auth.reminder.expire', 60) }}</span> minutes.</p>
    </div>
  </body>
</html>