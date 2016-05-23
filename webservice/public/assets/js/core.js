// === === === //
// === Global variables === //
// === === === //

var site_url = $('meta[name=url]').attr('content');

// === === === //
// === User / company edit === //
// === === === //

// Defineer input buiten de functies
var lastInput;

$('*[data-profile]').click(function(){
	// Verander de laatst opgeslagen input naar de hiervoor staande tekst
    $('*[data-profile="reset"]').replaceWith(lastInput);

    // Sla de aangeklikte input op
    lastInput = this;

    // Verander text met een data-profile naar een input
	var input = $('<input type="text" data-profile="reset" placeholder="" class="form-control" autocomplete="off" autofocus />')
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
    })

    setInterval(function(){
    	input.focus();
    }, 5)

    $(lastInput).replaceWith(input);
})


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


// $('#newPostForm').submit(function(e) {
//   e.stopPropagation();
//   e.preventDefault();
//
//   // formdata
//   var data = $(this).find('input[type="file"]').prop('files');
//
//   console.log(data);
//   ajax_newPost(data);
//
// })

// === === === //
// == Functions === //
// === === === //
