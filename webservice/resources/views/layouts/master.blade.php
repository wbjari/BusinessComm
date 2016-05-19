<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title') | BusinessComm</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
      	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../assets/css/material-kit.css" rel="stylesheet" />

        <?php if (Auth::check()): ?>
        <link rel="stylesheet" href="assets/css/user.css" media="screen" charset="utf-8" />
        <?php else: ?>
        <link rel="stylesheet" href="assets/css/guest.css" media="screen" charset="utf-8" />
        <?php endif; ?>
        <link rel="stylesheet" href="../assets/css/core.css" media="screen" charset="utf-8" />
    </head>
    <body>

        @yield('content')

      	<script src="../assets/js/jquery.min.js" type="text/javascript"></script>
      	<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
      	<script src="../assets/js/material.min.js"></script>

      	<!-- <script src="assets/js/nouislider.min.js" type="text/javascript"></script> -->

      	<!-- <script src="assets/js/bootstrap-datepicker.js" type="text/javascript"></script> -->

      	<script src="../assets/js/material-kit.js" type="text/javascript"></script>
    </body>
</html>
