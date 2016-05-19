@extends('layouts.master')

@section('title', 'Profile')

@section('content')

  @include('includes.header')

	<div class="profile-header">
		<div class="container">
			<img src="../assets/img/avatar.png" alt="">
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

	<button class="btn-profile-save btn btn-primary btn-raised btn-fab btn-round">
		<i class="material-icons">save</i>
	</button>

  @include('includes.footer')

<script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
<script>
// Defineer input buiten de functies
var lastInput;

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
	// Verander de laatst opgeslagen input naar de hiervoor staande tekst
    $('*[data-profile="reset"]').replaceWith(lastInput);

    // Sla de aangeklikte input op
    lastInput = this;

    // Verander text met een data-profile naar een input
	var input = $('<input type="text" data-profile="reset" placeholder="" class="form-control" />')
	.val( $(this).text() )
    .attr('name', $(this).attr('data-profile') )
    .attr('placeholder', $(this).attr('data-profile') )
    .css({
    	"heigth": $(this).height(),
    	"font-size": $(this).css('font-size'),
    	"margin": $(this).css('margin')
    })
    .keyup(function(e){
    	$('.btn-profile-save').css('background-color', '#ff0000').fadeIn();
    });

    $(lastInput).replaceWith(input);
});

$('.btn-profile-save').click(function(){
	var values = '';

	$.ajax({
        url: "1",
        type: "post",
        data: values,
        success: function (response) {
           console.log(response);

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    })
	$(this).css('background-color', '#419745').fadeIn();
})
</script>

@endsection
