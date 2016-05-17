@extends('layouts.master')

@section('content')

<div class="header-big">
      <div class="container">
            <img src="assets/img/logo-white.png" class="logo">

            <div class="nav-menu">
                  <a href="register"><li>Aanmelden</li></a>
                  <a href="login"><li>inloggen</li></a>
            </div>
      </div>
</div>

<div class="jumbotron jumbotron-homepage">
      <div class="container text-white text-center" style="margin-top:20vh;text-shadow:0px 2px 2px #000">
            <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit</h2>
      </div>
</div>

<div class="container">
      <div class="row" style="margin-bottom:80px">
            <div class="col-md-offset-1 col-md-4 col-xs-offset-1 col-xs-10 text-center">
                  <i class="material-icons">person</i>
            <h3>Creëer je eigen profiel</h3>
            <p>Vind bedrijven in de buurt, schrijf je in en vergemakkelijk het contact tussen de personen binnen het bedrijf!</p>
            <a href="register"><button class="btn btn-raised btn-primary btn-sm">Eigen profiel aanmaken</button></a>
            </div>
            <div class="col-md-offset-2 col-md-4 col-xs-offset-1 col-xs-10 text-center">
                  <i class="material-icons">business</i>
            <h3>Schrijf jouw bedrijf in!</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores dolor suscipit, sunt atque eaque animi quam nihil. Esse minus amet dignissimos, vel assumenda pariatur blanditiis qui eaque, reiciendis fuga adipisci!</p>
            <p><small>*profiel vereist*</small></p>
            <a href="register"><button class="btn btn-raised btn-primary btn-sm">Bedrijf inschrijven</button></a>
            </div>
      </div>
</div>

@endsection
