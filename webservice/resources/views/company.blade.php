@extends('layouts.master')

@section('title', 'Bedrijf')

@section('content')

  @include('includes.header')

	<div class="profile-header">
		<div class="container company-profile">
      <div class="img-container" data-toggle="modal" data-target="#changeLogoModal">
        @if($company->logo)
          <img src="{{ url($company['logo']) }}" alt="{{ $company['name'] }}">
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

    @if ($role = 0)

      @if ($requested == false)

        <button type="button" id="requestCompany" class="btn btn-primary btn-raised requester">Aansluiten</button>

      @else

        <button type="button" id="cancelRequestCompany" class="btn btn-danger btn-raised requester">Annuleren</button>

      @endif

    @endif

	</div>

	<div class="container">

    @if ($role = 2 | $role = 3)
    <div class="card">
      <div class="col-md-12">
        <h2>Verzoeken</h2>
        <ul>
          @foreach ($requests as $request)

            <li>hoi</li>

          @endforeach
        </ul>
      </div>
    </div>
    @endif

    @if ($company['biography'])
		<div class="card">
      <div class="col-md-12">
        <h2>Biografie</h2>
        <p> {{ $company['biography'] }} </p>
      </div>
		</div>
    @endif

    @if ($role != 0)

    <div class="timeline col-xs-12 col-md-6 col-md-offset-3">

      <div class="new-post">
        <div class="card">
          <div class="col-md-12">
            <form id="newPostForm" method="POST" enctype="multipart/form-data" action="/create-post">
              {!! csrf_field() !!}

              <input type="hidden" name="company_id" value="{{ $company['id'] }}">

              <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="Titel *" autocomplete="off">
              </div>

              <div class="form-group">
                <textarea name="message" class="form-control" placeholder="Bericht *" autocomplete="off"></textarea>
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


            @if (count($posts) < 1)
            <div class="card">
              <div class="col-md-12">
    					  <h4>Er zijn nog geen berichten</h4>
              </div>
            </div>
    				@else

    					@foreach ($posts as $post)
              <div class="card">
                <div class="col-md-12">

                  <span class="remove-post" data-id="{{ $post->id }}" data-toggle="modal" data-target="#removePostModal"><i class="material-icons">delete_forever</i></span>

                  <h4>{{ $post->title }}</h4>
                  <p>{{ $post->content }}</p>
                  @if ($post->image)
                  <div>
                    <img src="{{ $post->image }}" />
                  </div>
                  @endif
                  <div>
                    <b>Door:</b> {{ $post->firstname }} {{ $post->lastname }}
                    <br>
                    <b>op:</b> {{ $post->created_at }}
                  </div>

                </div>
              </div>
              @endforeach

            @endif

          </div>
        </div>

        @endif

      </div>

    </div>

	</div>

  <div class="modal fade" id="removePostModal" tabindex="-1" role="dialog" aria-labelledby="removePost" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Waarschuwing!</h4>
      </div>
      <div class="modal-body">

        <p class="modal-message">
          Weet u zeker dat uw het bericht "<span></span>" wilt verwijderen?
          <br />
          Het is niet mogelijk om dit ongedaan te maken.
        </p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
        <button type="button" class="btn btn-danger" id="removePostButton">Verwijderen</button>
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
