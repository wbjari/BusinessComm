@extends('layouts.master')
@section('title', 'Inloggen')
@section('content')
<div class="page-lr" id="login">
  <img src="assets/img/logo-white.png" alt="BusinessComm" />
  <h1>@yield('title')</h1>
  <div class="around">
    <div class="block-lr">
      <form role="form" method="POST" action="{{ url('/login') }}">
        {!! csrf_field() !!}
        <div class="col-sm-12">
          <div class="form-group info label-floating {{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="control-label">E-mailadres</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
            <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group info label-floating {{ $errors->has('password') ? ' has-error' : '' }}" required>
            <label class="control-label">Wachtwoord</label>
            <input type="password" class="form-control" name="password">
            @if ($errors->has('password'))
            <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group info">
            <div class="checkbox">
              <label>
              <input type="checkbox" name="remember"> Onthouden
              </label>
            </div>
          </div>
        </div>
        <!-- <a class="btn btn-danger col-sm-12" href="{{ url('/password/reset') }}">Wachtwoord vergeten?</a> -->
        <button type="submit" class="btn btn-success btn-raised btn-fab btn-round form-submit btn-lr">
        <i class="material-icons">forward</i>
        </button>
        <div class="clearfix"></div>
      </form>
      <div class="msg-below-lr">
        <a href="{{ url('/register') }}" class="btn btn-raised btn-info btn-xs">Ik heb nog geen account</a>
      </div>
      <div class="clearfix"> </div>
    </div>
  </div>
</div>
@endsection
