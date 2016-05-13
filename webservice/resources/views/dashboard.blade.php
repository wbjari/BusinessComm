@extends('layouts.master')

@section('content')

@include('layouts.header')

<div class="container">
      <div class="row">
        <div class="col-md-4 bordered-rounded">
          <h2>In de buurt</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
        </div>
        <div class="col-md-3 col-md-offset-1 bordered-rounded">
          <h2>Mijn bedrijven</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a href=""><button class="btn btn-raised btn-primary btn-sm pull-right">Bedrijf aanmaken</button></a></p>
       </div>
        <div class="col-md-3 col-md-offset-1 bordered-rounded">
        	<div class="row">
        		<img src="assets/img/avatar.png" alt="" class="img-rounded img-responsive dashboard-profile">
        		<p class="dashboard-name">Koen de Bont</p>
        		<p class="dashboard-function">Mediadeveloper</p>
        	</div>

			<p>Vul uw profiel verder in</p>
        	<div class="progress">
				<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">
				<span class="sr-only">30% Complete</span>
				</div>
			</div>
        </div>
      </div>

      <hr>

      <footer>
        <p>© 2016 BusinessComm, Inc.</p>
      </footer>
    </div>

@endsection