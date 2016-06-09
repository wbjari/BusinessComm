@extends('layouts.master')

@section('title', 'Profile')

@section('content')

  @include('includes.header')

	<div class="profile-header">
		<div class="container">
      @if($user->profilepicture)
        <img src="{{ url($user->profilepicture) }}" alt="{{ $user->firstname }}&nbsp;{{ $user->lastname }}">
      @else
        <img src="{{ url('assets/img/avatar.png') }}" id="profile" alt="{{ $user->firstname }}&nbsp;{{ $user->lastname }}">
      @endif
			<h1>{{ $user->firstname }}&nbsp;{{ $user->lastname }}</h1>
			<h2>{{ $user->category_id }}</h2>
			<h5>
		        @if ($user->location)
		        	<span>{{ $user->location }}</span>,
		        @endif
		        @if ($user->province)
		        	<span>{{ $user->province }}</span>,
		        @endif
		        @if ($user->country)
		        	<span>{{ $user->country }}</span>
		        @endif
		    </h5>
		</div>
	</div>

	<div class="container">
    <div class="notifications">
      @if (session('notification'))
      <div class="col-md-12">
        <div class="alert alert-info">
          <div class="container-fluid">
            <div class="alert-icon">
              <i class="material-icons">info_outline</i>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true"><i class="material-icons">clear</i></span>
            </button>
            <b>Info:</b> <span class="message">{{ session('notification') }}</span>
          </div>
        </div>
      </div>
      @endif
    </div>

    <div class="timeline col-xs-12 col-md-6 col-md-offset-3">
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

					<p data-card="skills">
						<?php $i = 1 ?>
						@foreach ($user_skills as $skill)
							<span class="label label-primary">{{ $skill['name'] }}</span>

							<?php $i++ ?>
						@endforeach
					</p>
				</div>
			</div>
		@endif

			<div class="card">
				<div class="col-md-12">
					<h2>Aanvullende informatie</h2>

					<table class="table">
						<tbody>
						    @if ($user->address)
								<tr><th>Adres</th></tr>
							    <tr><td>{{ $user->address }}</td></tr>
							@endif

							@if ($user->zipcode)
							    <tr><th>Postcode</th></tr>
							    <tr><td>{{ $user->zipcode }}</td></tr>
							@endif

							@if ($user->location)
							    <tr><th>Plaats</th></tr>
							    <tr><td>{{ $user->location }}</td></tr>
							@endif

							@if ($user->province)
							    <tr><th>Provincie</th></tr>
							    <tr><td>{{ $user->province }}</td></tr>
							@endif

							@if ($user->country)
							    <tr><th>Land</th></tr>
							    <tr><td>{{ $user->country }}</td></tr>
							@endif

							@if ($user->email)
							    <tr><th>E-mailadres</th></tr>
							    <tr><td>{{ $user->email }}</td></tr>
							@endif

							@if ($user->telephone)
							    <tr><th>Telefoonnummer</th></tr>
							    <tr><td>{{ $user->telephone }}</td></tr>
							@endif

							@if ($user->mobile)
							    <tr><th>Mobiel</th></tr>
							    <tr><td>{{ $user->mobile }}</td></tr>
							@endif

							@if ($user->languages)
							    <tr><th>Talen</th></tr>
							    <tr><td>{{ $user->languages }}</td></tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

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
