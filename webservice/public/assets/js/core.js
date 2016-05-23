// === === === //
// === Global variables === //
// === === === //

var site_url = $('meta[name=url]').attr('content');

// === === === //
// === User / company edit === //
// === === === //

var lastInput;
var lastText;

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

		// Verander text met een data-profile naar een input
		var input = $('<input type="text" data-profile="reset" class="form-control" autocomplete="off" autofocus />')
		.val( $(this).text() )
		.attr('name', $(this).attr('data-profile') )
		.attr('placeholder', $(this).attr('data-profile') )
		.css({
			'height': $(this).height(),
			'margin': $(this).css('margin'),
			'color': $(this).css('color')
		})
		.keyup(function(){
			$('.btn-profile-save').css('background-color', '#ff0000').fadeIn();
			lastText = $(this).val();
		});

		$(lastInput).replaceWith(input);
	}
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
	var data = [];

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
				alert('fuck');
			}
		},
		error: function(jqXHR, textStatus, errorThrown) {
		   console.log(textStatus, errorThrown);
		}
	})
	
})

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

// === === === //
// == Functions === //
// === === === //

function changeLogo()
{



}
