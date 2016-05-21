@extends('layouts.master')

@section('title', 'Bedrijf')

@section('content')

  @include('includes.header')

	<div class="profile-header">
		<div class="container company-profile">
      <div class="img-container" data-toggle="modal" data-target="#changeLogoModal">
        @if($company->logo)
          <img src="{{ $company['logo'] }}" alt="{{ $company['name'] }}">
        @else
          <img src="{{ url('assets/img/company.png') }}" alt="{{ $company['name'] }}">
        @endif
<!--         <img src="{{ url('assets/img/company.png') }}" alt="{{ $company['name'] }}"> -->
        <i class="material-icons profile-picture-edit">camera_alt</i>
      </div>

			<h1 data-profile="name">{{ $company['name'] }}</h1>
			<h2 data-profile="slogan">{{ $company['slogan'] }}</h2>
			<h5>
        @if ($company['location'])
          <span data-profile="location">{{ $company['location'] }}</span>,
        @endif
        @if ($company['province'])
          <span data-profile="province">{{ $company['province'] }}</span>,
        @endif
        @if ($company['country'])
          <span data-profile="country">{{ $company['country'] }}</span>
        @endif
      </h5>
		</div>
	</div>

	<div class="container">
    @if ($company['biography'])
		<div class="card">
      <div class="col-md-12">
        <h2>Biografie</h2>
        <p> {{ $company['biography'] }} </p>
      </div>
		</div>
    @endif
	</div>

  <div class="modal fade" id="changeLogoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Logo aanpassen</h4>
      </div>
      <div class="modal-body">

        <div class="col-sm-6">
         <label class="control-label">Logo</label>
         <input type="file" id="changeLogo">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
        <button type="button" class="btn btn-info" id="changeLogoButton">Opslaan</button>
      </div>
    </div>
  </div>
</div>

  @include('includes.footer')

@endsection
