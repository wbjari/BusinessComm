@extends('layouts.master')

@section('content')

  <div class="page-lr" id="register">
    <div class="block-lr">

      <h1>Registreren</h1>

      <form class="register-form" role="form" method="POST" action="{{ url('/createUser') }}">

        <div class="col-sm-6">
  	       <div class="form-group label-floating">
  		         <label class="control-label" name="firstname">Voornaam *</label>
  		         <input type="text" class="form-control" name="firstname">
           </div>
        </div>

        <div class="col-sm-6">
  	       <div class="form-group label-floating">
  		         <label class="control-label" name="lastname">Achternaam *</label>
  		         <input type="text" class="form-control" name="lastname">
             </div>
        </div>

        <div class="col-sm-12">
  	       <div class="form-group label-floating">
  		         <label class="control-label" name="email">E-mailadres *</label>
  		         <input type="text" class="form-control" name="email">
           </div>
        </div>

        <div class="col-sm-6">
  	       <div class="form-group label-floating">
  		         <label class="control-label" name="password">Wachtwoord *</label>
  		         <input type="password" class="form-control" name="password">
  	      </div>
        </div>

        <!-- <div class="col-sm-6">
  	       <div class="form-group label-floating">
  		         <label class="control-label" name="password_confirm">Bevestig wachtwoord *</label>
  		         <input type="password" class="form-control" name="password_confirm">
           </div>
        </div> -->

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <button type="submit" class="btn btn-danger btn-raised btn-fab btn-round form-submit btn-lr">
        <i class="material-icons">forward</i>
      </button>

      <div class="clearfix"></div>

    </form>

    <div class="col-sm-12">
      <span class="required-lr">Velden met een * zijn verplicht.</span>
    </div>

    <a href="{{ url('/login') }}" class="btn btn-raised btn-primary btn-xs have-account">Ik heb al een account</a>

    <div class="clearfix"> </div>

    </div>
  </div>

@endsection
