@extends('layouts.master')

@section('title', 'Profile')

@section('content')

  @include('includes.header')

	<div class="profile-header">
		<div class="container">
			<img src="{{ url('assets/img/avatar.png') }}" alt="">
			<i class="material-icons profile-picture-edit">camera_alt</i>
			<h1 data-profile="name">{{ $user->firstname.' '.$user->lastname }}</h1>
			<h2 data-profile="function">{{ $user->category_id }}Functie</h2>
			<h5>
		        @if ($user->location)
		        	<span data-profile="location">{{ $user->location }}</span>,
		        @endif
		        @if ($user->province)
		        	<span data-profile="province">{{ $user->province }}</span>,
		        @endif
		        @if ($user->country)
		        	<span data-profile="country">{{ $user->country }}</span>
		        @endif
		    </h5>
		</div>
	</div>

	<div class="container">
	@if ($user->biography)
		<div class="card">
			<div class="col-md-12">
				<h2>Over mij</h2>
				<p> {{ $user->biography }} </p>
			</div>
		</div>
	@endif

	@if (count($user_skills) > 0)
		<div class="card">
			<div class="col-md-12">
				<h2>Vaardigheden</h2>

				@foreach ($user_skills as $skill)
					<span class="label label-primary" data-profile="skill">{{ $skill }}</span>
				@endforeach
			</div>
		</div>
	@endif

	@if (count($user_skills) > 0)
		<div class="card">
			<div class="col-md-12">
				<h2>Ervaring</h2>

			</div>
		</div>
	@endif

	@if (count($user_skills) > 0)
		<div class="card">
			<div class="col-md-12">
				<h2>Opleiding</h2>

			</div>
		</div>
	@endif

	<div class="card">
		<div class="col-md-12">
			<h2>Aanvullende informatie</h2>
			
			<table class="table">
				<tbody>
					@if ($user->firstname !== '' || $user->lastname !== ''){
						<span data-profile="location">{{ $user->firstname .' '.
$user->lastname }}</span>,
					}
					@endif
				    <tr><th>Volledige naam</th></tr>
				    <tr><td>{{ $user->firstname.' '.$user->lastname }}</td></tr>

				    <tr><th>Adres</th></tr>
				    <tr><td>{{ $user->address }}</td></tr>

				    <tr><th>Postcode</th></tr>
				    <tr><td>{{ $user->zipcode }}</td></tr>

				    <tr><th>Plaats</th></tr>
				    <tr><td>{{ $user->location }}</td></tr>

				    <tr><th>Land</th></tr>
				    <tr><td>{{ $user->country }}</td></tr>

				    <tr><th>E-mailadres</th></tr>
				    <tr><td>{{ $user->email }}</td></tr>

				    <tr><th>Telefoonnummer</th></tr>
				    <tr><td>{{ $user->telephone }}</td></tr>

				    <tr><th>Mobiel</th></tr>
				    <tr><td>{{ $user->phone }}</td></tr>

				    <tr><th>Talen</th></tr>
				    <tr><td>{{ $user->languages }}</td></tr>

					
				</tbody>
			</table>
		</div>
	</div>

	</div>

	<button class="btn-profile-save btn btn-primary btn-raised btn-fab btn-round">
		<i class="material-icons">save</i>
	</button>

  @include('includes.footer')

@endsection

