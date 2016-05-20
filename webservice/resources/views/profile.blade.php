@extends('layouts.master')

@section('title', 'Profile')

@section('content')

  @include('includes.header')

	<div class="profile-header">
		<div class="container">
			<img src="{{ assets/img/avatar.png }}" alt="">
			<i class="material-icons profile-picture-edit">camera_alt</i>
			<h1 data-profile="name">Koen de Bont</h1>
			<h2 data-profile="function">Functie</h2>
			<h5 data-profile="location">Breda, Provincie Noord-Brabant, Nederland</h5>
		</div>
	</div>

	<div class="container">
		<div class="card">
			<h2>Over mij</h2>
		</div>
	</div>

	<button class="btn-profile-save btn btn-primary btn-raised btn-fab btn-round">
		<i class="material-icons">save</i>
	</button>

  @include('includes.footer')

@endsection
