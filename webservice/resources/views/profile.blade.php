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
	<div class="timeline col-xs-12 col-md-6 col-md-offset-3">
		@if (session('notification'))
	      <div class="alert alert-info">
	        <div class="container-fluid">
	          <div class="alert-icon">
	            <i class="material-icons">info_outline</i>
	          </div>
	          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	            <span aria-hidden="true"><i class="material-icons">clear</i></span>
	          </button>
	          <b>Info:</b> {{ session('notification') }}
	        </div>
	      </div>
	    @endif

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
							<span class="label label-primary" data-profile="skill-{{ $i }}" data-profile-array="skill" data-color="#000">{{ $skill }}</span>

							<?php $i++ ?>
						@endforeach
					</div>
				</div>
				<div class="col-md-12 text-right">
					<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#add_skill">Vaardigheid toevoegen<div class="ripple-container"></div></button>
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

	<button class="btn-profile-save btn btn-primary btn-raised btn-fab btn-round">
		<i class="material-icons">save</i>
	</button>

	<div class="modal fade" id="reportUser" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="myModalLabel">{{ $user->firstname.' '.$user->lastname }} rapporteren</h4>
	      </div>
	      <form id="reportUserForm" method="POST" enctype="multipart/form-data" action="/user/report">
	        {!! csrf_field() !!}
	        <input type="hidden" name="user" value="{{ $user->id }}">

	        <div class="modal-body">

	          <input type="text" name="reason" placeholder="Reden" class="form-control">

	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
	          <button type="submit" class="btn btn-danger">Rapporteren</button>
	        </div>
	      </form>
	    </div>
	  </div>
	</div>

  @include('includes.footer')

@endsection

