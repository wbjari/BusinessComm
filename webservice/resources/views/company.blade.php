@extends('layouts.master')

@section('title', 'Profile')

@section('content')

  @include('includes.header')

	<div class="profile-header">
		<div class="container">
			<img src="{{ url('assets/img/avatar.png') }}" alt="">
			<h1 data-profile="name">{{ $company['name'] }}</h1>
			<h2 data-profile="function">Functie</h2>
			<h5 data-profile="location">
        @if ($company['location'])
          {{ $company['location'] }},
        @endif
        @if ($company['province'])
          {{ $company['province'] }},
        @endif
        @if ($company['country'])
          {{ $company['country'] }}
        @endif
		</div>
	</div>

	<div class="container">
    @if ($company['biography'])
		<div class="card">
			<h2>Biografie</h2>
      <p> {{ $company['biography'] }} </p>
		</div>
    @endif
	</div>

  @include('includes.footer')

<script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
<script>


$('*[data-profile]').click(function(){
	// active, means we were in input mode - revert input to td
    if ($(this).hasClass('active')) {
        // go through each column in the table
        $(this).each(function() {
           // get column text
           var colData = $(this).val();
           // get column class
           var colClass = $(this).attr('class');
           // create td element
           var col = $('<td></td>');
           // fill it with data
           col.addClass(colClass).text(colData);
           // now. replace
           $(this).replaceWith(col);
        });
    } else {
        // go through each column in the table
        $(this).each(function() {
           // get column text
           var colData = $(this).text();
           // get column class
           var colClass = $(this).attr('class');
           // create input element
           var input = $('<input />');
           // fill it with data
           input.addClass(colClass).val(colData);
           // now. replace
           $(this).replaceWith(input);
        });

    }
});

</script>

@endsection
