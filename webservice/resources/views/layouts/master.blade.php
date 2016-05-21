<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title') | BusinessComm</title>

        <meta name="_token" content="{{ csrf_token() }}" />
        <meta name="url" content="{{  url('/') }}" />

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
      	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

        <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ url('/assets/css/material-kit.css') }}" rel="stylesheet" />

        <link rel="stylesheet" href="{{ url('assets/css/core.css') }}" media="screen" charset="utf-8" />
    </head>
    <body>

        @yield('content')

      	<script src="{{ url('assets/js/jquery.min.js') }}" type="text/javascript"></script>
      	<script src="{{ url('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
      	<script src="{{ url('assets/js/material.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('assets/js/material-kit.js') }}" type="text/javascript"></script>
      	<script src="{{ url('assets/js/core.js') }}" type="text/javascript"></script>
      	<script src="{{ url('assets/js/ajax.js') }}" type="text/javascript"></script>

      	<!-- <script src="{{ url('assets/js/nouislider.min.js') }}" type="text/javascript"></script> -->

      	<!-- <script src="{{ url('assets/js/bootstrap-datepicker.js') }}" type="text/javascript"></script> -->

    </body>
</html>
