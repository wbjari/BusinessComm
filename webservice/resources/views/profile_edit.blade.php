@extends('layouts.master')

@section('title', 'Profile')

@section('content')

  @include('includes.header')

	<div class="profile-header">
		<div class="container">
      <div class="profileimg-container" data-toggle="modal" data-target="#changeProfilePictureModal">
        @if($user->profilepicture)
          <img src="{{ url($user->profilepicture) }}" alt="{{ $user->firstname }}&nbsp;{{ $user->lastname }}">
        @else
          <img src="{{ url('assets/img/avatar.png') }}" id="profile" alt="{{ $user->firstname }}&nbsp;{{ $user->lastname }}">
        @endif
			   <i class="material-icons profile-picture-edit">camera_alt</i>
      </div>
			<h1><span data-profile="firstname">{{ $user->firstname }}</span>&nbsp;<span data-profile="lastname">{{ $user->lastname }}</span></h1>
			<h2 data-profile="function">{{ $user->category_id }}</h2>
			<h5>
		        @if ($user->location)
		        	<span data-profile="location">{{ $user->location }}</span>,
		        @else
		        	<span data-profile="location" class="text-muted">Plaats</span>,
		        @endif
		        @if ($user->province)
		        	<span data-profile="province">{{ $user->province }}</span>,
		        @else
		        	<span data-profile="province" class="text-muted">Provincie</span>,
		        @endif
		        @if ($user->country)
		        	<span data-profile="country">{{ $user->country }}</span>
		        @else
		        	<span data-profile="country" class="text-muted">Land</span>
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


		<div class="card">
			<div class="col-md-12">
				<h2>Over mij</h2>
				@if ($user->biography)
					<p data-profile="biography">{{ $user->biography }}</p>
				@else
					<p data-profile="biography" class="text-muted">Vertel iets over jezelf.</p>
				@endif
			</div>
		</div>




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

								<tr><th>Adres</th></tr>
						    @if ($user->address)
							    <tr><td data-profile="address">{{ $user->address }}</td></tr>
							@else
								<tr><td data-profile="address" class="text-muted">Vul hier jouw adres in.</td></tr>
							@endif

							    <tr><th>Postcode</th></tr>
							@if ($user->zipcode)
							    <tr><td data-profile="zipcode">{{ $user->zipcode }}</td></tr>
							@else
								<tr><td data-profile="zipcode" class="text-muted">Vul hier jouw postcode in.</td></tr>
							@endif

								<tr><th>Plaats</th></tr>
							@if ($user->location)
							    <tr><td data-profile="location">{{ $user->location }}</td></tr>
							@else
								<tr><td data-profile="location" class="text-muted">Vul hier jouw woonplaats in.</td></tr>
							@endif

							    <tr><th>Provincie</th></tr>
							@if ($user->province)
							    <tr><td data-profile="province">{{ $user->province }}</td></tr>
							@else
								<tr><td data-profile="province" class="text-muted">Vul hier jouw provincie in.</td></tr>
							@endif

							    <tr><th>Land</th></tr>
							@if ($user->country)
							    <tr><td data-profile="country">{{ $user->country }}</td></tr>
							@else
								<tr><td data-profile="province" class="text-muted">Vul hier jouw land in.</td></tr>
							@endif

							<tr><th>E-mailadres</th></tr>
							<tr><td>{{ $user->email }}</td></tr>

							    <tr><th>Telefoonnummer</th></tr>
							@if ($user->telephone)
							    <tr><td data-profile="telephone">{{ $user->telephone }}</td></tr>
							@else
								<tr><td data-profile="telephone" class="text-muted">Vul hier jouw telefoonnummer in.</td></tr>
							@endif

							    <tr><th>Mobiel</th></tr>
							@if ($user->mobile)
							    <tr><td data-profile="mobile">{{ $user->mobile }}</td></tr>
							@else
								<tr><td data-profile="mobile" class="text-muted">Vul hier jouw mobiele nummer in.</td></tr>
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

  <div class="modal fade" id="changeProfilePictureModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Foto aanpassen</h4>
        </div>
        <form id="changeLogoForm" method="POST" enctype="multipart/form-data" action="/change-profile-picture">
          {!! csrf_field() !!}

          <div class="modal-body">

            <div class="col-sm-6">
             <label class="control-label">Afbeelding</label>
             <input type="file" id="changePic" name="changePic">
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
            <button type="submit" class="btn btn-info">Opslaan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<script>
  var currPage = "user/{{ $user->id }}/edit";
</script>

  @include('includes.footer')

@endsection
