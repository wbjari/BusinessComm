<div id="navbar">
  <nav class="navbar navbar-fixed-top" role="navigation">
     <div class="container-fluid">
       <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="dashboard"><img src="assets/img/logo-white.png" alt="BusinessComm" height="30px"></a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ url('/profile') }}"><i class="material-icons">account_circle</i>Profiel<div class="ripple-container"></div></a></li>
            <li><a href="{{ url('/logout') }}">Uitloggen<div class="ripple-container"></div></a></li>
        </ul>
      </div>
    </div>
  </nav>
</div>
<div class="header-fix" style="height:90px"></div>
