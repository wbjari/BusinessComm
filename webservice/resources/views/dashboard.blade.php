@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

@include('layouts.header')

<div class="container">
      <div class="row">
        <div class="col-md-4 bordered-rounded">
          	<h2>In de buurt</h2>

			<ul class="businesses">

				@foreach ($companies as $company)

					<a href="#">
						<li>
							<div class="img-container">
								<img src="assets/img/companies/{{ $company->logo }}" alt="">
							</div>
							<div class="info-container">
								<h3>{{ $company->name }}</h3>
								<p>{{ $company->slogan }}</p>
							</div>
						</li>
					</a>
				@endforeach

<!-- 				<a href="#"><li>
					<div class="img-container">
						<img src="data:image/png;base64,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" alt="">
					</div>
					<div class="info-container">
						<h3>Google</h3>
						<p>Mediatechnologie</p>
					</div>
				</li></a>
				<a href="#"><li>
					<div class="img-container">
						<img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSBcqrZGK0WYKSCt0TPSINKCP7OxPO-u9mwOnWgBrA75Dk4UJXIVXQymYU" alt="">
					</div>
					<div class="info-container">
						<h3>Facebook</h3>
						<p>Mediatechnologie</p>
					</div>
				</li></a>

				<a href="#"><li>
					<div class="img-container">
						<img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSBcqrZGK0WYKSCt0TPSINKCP7OxPO-u9mwOnWgBrA75Dk4UJXIVXQymYU" alt="">
					</div>
					<div class="info-container">
						<h3>BusinessComm</h3>
						<p><?= $companies ?></p>
					</div>
				</li></a>

				<a href="#"><li>
					<div class="img-container">
						<img src="data:image/jpeg;base64,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" alt="">
					</div>
					<div class="info-container">
						<h3>Microsoft</h3>
						<p>Mediatechnologie</p>
					</div>
				</li></a>
				<a href="#"><li>
					<div class="img-container">
						<img src="data:image/jpeg;base64,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" alt="">
					</div>
					<div class="info-container">
						<h3>Apple</h3>
						<p>Mediatechnologie</p>
					</div>
				</li></a> -->
			</ul>

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

      <hr>

      <footer>
        <p>© 2016 BusinessComm, Inc.</p>
      </footer>
    </div>

@endsection
