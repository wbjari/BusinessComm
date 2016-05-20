@extends('layouts.master')

@section('title', 'Bedrijf')

@section('content')

  @include('includes.header')

	<div class="profile-header">
		<div class="container">
			<img src="{{ $company['logo'] }}" alt="{{ $company['name'] }}">
      <i class="material-icons profile-picture-edit" data-toggle="modal" data-target="#myModal">camera_alt</i>
			<h1 data-profile="name">{{ $company['name'] }}</h1>
			<h2 data-profile="function">Functie</h2>
			<h5 data-profile="location">
        @if ($company['location'])
          {{ $company['location'] }},
        @endif
        @if ($company['province'])
          {{ $company['province'] }},
        @endif
        @if ($company['country'])
          {{ $company['country'] }}
        @endif
		</div>
	</div>

	<div class="container">
    @if ($company['biography'])
		<div class="card">
			<h2>Biografie</h2>
      <p> {{ $company['biography'] }} </p>
		</div>
    @endif
	</div>

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" enctype="multipart/form-data" action="{{ url('/create-company') }}">
            {!! csrf_field() !!}

            <div class="col-sm-6">
               <div class="form-group">
                 <label class="control-label">Logo</label>
                 <input type="file" class="form-control" name="logo">
               </div>
            </div>

            <button type="submit" class="btn btn-success btn-raised btn-fab btn-round form-submit btn-lr">
              <i class="material-icons">forward</i>
            </button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
        <button type="button" class="btn btn-info ">Opslaan</button>
      </div>
    </div>
  </div>
</div>

  @include('includes.footer')

@endsection
