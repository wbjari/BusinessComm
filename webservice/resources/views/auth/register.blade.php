@extends('layouts.master')

@section('content')
<div class="page-lr">
    <div class="block-lr">
      <form class="register-form" role="form" method="POST" action="{{ url('/register') }}">
          {!! csrf_field() !!}


          <div class="col-sm-6">
    	       <div class="form-group label-floating {{ $errors->has('name') ? ' has-error' : '' }}">
               <label class="control-label">Naam *</label>
               <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
              </div>
          </div>

          <div class="col-sm-12">
    	       <div class="form-group label-floating {{ $errors->has('email') ? ' has-error' : '' }}">
               <label class="control-label">E-mailadres *</label>
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
                <label class="control-label">Wachtwoord *</label>
                <input type="password" class="form-control" name="password">

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif

            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group label-floating {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label class="control-label">Herhaal wachtwoord *</label>
                <input type="password" class="form-control" name="password_confirmation">

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif

            </div>
          </div>

          <button type="submit" class="btn btn-danger btn-raised btn-fab btn-round form-submit btn-lr">
            <i class="material-icons">forward</i>
          </button>
      </form>

      <div class="col-sm-12">
        <span class="required-lr">Velden met een * zijn verplicht.</span>
      </div>

      <a href="{{ url('/login') }}" class="btn btn-raised btn-primary btn-xs have-account">Ik heb al een account</a>

      <div class="clearfix"> </div>

    </div>
</div>
@endsection
