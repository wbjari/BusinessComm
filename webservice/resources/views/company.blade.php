@extends('layouts.master')
@section('title', 'Bedrijf')
@section('content')
@include('includes.header')
<div class="profile-header">
  <div class="container company-profile">
    <div class="img-container" @if ($role == 2 || $role == 3) data-toggle="modal" data-target="#changeLogoModal" @endif>
      @if($company->logo)
      <img src="{{ url($company['logo']) }}" alt="{{ $company['name'] }}">
      @else
      <img src="{{ url('assets/img/company.png') }}" alt="{{ $company['name'] }}">
      @endif
      @if ($role == 2 || $role == 3)
      <i class="material-icons profile-picture-edit">camera_alt</i>
      @endif
    </div>
    <h1 @if ($role == 2 || $role == 3) data-profile="name" @endif>{{ $company['name'] }}</h1>
    @if($company['slogan'])
    <h2 @if ($role == 2 || $role == 3) data-profile="slogan" @endif>{{ $company['slogan'] }}</h2>
    @elseif (!$company['slogan'] && $role == 2 || $role == 3)
    <h2 data-profile="slogan" class="text-muted" >Vul hier jouw bedrijfs slogan in.</h2>
    @endif
    <h5>
      @if ($company['location'])
      <span @if ($role == 2 || $role == 3) data-profile="location" @endif>{{ $company['location'] }}</span>,
      @elseif (!$company['location'] && $role == 2 || $role == 3)
      <span data-profile="location" class="text-muted">Vul hier de locatie in.</span>,
      @endif
      @if ($company['province'])
      <span @if ($role == 2 || $role == 3) data-profile="province" @endif>{{ $company['province'] }}</span>,
      @elseif (!$company['province'] && $role == 2 || $role == 3)
      <span data-profile="province" class="text-muted">Vul hier de provincie in.</span>,
      @endif
      @if ($company['country'])
      <span @if ($role == 2 || $role == 3) data-profile="country" @endif>{{ $company['country'] }}</span>
      @elseif (!$company['country'] && $role == 2 || $role == 3)
      <span data-profile="country" class="text-muted">Vul hier het land in.</span>
      @endif
    </h5>
    @if ($role == 0 && $requested == false)
    <button type="button" id="requestCompany" class="btn btn-primary btn-raised requester" style="float:right;">Aansluiten</button>
    @elseif ($requested == true)
    <button type="button" id="cancelRequestCompany" class="btn btn-danger btn-raised requester" style="float:right;">Annuleren</button>
    @endif
    <div class="clearfix"></div>
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
  @if ($role == 2 || $role == 3)
  @if ($requests->count() != 0)
  <div class="card requests">
    <div class="col-md-12">
      <h2>Verzoeken</h2>
      <ul>
        @foreach ($requests as $request)
        <li data-id="{{ $request['user_id'] }}">
          <a href="{{ url('/user/' . $request['user_id']) }}">{{ $request['firstname'] }} {{ $request['lastname'] }}</a>
          <br />
          <button type="button" class="btn btn-success btn-sm btn-raised" data-type="accept" name="button">Accepteren</button>
          <button type="button" class="btn btn-danger btn-sm btn-raised" data-type="deny" name="button">Weigeren</button>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
  @endif
  @endif
  <div class="timeline col-xs-12 col-md-6 col-md-offset-3">
    <div class="card">
      <div class="col-md-12">
        <h2>Leden</h2>
        @if (count($members) < 1)
        <h4 class="no-result">Geen leden gevonden...</h4>
        @else
        <table class="table">
          <thead>
            <tr>
              <th>Naam</th>
              <th>Email</th>
              <th>Rechten</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($members as $member)
            <tr>
              <td><a href="{{ url('/user/' . $member->id) }}">{{ $member->firstname.' '.$member->lastname }}</a></td>
              <td>{{ $member->email }}</td>
              <td>
                @if($member->role === 'Beheerder')
                {{ $member->role }}
                @else
                	@if ($role == 3)
                    <form action="{{ url('/company/'.$company->id.'/users/edit') }}" enctype="multipart/form-data" method="POST">
                      {!! csrf_field() !!}
                      <input type="hidden" name="id" value="{{ $member->id }}">
                      <select name="userRole" class="userRole">
                        <option value="{{ $member->role }}">{{ $member->role }}</option>
                        @if ($member->role !== 'Mede-beheerder')
                        <option value="Mede-beheerder">Mede-beheerder</option>
                        @endif
                        @if ($member->role !== 'Lid')
                        <option value="Lid">Lid</option>
                        @endif
                        <option value="Verwijderen">Verwijderen</option>
                      </select>
                    </form>
                  @else
                    {{ $member->role }}
                  @endif
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @endif
      </div>
    </div>
    @if ($company['biography'])
    <div class="card">
      <div class="col-md-12">
        <h2>Biografie</h2>
        <p @if ($role == 2 || $role == 3) data-profile="biography" @endif> {{ $company['biography'] }} </p>
      </div>
    </div>
    @elseif (!$company['biography'] && $role == 2 || $role == 3)
    <div class="card">
      <div class="col-md-12">
        <h2>Biografie</h2>
        <p data-profile="biography" class="text-muted">Vertel iets over het bedrijf</p>
      </div>
    </div>
    @endif
    <div class="card">
      <div class="col-md-12">
        <h2>Aanvullende informatie</h2>
        <table class="table">
          <tbody>
            @if ($company->email)
            <tr>
              <th>E-mailadres</th>
            </tr>
            <tr>
              <td @if ($role == 2 || $role == 3) data-profile="email" @endif>{{ $company->email }}</td>
            </tr>
            @elseif (!$company->email && $role == 2 || $role == 3)
            <tr>
              <td data-profile="email" class="text-muted">Vul hier uw e-mailadres in.</td>
            </tr>
            @endif
            <tr>
              <th>Telefoon</th>
            </tr>
            @if ($company->telephone)
            <tr>
              <td @if ($role == 2 || $role == 3) data-profile="telephone" @endif>{{ $company->telephone }}</td>
            </tr>
            @elseif (!$company->telephone && $role == 2 || $role == 3)
            <tr>
              <td data-profile="telephone" class="text-muted">Vul hier uw telefoonnummer in.</td>
            </tr>
            @endif
            <tr>
              <th>Adres</th>
            </tr>
            @if ($company->address)
            <tr>
              <td @if ($role == 2 || $role == 3) data-profile="address" @endif>{{ $company->address }}</td>
            </tr>
            @elseif (!$company->address && $role == 2 || $role == 3)
            <tr>
              <td data-profile="address" class="text-muted">Vul hier uw adres in.</td>
            </tr>
            @endif
            <tr>
              <th>Postcode</th>
            </tr>
            @if ($company->zipcode)
            <tr>
              <td @if ($role == 2 || $role == 3) data-profile="zipcode" @endif>{{ $company->zipcode }}</td>
            </tr>
            @elseif (!$company->zipcode && $role == 2 || $role == 3)
            <tr>
              <td data-profile="zipcode" class="text-muted">Vul hier uw postcode in.</td>
            </tr>
            @endif
            <tr>
              <th>Plaats</th>
            </tr>
            @if ($company->location)
            <tr>
              <td @if ($role == 2 || $role == 3) data-profile="location" @endif>{{ $company->location }}</td>
            </tr>
            @elseif (!$company->location && $role == 2 || $role == 3)
            <tr>
              <td data-profile="location" class="text-muted">Vul hier de plaats in.</td>
            </tr>
            @endif
            <tr>
              <th>Land</th>
            </tr>
            @if ($company->country)
            <tr>
              <td @if ($role == 2 || $role == 3) data-profile="country" @endif>{{ $company->country }}</td>
            </tr>
            @elseif (!$company->country && $role == 2 || $role == 3)
            <tr>
              <td data-profile="country" class="text-muted">Vul hier het land in.</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @if ($role != 0)
  <div class="timeline col-xs-12 col-md-6 col-md-offset-3">
    <div class="new-post">
      <div class="card">
        <div class="col-md-12">
          <form id="newPostForm" method="POST" enctype="multipart/form-data" action="/create-post">
            {!! csrf_field() !!}
            <input type="hidden" name="company_id" value="{{ $company['id'] }}">
            <div class="form-group">
              <input type="text" name="title" class="form-control" placeholder="Titel *" pattern="[^]{1,50}" title="Titel mag maximaal 50 tekens bevatten" autocomplete="off" required>
            </div>
            <div class="form-group">
              <textarea name="message" class="form-control" placeholder="Bericht *" pattern="[\s\S]*\S[\s\S]*" autocomplete="off" required></textarea>
            </div>
            <label class="control-label" for="file">Afbeelding</label>
            <input type="file" name="file" accept="image/jpeg, image/png">
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
      <ul class="nav nav-pills nav-pills-primary posts" role="tablist">
        <li class="active"><a href="#" role="tab" data-id="1" data-toggle="tab">Alle</a></li>
        <li><a href="#schedule" data-id="2" role="tab" data-toggle="tab">Alleen (mede-)beheerders</a></li>
      </ul>
      <div class="the-posts" data-id="1">
        @foreach ($posts as $post)
        <div class="card">
          <div class="col-md-12">
            @if ($post['user_id'] == \Auth::id() || $role == 2 || $role == 3)
            <span class="edit-post" data-id="{{ $post->id }}" data-toggle="modal" data-target="#editPostModal"><i class="material-icons">edit</i></span>
            <span class="remove-post" data-id="{{ $post->id }}" data-toggle="modal" data-target="#removePostModal"><i class="material-icons">delete_forever</i></span>
            @endif
            <h4 class="post-title">{{ $post->title }}</h4>
            <p class="post-content">{{ $post->content }}</p>
            @if ($post->image)
            <div class="post-image">
              <img src="{{ $post->image }}" />
            </div>
            @endif
            <div class="post-footer">
              <span class="post-author"><b><a href="{{ url('/user/' . $post->user_id) }}">{{ $post->firstname }} {{ $post->lastname }}</a> plaatste dit bericht op: <span style="float:right;">{{ $post->created_at }}</span></b></span>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="the-posts" style="display:none;" data-id="2">
        @foreach ($posts as $post)
        @if ($post['role'] == 2 || $post['role'] == 3)
        <div class="card">
          <div class="col-md-12">
            @if ($post['user_id'] == \Auth::id() || $role == 2 || $role == 3)
            <span class="remove-post" data-id="{{ $post->id }}" data-toggle="modal" data-target="#removePostModal"><i class="material-icons">delete_forever</i></span>
            @endif
            <h4 class="post-title">{{ $post->title }}</h4>
            <p class="post-content">{{ $post->content }}</p>
            @if ($post->image)
            <div class="post-image">
              <img src="{{ $post->image }}" />
            </div>
            @endif
            <div class="post-footer">
              <span class="post-author"><b><a href="{{ url('/user/' . $post->user_id) }}">{{ $post->firstname }} {{ $post->lastname }}</a> plaatste dit bericht op: <span style="float:right;">{{ $post->created_at }}</span></b></span>
              @if ($post->created_at != $post->updated_at)
              <span class="post-editor"><b><a href="{{ url('/user/' . $post->edited_by) }}">{{ $post->edited_by }}</a> bewerkte dit bericht op: <span style="float:right;">{{ $post->updated_at }}</span></b></span>
              @endif
            </div>
          </div>
        </div>
        @endif
        @endforeach
      </div>
    </div>
    @endif
  </div>
  @endif
</div>
</div>
</div>
</div>
@if ($role == 2 || $role == 3)
<div class="modal fade" id="changeLogoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Logo aanpassen</h4>
      </div>
      <form id="changeLogoForm" method="POST" enctype="multipart/form-data" action="/change-logo">
        {!! csrf_field() !!}
        <input type="hidden" name="company" value="{{ $company['id'] }}">
        <div class="modal-body">
          <div class="col-sm-6">
            <label class="control-label">Logo *</label>
            <input type="file" id="changeLogo" name="changeLogo" accept="image/jpeg, image/png" required>
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
@endif
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
<div class="modal fade" id="reportCompany" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">{{ $company->name }} rapporteren</h4>
      </div>
      <form id="reportCompanyForm" method="POST" enctype="multipart/form-data" action="/company/report">
        {!! csrf_field() !!}
        <input type="hidden" name="company" value="{{ $company->id }}">
        <div class="modal-body">
          <label class="control-label">Reden *</label>
          <input type="text" name="reason" placeholder="Typ hier uw reden" pattern="[\s\S]*\S[\s\S]*" class="form-control" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
          <button type="submit" class="btn btn-danger">Rapporteren</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Bericht bewerken</h4>
      </div>
      <form id="editPostForm" method="POST" enctype="multipart/form-data" action="/edit-post">
        {!! csrf_field() !!}
        <input type="hidden" name="company" value="{{ $company->id }}">
        <input type="hidden" name="post_id" value="">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="title" class="form-control" value="" pattern="[^]{1,50}" title="Titel mag maximaal 50 tekens bevatten" autocomplete="off" required>
          </div>
          <div class="form-group">
            <textarea name="message" class="form-control" pattern="[\s\S]*\S[\s\S]*" autocomplete="off" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
          <button type="submit" class="btn btn-success">Opslaan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<button class="btn-profile-save btn btn-primary btn-raised btn-fab btn-round">
<i class="material-icons">save</i>
</button>
<script>
  var currPage = "company/{{ $company->id }}/edit";
</script>
@include('includes.footer')
@endsection
