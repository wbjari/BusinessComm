@extends('layouts.master')

@section('title', 'Registreren')

@section('content')

<div class="page-lr" id="register">
  <img src="assets/img/logo-white.png" alt="BusinessComm" />
  <h1>@yield('title')</h1>
  <div class="block-lr">
    <form role="form" method="POST" action="{{ url('/register') }}">
        {!! csrf_field() !!}

        <div class="col-sm-6">
  	       <div class="form-group info label-floating {{ $errors->has('firstname') ? ' has-error' : '' }}">
             <label class="control-label">Voornaam *</label>
             <input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required>

              @if ($errors->has('firstname'))
                  <span class="help-block">
                      <strong>{{ $errors->first('firstname') }}</strong>
                  </span>
              @endif
            </div>
        </div>

        <div class="col-sm-6">
  	       <div class="form-group info label-floating {{ $errors->has('lastname') ? ' has-error' : '' }}">
             <label class="control-label">Achternaam *</label>
             <input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required>

              @if ($errors->has('lastname'))
                  <span class="help-block">
                      <strong>{{ $errors->first('lastname') }}</strong>
                  </span>
              @endif
            </div>
        </div>

        <div class="col-sm-12">
  	       <div class="form-group info label-floating {{ $errors->has('email') ? ' has-error' : '' }}">
             <label class="control-label">E-mailadres *</label>
             <input type="text" class="form-control" name="email" value="{{ old('email') }}" required>

              @if ($errors->has('email'))
                  <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
            </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group info label-floating {{ $errors->has('password') ? ' has-error' : '' }}">
              <label class="control-label">Wachtwoord *</label>
              <input type="password" class="form-control" name="password" required>

              @if ($errors->has('password'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif

          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group info label-floating {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
              <label class="control-label">Herhaal wachtwoord *</label>
              <input type="password" class="form-control" name="password_confirmation">

                  @if ($errors->has('password_confirmation'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password_confirmation') }}</strong>
                      </span>
                  @endif

          </div>
        </div>

        <button type="submit" class="btn btn-success btn-raised btn-fab btn-round form-submit btn-lr">
          <i class="material-icons">forward</i>
        </button>
    </form>

    <div class="col-sm-12">
      <span class="required-lr">Velden met een * zijn verplicht.</span>
    </div>

    <div class=" msg-below-lr">
      <a href="{{ url('/login') }}" class="btn btn-raised btn-info btn-xs">Ik heb al een account</a>
    </div>

    <div class="clearfix"> </div>

  </div>
</div>
@endsection
