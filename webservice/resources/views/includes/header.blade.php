<?php
  $currUrl = explode('/', Request::path())
?>

<header>
  <div id="navbar">
    <?php if (\Auth::check()): ?>
      <nav class="navbar navbar-success navbar-fixed-top" role="navigation">
    <?php else: ?>
      <nav class="navbar navbar-info navbar-fixed-top" role="navigation">
    <?php endif; ?>
      <div class="container">

        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ url('/dashboard') }}"><img src="{{ url('/assets/img/logo-white.png') }}" alt="BusinessComm"></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <?php if (\Auth::check()): ?>
              <?php $userid = \Auth::User()->id; ?>
              
              <li class="dropdown">
        	       <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="material-icons">account_circle</i>Profiel</a>
        			   <ul class="dropdown-menu">
					              <li><a href="{{ url('/user/'.$userid) }}">Mijn profiel</a></li>
            					  <li class="divider"></li>
            					  <li><a href="{{ url('/logout') }}">Uitloggen</a></li>
                  </ul>
              </li>
      
              <li><a href="{{ url('/logout') }}">Uitloggen<div class="ripple-container"></div></a></li>

              @if ($currUrl[0] == 'user')
              <li>
                <a href="#" class="btn btn-simple dropdown-toggle" data-toggle="dropdown">
                  <i class="material-icons">more_vert</i>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#" data-toggle="modal" data-target="#reportUser">Gebruiker rapporteren</a></li>
                </ul>
              </li>
              @elseif ($currUrl[0] == 'company')
              <li>
                <a href="#" class="btn btn-simple dropdown-toggle" data-toggle="dropdown">
                  <i class="material-icons">more_vert</i>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#" data-toggle="modal" data-target="#reportCompany">Bedrijf rapporteren</a></li>
                </ul>
              </li>
              @endif

            <?php else: ?>
              <li><a href="{{ url('/register') }}">Registreren<div class="ripple-container"></div></a></li>
              <li><a href="{{ url('/login') }}">Inloggen<div class="ripple-container"></div></a></li>
            <?php endif; ?>
          </ul>
        </div>

      </div>
    </nav>
  </div>
</header>
