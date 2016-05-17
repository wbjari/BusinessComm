@extends('layouts.master')

@section('title', 'Home')

@section('content')

  @include('includes.header')

  <div class="jumbotron jumbotron-homepage">
    <div class="container text-white text-center">
      <img src="assets/img/logo-white-shadow.png" alt="BusinessComm" />
      <h2>BusinessComm, hét social media platform voor uw bedrijf!</h2>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-offset-1 col-md-4 col-xs-offset-1 col-xs-10 text-center">
        <i class="material-icons">person</i>
        <h3>Creëer je eigen profiel</h3>
        <p>Schrijf je in, vind bedrijven in de buurt en vergemakkelijk het contact tussen de personen binnen het bedrijf!</p>
        <a href="{{ url('/register') }}">
          <button class="btn btn-raised btn-info btn-sm">Eigen profiel aanmaken</button>
        </a>
      </div>
      <div class="col-md-offset-2 col-md-4 col-xs-offset-1 col-xs-10 text-center">
        <i class="material-icons">business</i>
        <h3>Schrijf jouw bedrijf in!</h3>
        <p>Wacht niet langer en schrijf jouw bedrijf nu in om van de functionaliteiten te profiteren!</p>
        <p><small><strong>*Profiel vereist</strong></small></p>
        <a href="{{ url('/create-company') }}">
          <button class="btn btn-raised btn-info btn-sm">Bedrijf inschrijven</button>
        </a>
      </div>
    </div>
  </div>

  @include('includes.footer')

@endsection
