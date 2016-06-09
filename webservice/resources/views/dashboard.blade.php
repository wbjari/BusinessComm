@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

@include('includes.header')

<div class="container top">

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

      <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="col-md-12">
                    <h2>Mijn bedrijven</h2>
                    @if(count($myCompanies) > 0)
                        <ul class="businesses">
                        @foreach ($myCompanies as $company)
                            <a href="company/{{ $company->company_id }}">
                                    <li>
                                        <div class="img-container">
                                            @if (is_file(public_path().$company->logo))
                                                <img src="{{ url($company->logo) }}" alt="{{ $company->name }}">
                                            @else
                                                <i class="material-icons">business</i>
                                            @endif
                                        </div>
                                        <div class="info-container">
                                            <h3>{{ $company->name }}</h3>
                                            <p>{{ $company->slogan }} <span class="text-right">{{ $company->location }}, {{ $company->country }}</span></p>
                                        </div>
                                    </li>
                                </a>
                        @endforeach
                        </ul>
                    @else
                        <h4 class="no-result">U heeft nog geen bedrijf.</h4>
                    @endif
                    <p><a href="{{ url('/create-company') }}"><button class="btn btn-raised btn-primary btn-sm pull-right">Bedrijf aanmaken</button></a></p>
                </div>
            </div>

            <div class="card">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Zoeken naar bedrijven.">
                        <span class="input-group-addon" id="searchCompany" style="cursor:"><i class="material-icons">search</i></span>
                    </div>

                    <div id="companySearchResult">
                        
                    </div>

                  @if ($nearby['nearby'] == true)
                    <h2>In de buurt</h2>
                  @else
                    <h2>Willekeurige bedrijven</h2>
                    @if ($nearby['user_haslocation'] == false)
                      <a href="{{ url('/user/' . \Auth::id()) }}">Vul eerst je woonplaats in om te kijken welke bedrijven zich in de buurt bevinden.</a>
                    @endif
                  @endif

                    <ul class="businesses">
                        @if (count($nearby['companies']) < 1)
                            <li>
                                <h4 class="no-result">Geen resultaten gevonden...</h4>
                            </li>
                        @else
                            @foreach ($nearby['companies'] as $company)
                                <a href="company/{{ $company->id }}">
                                    <li>
                                        <div class="img-container">
                                            @if (is_file(public_path().$company->logo))
                                                <img src="{{ url($company->logo) }}" alt="{{ $company->name }}">
                                            @else
                                                <i class="material-icons">business</i>
                                            @endif
                                        </div>
                                        <div class="info-container">
                                            <h3>{{ $company->name }}</h3>
                                            <p>{{ $company->slogan }} <span class="text-right">{{ $company->location }}, {{ $company->country }}</span></p>
                                        </div>
                                    </li>
                                </a>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-md-offset-1">
            <div class="card">
                <a href="{{ url('user/'.\Auth::User()->id) }}" class="dashboard-link">
                    <img src="{{ url('assets/img/avatar.png') }}" alt="{{ $user->firstname }}&nbsp;{{ $user->lastname }}" class="img-rounded img-responsive dashboard-profile">
                    <p class="dashboard-name">{{ $user->firstname .' '. $user->lastname}}</p>
                    <p class="dashboard-function">Mediadeveloper</p>
                </a>

                <ul class="dashboard-profile-list">
                    @if($profileProgress < 100)
                    <li>
                        <i class="material-icons text-info">info</i>
                        <p>Vul je profiel verder in. ({{ $profileProgress }}%)</p>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="{{ $profileProgress }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $profileProgress }}%;">
                            <span class="sr-only">{{ $profileProgress }}% Complete</span>
                            </div>
                        </div>
                        <a href="{{ url('user/'.\Auth::User()->id) }}"><button class="btn btn-primary btn-xs">Bekijken</button></a>
                    </li>
                    @else
                    <li>
                        <i class="material-icons text-info">info</i>
                        <p>Gefeliciteerd, uw profiel is volledig ingevuld!</p>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
      </div>
    </div>

    @include('includes.footer')

@endsection
