// === === === //
// === Global variables === //
// === === === //

var site_url = $('meta[name=url]').attr('content');

// === === === //
// === User / company edit === //
// === === === //

var lastInput;
var lastText;
var data = {};
var dataSkills = [];

// Reageert als je op een element met data-profile="" klikt.
$(document).on('click', '*[data-profile]', function(){

	// Checkt of het geen input is.
	if(!$(this).hasClass('form-control')){

		InputToText();

		// Sla de aangeklikte input op en neem styling mee
		lastInput = this;
		lastColor = $(this).css('color');
		thisHeight = parseInt($(this).css('height'), 10);

		// Als het element de attribute data-color bevat geef de input een color styling met de waarde binnen de data-color.
		if( $(this).attr('data-color') !== "" ) {
			$(this).css('color', $(this).attr('data-color'))
		}

		// Als de hoogte kleiner is dan 24 pixels maak de input minimaal 24 pixels hoog.
		if( thisHeight < 24 ) {
			thisHeight = 24;
		}

		// Creëert de input met styling en name en placeholder attributen.
		if (!$(this).hasClass('text-muted')) {
			var inputValue = $(this).clone().children().remove().end().text();
		} else {
			var inputValue = '';
		}

		var input = $('<input type="text" data-profile="reset" class="form-control" autocomplete="off" autofocus />')
		.attr('name', $(this).attr('data-profile') )
		.attr('value', inputValue )
		.css({
			'height': thisHeight,
			'margin': $(this).css('margin'),
			'color': $(this).css('#000')
		})
		// Als tekst in input aangepast wordt toon opslaan knop en sla de aangepaste tekst op.
		.keyup(function(){
			showSaveButton('save');
			lastText = $(this).val();
			$(this).removeClass('text-muted');
		});

		// Als de kolom in database leeg is krijgt deze een text-muted class mee. Dit voorkomt dat lege data wordt meegestuurd naar de API.
		if($(input).hasClass('text-muted')){
			$(input).val('');
		}

		// Verandert de aangeklikte tekst met een data-profile attribute naar een input inclusief styling en name en placeholder attributen.
		$(lastInput).replaceWith(input);
		$(lastInput).css('color', lastColor);
	}
})

// Als je op een knop drukt met de data-toggle attribute.
$(document).on('click', '[data-toggle="modal"]', function(){

	// Vind de form binnen de modal.
	form = $( $(this).attr('data-target') ).find('form')[0];

	// Vind de submit button binnen de modal.
	submit = $( $(this).attr('data-target') ).find('[data-profile-add]');

	// Als je op de submit button klikt.
	$(submit).click(function() {

		// Telt het huidige aantal vaardigheden en voegt daar 1 toe.
		dataLength = $("[data-card=" + $(form).attr('data-name') + "]").find('span').length + 1;

		// Voeg de vaardigheid toe aan het profiel
		$("[data-card=" + $(form).attr('data-name') + "]").append(' <span class="label label-primary" data-profile="skill-'+ dataLength +'" data-profile-array="skill" data-color="#000">'+ $(form).serializeArray()[0]['value'] +'</span>');

		showSaveButton('save');

		// Voorkomt dat het formulier meerdere keren wordt toegevoegd.
		$(form)[0].reset();
	})
})

// Als je op de opslaan knop klikt.
$('.btn-profile-save').click(function(){

	InputToText();

	// Reset de vaardigheden array
	dataSkills = [];

	// Voor elk element met data-profile attribute.
	$.each( $('*[data-profile]') , function(index, value){

		// Als de kolom in database leeg is krijgt deze een text-muted class mee. Dit voorkomt dat lege data wordt meegestuurd naar de API.
		if(!$(this).hasClass('text-muted')){

			// Als het element een data-profile-array attribute bevat is het een array en moet het in een 2 dimensionale array geplaatst worden.
			if ( $(this).attr('data-profile-array') !== undefined ) {

				// Verwijder het icoontje zodat deze niet opgeslagen wordt
				$(value).children('i').remove();

				// Als de vaardigheid niet leeg is
				if($(value).text() !== ''){

					// Voeg alle vaardigheden aan een array toe.
					dataSkills.push( $(value).text() );
				}
			} else {

				// Voeg alles met een data-profile attribute toe aan de data array.
				data[$(this).attr('data-profile')] = $(value).text();
			}
		} else if ($(this).text() === 'leeg') {
			data[$(this).attr('data-profile')] = '';
		}
	})

	// Voeg de vaardigheden array toe aan de data array.
	data['skill'] = dataSkills;

	// Als de gebruiker zickh op een gebruikers of bedrijfspagina bevindt.
	if(currPage !== undefined){

		$.ajax({
			url: site_url +'/'+ currPage,
			type: "POST",
			dataType: "JSON",
			data: { data: data },
			beforeSend: function (xhr) {
		        var token = $('meta[name="_token"]').attr('content');

		        if (token) {
		            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
		        }
		    },
			success: function (response) {
				showSaveButton('saved');
			},
			error: function (response) {
				showSaveButton('error');
			}
		})
	}
});


$('.remove-post').click(function() {
	var title = $(this).parent().find('h4').html();
	var post_id = $(this).data('id');
	$('#removePostModal').find('.modal-message span').html(title);
	prepareRemovePost(post_id);
});

$('.nav.posts a').click(function() {
	var id = $(this).data('id');
	$('.the-posts').hide();
	$('.the-posts[data-id="' + id + '"]').show();
});

// === === === //
// === Company edit members and roles === //
// === === === //

$('#companyRoles').change(function(){
	console.log( $(this).val() );
});

// Edit post
$('.edit-post').click(function() {
	var post = $(this).data('id');
	var title = $(this).siblings('.post-title').text();
	var content = $(this).siblings('.post-content').text();

	$('#editPostModal').find('input[name="post_id"]').val(post);
	$('#editPostModal').find('input[name="title"]').val(title);
	$('#editPostModal').find('textarea[name="message"]').text(content);
});

// === === === //
// === Click -> ajax.js === //
// === === === //


// Delete skill
$('div[data-card="skills"] span i').click(function(e) {
	e.stopPropagation();

	var id = $(this).parent().data('id');
	ajax_removeSkill(id);

});

$('.requests button').click(function() {

	if ($(this).data('type') == 'accept') {

		var user = $(this).parent().data('id');
		var company = $('meta[name="company"]').attr('content');

		var data = {user, company};

		ajax_acceptRequest(data);

	} else if ($(this).data('type') == 'deny') {

		var user = $(this).parent().data('id');
		var company = $('meta[name="company"]').attr('content');

		var data = {user, company};

		ajax_denyRequest(data);

	}

});

$('.denyRequest').click(function() {

	var user = $(this).parent().data('id');
	var company = $('meta[name="company"]').attr('content');

	var data = {user, company};

	ajax_acceptRequest(data);

});

// Start of the company request function.
$(document).on('click', 'button#requestCompany', function() {
	// Get ID of current company.
	var companyID = $('meta[name="company"]').attr('content');

	// Send data to ajax function.
	ajax_requestCompany(companyID);
});

// Start of the company cancel request function.
$(document).on('click', 'button#cancelRequestCompany', function() {
	// Get ID of current company.
	var companyID = $('meta[name="company"]').attr('content');

	// Send data to ajax function.
	ajax_cancelRequestCompany(companyID);
});

// === === === //
// == Functions === //
// === === === //

function prepareRemovePost(post_id)
{

	$('#removePostButton').click(function() {

		ajax_removePost(post_id);

	});

}

function showSaveButton(state)
{
	if(state === 'saved'){
		$('.btn-profile-save').css('background-color', '#4CAF50').delay(2000).fadeOut(350);
	} else if(state === 'error'){
		$('.btn-profile-save').css('background-color', '#ff0000').delay(3000).fadeOut(350);
	} else {
		$('.btn-profile-save').css('background-color', '#0AB1FC').fadeIn(350);
	}
}

function InputToText()
{
	// Verander de input terug naar tekst
	$('*[data-profile="reset"]').replaceWith(lastInput);

	// Als er een verandering in de input is gemaakt.
	if( lastText === '' ){

		// Voeg text-muted class toe waardoor tekst niet meegestuurd wordt naar API.

		// Geef de value een name attribute mee
		inputName = $(lastInput).attr('data-profile');

		// Alles met dezelfde name attribute krijgt dezelfde tekst
		$('*[data-profile="'+inputName+'"]').text('leeg').addClass('text-muted');

		// Voorkom herhaling van aanpassing (wat hierboven staat) zonder dat er iets aangepast is.
		lastText = undefined;
	} else if( lastText !== undefined ){

		// verwijder text-muted class waardoor tekst meegestuurd wordt naar API.
		$(lastInput).removeClass('text-muted');

		// Geef de value een name attribute mee
		inputName = $(lastInput).attr('data-profile');

		// Alles met dezelfde name attribute krijgt dezelfde tekst
		$('*[data-profile="'+inputName+'"]').text(lastText);

		// Voorkom herhaling van aanpassing (wat hierboven staat) zonder dat er iets aangepast is.
		lastText = undefined;
	}
}

// === === === //
// == Confirm boxes === //
// === === === //

$('*[danger-action]').click(function(e){
	e.preventDefault();
	var r = confirm("Weet u zeker dat u deze melding wil "+$(this).attr('danger-action')+"?");

	if (r == true) {
		window.location.href = $(this).attr('href');
	}
})
