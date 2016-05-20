@extends('layouts.master')

@section('title', 'Bedrijf aanmaken')

@section('content')

  @include('includes.header')

  <div class="container">
    <form role="form" method="POST" enctype="multipart/form-data" action="{{ url('/create-company') }}">
        {!! csrf_field() !!}

        <div class="col-sm-6">
           <div class="form-group label-floating">
             <label class="control-label">Naam *</label>
             <input type="text" class="form-control" name="name">
           </div>
        </div>

        <div class="col-sm-6">
           <div class="form-group label-floating">
             <label class="control-label">Slogan</label>
             <input type="text" class="form-control" name="slogan">
           </div>
        </div>

        <div class="col-sm-6">
           <div class="form-group">
             <label class="control-label">Logo</label>
             <input type="file" class="form-control" name="logo">
           </div>
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
             <label class="control-label">Adres</label>
             <input type="text" class="form-control" name="address">
           </div>
        </div>

        <div class="col-sm-6">
           <div class="form-group label-floating">
             <label class="control-label">Postcode</label>
             <input type="text" class="form-control" name="zipcode">
           </div>
        </div>

        <div class="col-sm-6">
           <div class="form-group label-floating">
             <label class="control-label">Plaats</label>
             <input type="text" class="form-control" name="location">
           </div>
        </div>

        <div class="col-sm-6">
           <div class="form-group label-floating">
             <label class="control-label">Provincie</label>
             <input type="text" class="form-control" name="province">
           </div>
        </div>

        <div class="col-sm-6">
           <div class="form-group label-floating">
             <label class="control-label">Land</label>
             <input type="text" class="form-control" name="country">
           </div>
        </div>

        <button type="submit" class="btn btn-success btn-raised btn-fab btn-round form-submit btn-lr">
          <i class="material-icons">forward</i>
        </button>
    </form>
  </div>

  @include('includes.footer')

@endsection
