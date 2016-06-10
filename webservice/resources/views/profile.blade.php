@extends('layouts.master')
@section('title', 'Profile')
@section('content')
@include('includes.header')
<div class="profile-header">
  <div class="container">
    <div @if ($user->id == \Auth::id()) class="profileimg-container" data-toggle="modal" data-target="#changeProfilePictureModal" @endif>
      @if($user->profilepicture)
      <img src="{{ url($user->profilepicture) }}" alt="{{ $user->firstname }}&nbsp;{{ $user->lastname }}">
      @else
      <img src="{{ url('assets/img/avatar.png') }}" id="profile" alt="{{ $user->firstname }}&nbsp;{{ $user->lastname }}">
      @endif
      @if ($user->id == \Auth::id())
      <i class="material-icons profile-picture-edit">camera_alt</i>
      @endif
    </div>
    <h1><span @if ($user->id == \Auth::id()) data-profile="firstname" @endif>{{ $user->firstname }}</span>&nbsp;<span @if ($user->id == \Auth::id()) data-profile="lastname" @endif>{{ $user->lastname }}</span></h1>
    <h5>
      @if ($user->location)
      <span @if ($user->id == \Auth::id()) data-profile="location" @endif>{{ $user->location }}</span>,
      @elseif (!$user->location && $user->id == \Auth::id())
      <span data-profile="location" class="text-muted">Vul hier uw woonplaats in</span>,
      @endif
      @if ($user->province)
      <span @if ($user->id == \Auth::id()) data-profile="province" @endif>{{ $user->province }}</span>,
      @elseif (!$user->location && $user->id == \Auth::id())
      <span data-profile="province" class="text-muted">Vul hier uw provincie</span>,
      @endif
      @if ($user->country)
      <span @if ($user->id == \Auth::id()) data-profile="country" @endif>{{ $user->country }}</span>
      @elseif (!$user->location && $user->id == \Auth::id())
      <span data-profile="country" class="text-muted">Vul hier uw land in</span>
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
    <div class="card">
      <div class="col-md-12">
        <h2>Over mij</h2>
        @if ($user->biography)
        <p @if ($user->id == \Auth::id()) data-profile="biography" @endif>{{ $user->biography }}</p>
        @elseif (!$user->biography && $user->id == \Auth::id())
        <p data-profile="biography" class="text-muted">Vertel iets over jezelf.</p>
        @endif
      </div>
    </div>
    <div class="card">
      <div class="col-md-12">
        <h2>Vaardigheden</h2>
        <div @if ($user->id == \Auth::id()) data-card="skills" @endif>
          @if (count($user_skills) > 0)
          <?php $i = 1 ?>
          @foreach ($user_skills as $skill)
          <span class="label label-primary" @if ($user->id == \Auth::id()) data-profile="skill-{{ $i }}" data-id="{{ $skill['id'] }}" data-profile-array="skill" data-color="#000"@endif>{{ $skill['name'] }} @if ($user->id == \Auth::id())<i class="material-icons">delete_forever</i>@endif</span>
          <?php $i++ ?>
          @endforeach
          @endif
        </div>
      </div>
      @if ($user->id == \Auth::id())
      <div class="col-md-12 text-right">
        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#add_skill">
          Vaardigheid toevoegen
          <div class="ripple-container"></div>
        </button>
      </div>
      @endif
    </div>
    <div class="card">
      <div class="col-md-12">
        <h2>Aanvullende informatie</h2>
        <table class="table">
          <tbody>
            <tr>
              <th>Adres</th>
            </tr>
            @if ($user->address)
            <tr>
              <td @if ($user->id == \Auth::id()) data-profile="address" @endif>{{ $user->address }}</td>
            </tr>
            @elseif (!$user->address && $user->id == \Auth::id())
            <tr>
              <td data-profile="address" class="text-muted">Vul hier jouw adres in.</td>
            </tr>
            @endif
            <tr>
              <th>Postcode</th>
            </tr>
            @if ($user->zipcode)
            <tr>
              <td @if ($user->id == \Auth::id()) data-profile="zipcode" @endif>{{ $user->zipcode }}</td>
            </tr>
            @elseif (!$user->address && $user->id == \Auth::id())
            <tr>
              <td data-profile="zipcode" class="text-muted">Vul hier jouw postcode in.</td>
            </tr>
            @endif
            <tr>
              <th>Plaats</th>
            </tr>
            @if ($user->location)
            <tr>
              <td @if ($user->id == \Auth::id()) data-profile="location" @endif>{{ $user->location }}</td>
            </tr>
            @elseif (!$user->address && $user->id == \Auth::id())
            <tr>
              <td data-profile="location" class="text-muted">Vul hier jouw woonplaats in.</td>
            </tr>
            @endif
            <tr>
              <th>Provincie</th>
            </tr>
            @if ($user->province)
            <tr>
              <td @if ($user->id == \Auth::id()) data-profile="province" @endif>{{ $user->province }}</td>
            </tr>
            @elseif (!$user->address && $user->id == \Auth::id())
            <tr>
              <td data-profile="province" class="text-muted">Vul hier jouw provincie in.</td>
            </tr>
            @endif
            <tr>
              <th>Land</th>
            </tr>
            @if ($user->country)
            <tr>
              <td @if ($user->id == \Auth::id()) data-profile="country" @endif>{{ $user->country }}</td>
            </tr>
            @elseif (!$user->address && $user->id == \Auth::id())
            <tr>
              <td data-profile="country" class="text-muted">Vul hier jouw land in.</td>
            </tr>
            @endif
            <tr>
              <th>E-mailadres</th>
            </tr>
            <tr>
              <td>{{ $user->email }}</td>
            </tr>
            <tr>
              <th>Telefoonnummer</th>
            </tr>
            @if ($user->telephone)
            <tr>
              <td @if ($user->id == \Auth::id()) data-profile="telephone" @endif>{{ $user->telephone }}</td>
            </tr>
            @elseif (!$user->address && $user->id == \Auth::id())
            <tr>
              <td data-profile="telephone" class="text-muted">Vul hier jouw telefoonnummer in.</td>
            </tr>
            @endif
            <tr>
              <th>Mobiel</th>
            </tr>
            @if ($user->mobile)
            <tr>
              <td @if ($user->id == \Auth::id()) data-profile="mobile" @endif>{{ $user->mobile }}</td>
            </tr>
            @elseif (!$user->address && $user->id == \Auth::id())
            <tr>
              <td data-profile="mobile" class="text-muted">Vul hier jouw mobiele nummer in.</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@if ($user->id == \Auth::id())
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
          <input type="text" class="form-control" name="skill" id="skillSearch" placeholder="Vaardigheid" required>
        </form>
        <div id="skillResult"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
        <button type="button" class="btn btn-info" data-dismiss="modal" data-profile-add="skills">Toevoegen</button>
      </div>
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
            <input type="file" id="changePic" name="changePic" accept="image/jpeg, image/png">
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
          <input type="text" name="reason" placeholder="Reden" class="form-control" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
          <button type="submit" class="btn btn-danger">Rapporteren</button>
        </div>
      </form>
    </div>
  </div>
</div>
<button class="btn-profile-save btn btn-primary btn-raised btn-fab btn-round">
  <i class="material-icons">save</i>
</button>
<script>
  var currPage = "user/{{ $user->id }}/edit";
</script>
@include('includes.footer')
@endsection
