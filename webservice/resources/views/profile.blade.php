@extends('layouts.master')

@section('title', 'Profile')

@section('content')

  @include('includes.header')

	<div class="profile-header">
		<div class="container">
			<img src="{{ url('assets/img/avatar.png') }}" alt="">
			<i class="material-icons profile-picture-edit">camera_alt</i>
			<h1><span data-profile="firstname">{{ $user->firstname }}</span>&nbsp;<span data-profile="lastname">{{ $user->lastname }}</span></h1>
			<h2 data-profile="function">{{ $user->category_id }}</h2>
			<h5>
		        @if ($user->location)
		        	<span data-profile="location">{{ $user->location }}</span>,
		        @endif
		        @if ($user->province)
		        	<span data-profile="province">{{ $user->province }}</span>,
		        @else
		        	<span data-profile="province">test</span>,
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

				<div data-card="skills">
					<?php $i = 1 ?>
					@foreach ($user_skills as $skill)
						<span class="label label-primary" data-profile="{{ $i }}" data-profile-array="skill-{{ $i }}" data-color="#000">{{ $skill }}</span>

						<?php $i++ ?>
					@endforeach
				</div>
			</div>
			<div class="col-md-12 text-right">
				<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#add_skill">Vaardigheid toevoegen<div class="ripple-container"></div></button>
			</div>
		</div>
	@endif

	@if (count($user_skills) > 0)
		<div class="card">
			<div class="col-md-12">
				<h2>Ervaring</h2>

				<ul data-card="experience" class="list-experiences">
					<li data-card="experiences">
						<h3 data-profile="function" data-profile-array="experience-1">Webdeveloper</h3>
						<h4 data-profile="name" data-profile-array="experience-1">BusinessComm</h4>
						<p><small><span data-profile="startdate" data-profile-array="experience-1">April 2016</span> - <span data-profile="enddate" data-profile-array="experience-1">heden</span></small></p>
						<p data-profile="info" data-profile-array="experience-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam, maiores, non? Ea dolor quos sint rerum obcaecati ullam deserunt illum atque rem nisi, eligendi saepe. Ad dolore quibusdam rem ipsa!</p>
					</li>
					<li>
						<h3 data-profile="function" data-profile-array="experience-2">Functie</h3>
						<h4 data-profile="name" data-profile-array="experience-2">Bedrijfsnaam</h4>
						<p><small><span data-profile="startdate" data-profile-array="experience-2">Begindatum</span> - <span data-profile="enddate" data-profile-array="experience-2">einddatum</span></small></p>
						<p data-profile="info" data-profile-array="experience-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam, maiores, non? Ea dolor quos sint rerum obcaecati ullam deserunt illum atque rem nisi, eligendi saepe. Ad dolore quibusdam rem ipsa!</p>
					</li>
				</ul>
			</div>
			<div class="col-md-12 text-right">
				<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#add_experience">Ervaring toevoegen<div class="ripple-container"></div></button>
			</div>
		</div>
	@endif

	@if (count($user_skills) > 0)
		<div class="card">
			<div class="col-md-12">
				<h2>Opleiding</h2>

				<ul data-card="education" class="list-experiences">
					<li>
						<h3 data-profile="name" data-profile-array="education-1">Radius College, Breda</h3>
						<h4 data-profile="function" data-profile-array="education-1">Niveau 4 BOL, Mediadeveloper</h4>
						<p><small><span data-profile="startdate" data-profile-array="education-1">2013</span> - <span data-profile="enddate" data-profile-array="education-1">2016</span></small></p>
					</li>
					<li>
						<h3 data-profile="name" data-profile-array="education-2">Dongemond College, Raamsdonksveer</h3>
						<h4 data-profile="function" data-profile-array="education-2">Niveau 4 gemengd theoretisch, Techniek</h4>
						<p><small><span data-profile="startdate" data-profile-array="education-2">2009</span> - <span data-profile="enddate" data-profile-array="education-2">2013</span></small></p>
					</li>
				</ul>
			</div>
			<div class="col-md-12 text-right">
				<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#add_education">Opleiding toevoegen<div class="ripple-container"></div></button>
			</div>
		</div>
	@endif

		<div class="card">
			<div class="col-md-12">
				<h2>Aanvullende informatie</h2>
				
				<table class="table">
					<tbody>
					    @if ($user->address !== '')
							<tr><th>Adres</th></tr>
						    <tr><td data-profile="address">{{ $user->address }}</td></tr>
						@endif
						    
						@if ($user->zipcode !== '')
						    <tr><th>Postcode</th></tr>
						    <tr><td data-profile="zipcode">{{ $user->zipcode }}</td></tr>
						@endif

						@if ($user->location !== '')
						    <tr><th>Plaats</th></tr>
						    <tr><td data-profile="location">{{ $user->location }}</td></tr>
						@endif

						@if ($user->province !== '')
						    <tr><th>Provincie</th></tr>
						    <tr><td data-profile="province">{{ $user->province }}</td></tr>
						@endif

						@if ($user->country !== '')
						    <tr><th>Land</th></tr>
						    <tr><td data-profile="country">{{ $user->country }}</td></tr>
						@endif

						@if ($user->email !== '')
						    <tr><th>E-mailadres</th></tr>
						    <tr><td>{{ $user->email }}</td></tr>
						@endif

						@if ($user->telephone !== '')
						    <tr><th>Telefoonnummer</th></tr>
						    <tr><td data-profile="telephone">{{ $user->telephone }}</td></tr>
						@endif

						@if ($user->mobile !== '')
						    <tr><th>Mobiel</th></tr>
						    <tr><td data-profile="mobile">{{ $user->mobile }}</td></tr>
						@endif

						@if ($user->languages !== '')
						    <tr><th>Talen</th></tr>
						    <tr><td>{{ $user->languages }}</td></tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>

	</div>

	<!-- VAARDIGHEID TOEVOEGEN -->
	<div class="modal fade" id="add_skill" tabindex="-1" role="dialog" aria-labelledby="add_skill" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
					<h4 class="modal-title">Vaardigheid toevoegen</h4>
				</div>
				<div class="modal-body">
					<form data-name="skills">
						<input type="text" class="form-control" name="skill" placeholder="Vaardigheid">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
					<button type="button" class="btn btn-info" data-dismiss="modal" data-profile-add="skills">Toevoegen</button>
				</div>
			</div>
		</div>
	</div>

	<!-- ERVARING TOEVOEGEN -->
	<div class="modal fade" id="add_experience" tabindex="-1" role="dialog" aria-labelledby="add_experience" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
					<h4 class="modal-title">Ervaring toevoegen</h4>
				</div>
				<div class="modal-body">
					<form data-name="experience">
						<input type="text" class="form-control" name="function" placeholder="Functie">
						<input type="text" class="form-control" name="name" placeholder="Bedrijfsnaam">
						<input type="date" class="form-control" name="start_date" placeholder="Begindatum">
						<input type="date" class="form-control" name="end_date" placeholder="Einddatum">
						<input type="text" class="form-control" name="description" placeholder="Beschrijving">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
					<button type="button" class="btn btn-info" data-dismiss="modal" data-profile-add="experience">Toevoegen</button>
				</div>
			</div>
		</div>
	</div>

	<!-- OPLEIDING TOEVOEGEN -->
	<div class="modal fade" id="add_education" tabindex="-1" role="dialog" aria-labelledby="add_education" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
					<h4 class="modal-title">Opleiding toevoegen</h4>
				</div>
				<div class="modal-body">
					<form data-name="education">
						<input type="text" class="form-control" name="name" placeholder="School, plaats">
						<input type="text" class="form-control" name="function" placeholder="Functie">
						<input type="date" class="form-control" name="start_date" placeholder="Begindatum">
						<input type="date" class="form-control" name="end_date" placeholder="Einddatum">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
					<button type="button" class="btn btn-info" data-dismiss="modal" data-profile-add="education">Toevoegen</button>
				</div>
			</div>
		</div>
	</div>

	<button class="btn-profile-save btn btn-primary btn-raised btn-fab btn-round">
		<i class="material-icons">save</i>
	</button>

  @include('includes.footer')

@endsection

