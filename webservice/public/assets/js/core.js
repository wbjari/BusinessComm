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
var testdata = [];

$(document).on('click', '*[data-profile]', function(){
	if(!$(this).hasClass('form-control')){

		// Verander de laatst opgeslagen input naar de hiervoor staande tekst
		$('*[data-profile="reset"]').replaceWith(lastInput);

		if( lastText !== undefined ){
			$(lastInput).removeClass('text-muted');
			inputName = $(lastInput).attr('data-profile');
			$('*[data-profile="'+inputName+'"]').text(lastText);
			lastText = undefined;
		}

		// Sla de aangeklikte input op
		lastInput = this;
		lastColor = $(this).css('color');
		thisHeight = parseInt($(this).css('height'), 10);

		if( $(this).attr('data-color') !== "" ) {
			$(this).css('color', $(this).attr('data-color'))
		}

		if( thisHeight < 24 ) {
			thisHeight = 24;
		}

		// Verander text met een data-profile naar een input
		var input = $('<input type="text" data-profile="reset" class="form-control" autocomplete="off" autofocus />')
		.attr('name', $(this).attr('data-profile') )
		.attr('placeholder', $(this).attr('data-profile') )
		.css({
			'height': thisHeight,
			'margin': $(this).css('margin'),
			'color': $(this).css('color')
		})
		.keyup(function(){
			$('.btn-profile-save').css('background-color', '#ff0000').fadeIn();
			lastText = $(this).val();
		});

		if($(input).hasClass('text-muted')){
			$(input).val('');
		}

		$(lastInput).replaceWith(input);
		$(lastInput).css('color', lastColor);
	}
})

$(document).on('click', '[data-toggle="modal"]', function(){
	form = $( $(this).attr('data-target') ).find('form')[0];
	submit = $( $(this).attr('data-target') ).find('[data-profile-add]');


	$(submit).click(function() {
		dataLength = $("[data-card=" + $(form).attr('data-name') + "]").find('span').length + 1;
		addHtml = ' <span class="label label-primary" data-profile="skill-'+ dataLength +'" data-profile-array="skill" data-color="#000">'+ $(form).serializeArray()[0]['value'] +'</span>';

		$("[data-card=" + $(form).attr('data-name') + "]").append( addHtml );

		$(form)[0].reset().unbind();
	})
})

$('.nav.posts a').click(function() {
	var id = $(this).data('id');
	$('.the-posts').hide();
	$('.the-posts[data-id="' + id + '"]').show();
});

$('.btn-profile-save').click(function(){
	$('*[data-profile="reset"]').replaceWith(lastInput);

	if(lastInput !== undefined){
		$(lastInput).text(lastText);
	}

	if( lastText !== undefined ){
		inputName = $(lastInput).attr('data-profile');
		$('*[data-profile="'+inputName+'"]').text(lastText);
		lastText = undefined;
		$(lastInput).removeClass('text-muted');
	}

	var thisdata = $('*[data-profile]');

	$.each(thisdata, function(index, value){
		if(!$(this).hasClass('text-muted')){
			if ( $(this).attr('data-profile-array') !== undefined ) {
				testdata.push($(value).text());
			} else {
				data[$(this).attr('data-profile')] = $(value).text();
			}
		}
	})

	if(currPage == "user/{{ $user->id }}/edit") {
		data['skill'] = testdata;
	}

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
				console.log(response);

				response = JSON.parse(response);
				if(response.code == 200){
					$('.btn-profile-save').css('background-color', '#419745').fadeIn();
					console.log(response)
				} else {
					alert('Er is iets fout gegaan. Probeer het later opnieuw.');
				}
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

// === === === //
// === Click -> ajax.js === //
// === === === //

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