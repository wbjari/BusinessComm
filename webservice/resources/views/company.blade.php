@extends('layouts.master')

@section('title', 'Profile')

@section('content')

  @include('includes.header')

	<div class="profile-header">
		<div class="container">
			<img src="{{ url('assets/img/avatar.png') }}" alt="">
			<h1 data-profile="name">Koen de Bont</h1>
			<h2 data-profile="function">Functie</h2>
			<h5 data-profile="location">Breda, Provincie Noord-Brabant, Nederland</h5>
		</div>
	</div>

	<div class="container">
		<div class="card">
			<h2>Over mij</h2>
		</div>
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
