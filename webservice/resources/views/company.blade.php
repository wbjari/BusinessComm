@extends('layouts.master')

@section('title', 'Profile')

@section('content')

  @include('includes.header')

	<div class="profile-header">
		<div class="container">
			<img src="{{ url('assets/img/avatar.png') }}" alt="">
      <i class="material-icons profile-picture-edit">camera_alt</i>
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

  @include('includes.footer')

@endsection
