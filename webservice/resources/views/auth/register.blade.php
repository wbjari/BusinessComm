@extends('layouts.master')

@section('content')

  <div class="page-lr" id="register">
    <div class="block-lr">
      
      <h1>Registreren</h1>

      <form class="register-form" role="form" method="POST" action="{{ url('/register') }}">
        {!! csrf_field() !!}

        <div class="col-sm-6">
  	       <div class="form-group label-floating {{ $errors->has('firstname') ? ' has-error' : '' }}">
  		         <label class="control-label" name="firstname">Voornaam *</label>
  		         <input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}">

               @if ($errors->has('firstname'))
                   <span class="help-block">
                       <strong>{{ $errors->first('firstname') }}</strong>
                   </span>
               @endif

  	      </div>
        </div>

        <div class="col-sm-6">
  	       <div class="form-group label-floating {{ $errors->has('lastname') ? ' has-error' : '' }}">
  		         <label class="control-label" name="lastname">Achternaam *</label>
  		         <input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}">

                @if ($errors->has('lastname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('lastname') }}</strong>
                    </span>
                @endif

          </div>
        </div>

        <div class="col-sm-12">
  	       <div class="form-group label-floating {{ $errors->has('email') ? ' has-error' : '' }}">
  		         <label class="control-label" name="email">E-mailadres *</label>
  		         <input type="text" class="form-control" name="email" value="{{ old('email') }}">

               @if ($errors->has('email'))
                   <span class="help-block">
                       <strong>{{ $errors->first('email') }}</strong>
                   </span>
               @endif

  	      </div>
        </div>

        <div class="col-sm-6">
  	       <div class="form-group label-floating {{ $errors->has('password') ? ' has-error' : '' }}">
  		         <label class="control-label" name="password">Wachtwoord *</label>
  		         <input type="text" class="form-control" name="password">

               @if ($errors->has('password'))
                   <span class="help-block">
                       <strong>{{ $errors->first('password') }}</strong>
                   </span>
               @endif

  	      </div>
        </div>

        <div class="col-sm-6">
  	       <div class="form-group label-floating {{ $errors->has('password_confirm') ? ' has-error' : '' }}">
  		         <label class="control-label" name="password_confirm">Bevestig wachtwoord *</label>
  		         <input type="text" class="form-control" name="password_confirm">

               @if ($errors->has('password_confirm'))
                   <span class="help-block">
                       <strong>{{ $errors->first('password_confirm') }}</strong>
                   </span>
               @endif

  	      </div>
        </div>

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
