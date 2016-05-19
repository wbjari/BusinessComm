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