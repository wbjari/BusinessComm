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
            <input type="text" class="form-control" name="name" required>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group label-floating">
            <label class="control-label">Slogan</label>
            <input type="text" class="form-control" name="slogan">
          </div>
        </div>

        <div class="col-sm-6">
          <label class="control-label">Logo</label>
          <input type="file" name="logo">
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
            <input type="tel" class="form-control" name="telephone">
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
            <input type="text" class="form-control" name="address" required>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group label-floating">
            <label class="control-label">Postcode *</label>
            <input type="text" class="form-control" name="zipcode" required>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group label-floating">
            <label class="control-label">Plaats *</label>
            <input type="text" class="form-control" name="location" required>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group label-floating">
            <label class="control-label">Provincie *</label>
            <input type="text" class="form-control" name="province" required>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group label-floating">
            <label class="control-label">Land *</label>
            <input type="text" class="form-control" name="country" required>
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
