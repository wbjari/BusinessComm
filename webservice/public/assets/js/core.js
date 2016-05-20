// Defineer input buiten de functies
var lastInput;

$('*[data-profile]').click(function(){
	// Verander de laatst opgeslagen input naar de hiervoor staande tekst
    $('*[data-profile="reset"]').replaceWith(lastInput);

    // Sla de aangeklikte input op
    lastInput = this;

    // Verander text met een data-profile naar een input
	var input = $('<input type="text" data-profile="reset" placeholder="" class="form-control" autofocus />')
	.val( $(this).text() )
    .attr('name', $(this).attr('data-profile') )
    .attr('placeholder', $(this).attr('data-profile') )
    .css({
    	'height': $(this).height(),
    	'margin': $(this).css('margin')
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

$('.profile-header .container img, .profile-picture-edit').mouseover(function(){
	$('.profile-picture-edit').css({'display': 'block', 'cursor': 'pointer'});
}).mouseleave(function(){
	$('.profile-picture-edit').css('display', 'none');
}).click(function(){
	alert('foto upload')
})
