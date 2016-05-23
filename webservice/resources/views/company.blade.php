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

    <div class="timeline col-xs-12 col-md-6 col-md-offset-3">

      <div class="new-post">
        <div class="card">
          <div class="col-md-12">
            <form id="newPostForm" method="POST" enctype="multipart/form-data" action="/create-post">
              {!! csrf_field() !!}

              <input type="hidden" name="company_id" value="{{ $company['id'] }}">

              <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="Titel *">
              </div>

              <div class="form-group">
                <textarea name="message" class="form-control" placeholder="Bericht *"></textarea>
              </div>

              <label class="control-label" for="file">Afbeelding</label>
              <input type="file" name="file">

              <div class="form-group">
                <input type="submit" class="btn btn-primary btn-raised pull-right" name="submit" value="Plaatsen">
              </div>

            </form>
          </div>
        </div>
      </div>

      <div class="posts">

        <div class="card">
          <div class="col-md-12">

            @if (count($posts) < 1)
    					<h4>Er zijn nog geen berichten</h4>
    				@else

    					@foreach ($posts as $post)
                <h4>{{ $post->title }}</h4>
                <p>{{ $post->content }}</p>
                @if ($post->image)
                <div>
                  <img src="{{ $post->image }}" />
                </div>
                @endif
                <div>
                  <b>Door:</b> {{ $post->id }}
                  <br>
                  <b>op:</b> {{ $post->created_at }}
                </div>
              @endforeach

            @endif

          </div>
        </div>

      </div>

    </div>

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
           <input type="file" id="changeLogo" name="changeLogo" data-url="/change-logo">
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
