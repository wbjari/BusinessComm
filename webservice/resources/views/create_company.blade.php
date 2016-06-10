@extends('layouts.master')
@section('title', 'Bedrijf aanmaken')
@section('content')
@include('includes.header')
<div class="container" style="margin-top:50px;">
  <div class="notifications">
    @if (session('notification'))
    <div class="col-md-12">
      <div class="alert alert-info">
        <div class="container-fluid">
          <div class="alert-icon">
            <i class="material-icons">info_outline</i>
          </div>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true"><i class="material-icons">clear</i></span>
          </button>
          <b>Info:</b> <span class="message">{{ session('notification') }}</span>
        </div>
      </div>
    </div>
    @endif
  </div>
  <form role="form" method="POST" enctype="multipart/form-data" action="{{ url('/create-company') }}">
    <div class="card">
      {!! csrf_field() !!}
      <div class="col-sm-6">
        <div class="form-group label-floating">
          <label class="control-label">Naam *</label>
          <input type="text" class="form-control" name="name" pattern="[A-Za-z0-9!?#\s]{1,50}" title="Naam mag maximaal 50 tekens bevatten" required>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group label-floating">
          <label class="control-label">Slogan</label>
          <input type="text" class="form-control" pattern="[A-Za-z!.,?/#@\s]{0,200}" title="Slogan mag maximaal 200 tekens bevatten" name="slogan">
        </div>
      </div>
      <div class="col-sm-6">
        <label class="control-label">Logo</label>
        <input type="file" name="logo" accept="image/jpeg, image/png" title="Alleen jpeg en png bestanden zijn toegestaan">
      </div>
      <div class="col-sm-6">
        <div class="form-group label-floating">
          <label class="control-label">E-mail</label>
          <input type="email" class="form-control" name="email">
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group label-floating">
          <label class="control-label">Telefoon</label>
          <input type="text" class="form-control" name="telephone" pattern="[0-9]{8,20}" title="Telefoonnummer mag alleen cijfers bevatten en tussen de 8 en 20 tekens zijn">
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group label-floating">
          <label class="control-label">Biografie</label>
          <input type="text" class="form-control" name="biography">
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group label-floating">
          <label class="control-label">Adres *</label>
          <input type="text" class="form-control" name="address" pattern="[A-Za-z0-9-\s]*" title="Adres mag alleen de volgende tekens bevatten: A-Z, a-z, 0-9, spatie en -" required>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group label-floating">
          <label class="control-label">Postcode *</label>
          <input type="text" class="form-control" name="zipcode" pattern="[A-Z0-9]{6}" title="Postcode mag alleen de volgende tekens bevatten: A-Z, 0-9 en mag moet 6 tekens bevatten." required>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group label-floating">
          <label class="control-label">Plaats *</label>
          <input type="text" class="form-control" name="location" pattern="[A-Za-z-\s]{1,100}" title="Plaats mag alleen de volgende tekens bevatten: A-Z, a-z, spatie en -. En moet tussen de 1 en 100 tekens bevatten." required>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group label-floating">
          <label class="control-label">Provincie *</label>
          <input type="text" class="form-control" name="province" pattern="[A-Za-z-\s]{1,100}" title="Provincie mag alleen de volgende tekens bevatten: A-Z, a-z, spatie en -. En moet tussen de 1 en 100 tekens bevatten." required>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group label-floating">
          <label class="control-label">Land *</label>
          <input type="text" class="form-control" name="country" pattern="[A-Za-z-\s]{1,100}" title="Land mag alleen de volgende tekens bevatten: A-Z, a-z, spatie en -. En moet tussen de 1 en 100 tekens bevatten." required>
        </div>
      </div>
      <button type="submit" class="btn btn-success btn-raised form-submit">
      Aanmaken
      </button>
    </div>
  </form>
</div>
@include('includes.footer')
@endsection
