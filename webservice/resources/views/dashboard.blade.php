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
                    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
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
                    <img src="assets/img/avatar.png" alt="" class="img-rounded img-responsive dashboard-profile">
                    <p class="dashboard-name">{{ $user->firstname .' '. $user->lastname}}</p>
                    <p class="dashboard-function">Mediadeveloper</p>
                </a>

                <ul class="dashboard-profile-list">
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
                    <li>
                        <img src="assets/img/avatar.png" alt="">
                        <p>Vul je profiel verder in.</p>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">
                            <span class="sr-only">30% Complete</span>
                            </div>
                        </div>
                        <a href=""><button class="btn btn-primary btn-xs">Bekijken</button></a>
                    </li>
                </ul>
            </div>
        </div>
      </div>
    </div>

    @include('includes.footer')

@endsection
