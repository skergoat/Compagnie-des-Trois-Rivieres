// open - close menu in topbar

$(function(){

	$('.burger-container').click(function(){

		if(!$('.burger-slice').hasClass('close')) {

			// menu 
			$('#open-close-menu').css({'z-index':'999999999', 'transition' : '0.5s ease-in-out', 'height': '100%'});
			$('html').css('overflow-y', 'hidden');

			// burger
			$('.burger-slice').css('border', '2px solid #DE4C40');
			$('.burger-slice').addClass('close'); 

			$('.burger-slice:first-child').addClass('rotateTop');
			$('.burger-slice:nth-child(2)').addClass('hideMiddle');
			$('.burger-slice:last-child').addClass('rotateBottom');

		}

		else {

			// menu
			$('#open-close-menu').css({'z-index':'0', 'transition' : '0.5s ease-in-out', 'height': '0%'});
			$('html').css('overflow-y', 'scroll');

			// burger
			$('.burger-slice').css('border', '2px solid #A1372B').css('transition', '0.5s ease-in-out');
			$('.burger-slice').removeClass('close'); 

			$('.burger-slice:first-child').removeClass('rotateTop');
			$('.burger-slice:nth-child(2)').removeClass('hideMiddle');
			$('.burger-slice:last-child').removeClass('rotateBottom');

		}

	});

});