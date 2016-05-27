// === === === //
// === Global variables === //
// === === === //

var site_url = $('meta[name=url]').attr('content');

// === === === //
// === User / company edit === //
// === === === //

var lastInput;
var lastText;
var data = [];

$(document).on('click', '*[data-profile]', function(){
	if(!$(this).hasClass('form-control')){

		// Verander de laatst opgeslagen input naar de hiervoor staande tekst
		$('*[data-profile="reset"]').replaceWith(lastInput);

		if( lastText !== undefined ){
			inputName = $(lastInput).attr('data-profile');
			$('*[data-profile="'+inputName+'"]').text(lastText);
			lastText = undefined;
		}

		// Sla de aangeklikte input op
		lastInput = this;
		lastColor = $(this).css('color');
		thisHeight = parseInt($(this).css('height'), 10);

		console.log( $(this).attr('data-colors') )

		if( $(this).attr('data-color') !== "" ) {
			$(this).css('color', $(this).attr('data-color'))
		}

		if( thisHeight < 24 ) {
			thisHeight = 24;
		}

		// Verander text met een data-profile naar een input
		var input = $('<input type="text" data-profile="reset" class="form-control" autocomplete="off" autofocus />')
		.val( $(this).text() )
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

		$(lastInput).replaceWith(input);
		$(lastInput).css('color', lastColor);
	}
})

$(document).on('click', '[data-toggle="modal"]', function(){
	form = $( $(this).attr('data-target') ).find('form')[0];
	submit = $( $(this).attr('data-target') ).find('[data-profile-add]');


	$(submit).click(function() {
		if( $(form).attr('data-name') == 'skills' )
		{
			dataLength = $("[data-card=" + $(form).attr('data-name') + "]").find('span').length + 1;
			$("[data-card=" + $(form).attr('data-name') + "]").append('<span class="label label-primary" data-profile="skill-'+ dataLength +'" data-color="#000">'+ $(form).serializeArray()[0]['value'] +'</span>');
		}
		else if ($(form).attr('data-name') == 'experience')
		{

		}
		else if ($(form).attr('data-name') == 'education')
		{

		} else {
			console.log('werkt niet');
		}

		$(form)[0].reset().unbind();
	})



	//// vaardigheid
	// naam

	//// ervaring
	// naam
	// begindatum
	// einddatum
	// info

	//// opleiding
	// naam
	// begindatum
	// einddatum
	// info
})

$('.btn-profile-save').click(function(){
	$('*[data-profile="reset"]').replaceWith(lastInput);

	if(lastInput !== undefined){
		$(lastInput).text(lastText);
	}

	if( lastText !== undefined ){
		inputName = $(lastInput).attr('data-profile');
		$('*[data-profile="'+inputName+'"]').text(lastText);
		lastText = undefined;
	}

	var thisdata = $('*[data-profile]');


	for (i = 0; i < thisdata.length; i++) {
		data.push({
			name: $(thisdata[i]).attr('data-profile'),
			variable:  $(thisdata[i]).text()
		});

	}

	$.ajax({
		url: "/user/edit",
		type: "get",
		data: { data },
		success: function (response) {
			response = JSON.parse(response);
			if(response.code == 200){
				$('.btn-profile-save').css('background-color', '#419745').fadeIn();
			} else {
				alert('Er is iets fout gegaan. Probeer het later opnieuw.');
			}
		},
		error: function(jqXHR, textStatus, errorThrown) {
		   console.log(textStatus, errorThrown);
		}
	})

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

$('#changeLogo').fileupload({
    dataType: 'json',
    beforeSend: function (xhr) {
        var token = $('meta[name="_token"]').attr('content');

        if (token) {
              return xhr.setRequestHeader('X-CSRF-TOKEN', token);
        }
    },
    done: function (e, data) {
        console.log(data);
    }
});

$('.acceptRequest').click(function() {

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
