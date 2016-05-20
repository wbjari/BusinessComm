@extends('layouts.master')

@section('title', 'Company')

@section('content')

  @include('includes.header')

	<div class="profile-header">
		<div class="container company-profile">
      <div class="img-container">
        <?= isset($company->logo) && $company->logo != '' ? '<img src="../assets/img/companies/'.$company->logo.'" alt="">' : '<img src="../assets/img/company.png" alt="">' ?>
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

  @include('includes.footer')

@endsection
