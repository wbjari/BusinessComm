@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

@include('includes.header')

<div class="container top">
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
                                            <p>{{ $company->slogan }}</p>
                                        </div>
                                    </li>
                                </a>
                        @endforeach
                        </ul>
                    @else
                        <h4 class="no-result">Geen resultaten gevonden...</h4>
                    @endif
                    <p><a href="{{ url('/create-company') }}"><button class="btn btn-raised btn-primary btn-sm pull-right">Bedrijf aanmaken</button></a></p>
                </div>
            </div>

            <div class="card">
                <div class="col-md-12">
                    <h2>In de buurt</h2>

                    <ul class="businesses">
                        @if (count($companies) < 1)
                            <li>
                                <h4 class="no-result">Geen resultaten gevonden...</h4>
                            </li>
                        @else
                            @foreach ($companies as $company)
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
                                            <p>{{ $company->slogan }}</p>
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
                    @endif
                    <li>
                        <i class="material-icons text-danger">error</i>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit., beatae rem, voluptas. Consequatur.</p>
                        <a href=""><button class="btn btn-primary btn-xs">Bekijken</button></a>
                    </li>
                    <li>
                        <i class="material-icons text-warning">warning</i>
                        <p>Quas quidem, ratione. In pariatur porro saepe nemo non, facere deserunt, dignissimos reprehenderit tempore omnis atque nisi corporis.</p>
                        <div class="progress">
                            <div class="progress-bar" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">
                            </div>
                        </div>
                        <a href=""><button class="btn btn-primary btn-xs">Bekijken</button></a>
                    </li>
                    <li>
                        <i class="material-icons text-info">info</i>
                        <p>Saepe nobis labore, asperiores repudiandae laudantium voluptas.</p>
                        <a href=""><button class="btn btn-primary btn-xs">Bekijken</button></a>
                    </li>
                </ul>
            </div>
        </div>
      </div>
    </div>

    @include('includes.footer')

@endsection
