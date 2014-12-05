<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ Config::get('app.projectname') }}</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
    <!-- <link href="//bootswatch.com/paper/bootstrap.min.css" rel="stylesheet"> -->

    <!-- FontAwesome -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/offline-slide.css') }}" rel="stylesheet">

    <!-- jQuery + Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <script src="{{ asset('assets/js/offline.js') }}"></script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css" media="screen">
      #editor {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
      }

      .alert-overlay {
        position: absolute;
        top: 34px;
        left: 20px;
        right: 20px;
        margin-top: 70px;
      }

      .jumbotron-default {
        /*background-color: #f9f9f9;*/
        background-image: linear-gradient(to bottom,#fff 0,#e0e0e0 100%);
      }

      .jumbotron-primary {
        /*background-color: #337ab7;*/
        background-image: linear-gradient(to bottom,#337ab7 0,#265a88 100%);
      }

      .jumbotron-success {
        /*background-color: #4caf50;*/
        background-image: linear-gradient(to bottom,#5cb85c 0,#419641 100%);
      }

      .jumbotron-info {
        /*background-color: #9c27b0;*/
        background-image: linear-gradient(to bottom,#5bc0de 0,#2aabd2 100%);
      }

      .jumbotron-warning {
        /*background-color: #ff9800;*/
        background-image: linear-gradient(to bottom,#f0ad4e 0,#eb9316 100%);
      }

      .jumbotron-danger {
        /*background-color: #ff9800;*/
        background-image: linear-gradient(to bottom,#d9534f 0,#c12e2a 100%);
      }

      .jheading-default {
        color: #454545;
      }

      .jheading-white {
        color: white;
      }

      .jsub-default {
        color: #333;
      }

      .jsub-white {
        color: white;
      }

      /*
        Navigation-Sub class
      */
      .navsub-bg {
        /*background-image: linear-gradient(to bottom,#fff 0,#e0e0e0 100%);*/
        background-color: rgba(0, 0, 0, 0);
      }
      .navsub {
        margin-top:-15px;
        margin-bottom:-15px;
      }
      .navsub>ul>li>a {
        color: #454545;
        text-shadow: 0 1px 0 rgba(255,255,255,.25);
      }

      .navsub>ul>li.active>a {
        color: #0072b4;
        text-shadow: 0 1px 0 rgba(255,255,255,.25);
      }
    </style>
  </head>
  <body>
    @include('sections.navigation')
    @yield('body')
  </body>
</html>
