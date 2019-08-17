
// This script manages forms  

$(function() {

	// 	hide success or error message 

    if($('.message').hasClass('hide-message')) {

		setTimeout(function() {

			$('.hide-message').fadeOut('slow');

		}, 2000);
	}

	// prevent create page form from being sent twice 


    $('form').submit(function() {

        $('#new-anim').prop('disabled', true);
        $('#new-work').prop('disabled', true);
        $('#new-pred').prop('disabled', true);

    });

	// white input background when click in connexion form 

	if($('.input.connect').val() == '') {

		$(this).css('background', 'transparent');
	}
	else {

		$(this).css('background', 'white');
	}

	var empty = true;

	$('.input.connect').focus(function() {

		$(this).css('background', 'white');

		$(this).blur(function() {

			if($(this).val() == "") {

				$(this).css('background', 'transparent');
			}
			else {

				$(this).css('background', 'white');
			}

		});

	});

});