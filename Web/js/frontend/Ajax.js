// this class manages show pages loaded with ajax  

$(function(){

	var size1 = $('.info-ajax').height();
	var size2 = $('#general-container').height();

	class Ajax {

		constructor(direction, arrow_id) {

			this.direction = direction;
			this.arrow_id = arrow_id;
			this.id = $('.info-ajax').attr('id');
			this.max = $('#high-id').text();
			this.min = $('#low-id').text();
			this.ajaxId = $('.show-ajax').attr('id');	
			this.self = this;
		}

		showSingles() {

			// disable buttons so as the script has time to execute the fadeOut and fadeIn
			$('.arrow-buttons').prop("disabled", true);

			setTimeout(function() {

				$('.arrow-buttons').prop("disabled", false);
				
			}, 300);

			// get Id of the page 
			
			this.id = parseInt(this.id);

			// calculate id of the page we want to get 

			var id_redirect;

			this.max = parseInt(this.max);
			this.min = parseInt(this.min);

			if(this.direction == 'left') {

				if(this.id == this.min) {

					id_redirect = this.max;
				}
				else {

					id_redirect = this.id - 1;	
				}
			}

			if(this.direction == 'right') {

				if(this.id == this.max) {

					id_redirect = this.min;
				}
				else {

					id_redirect = this.id + 1;	
				}
			}

			// use this functions for Animations, Workshops and Prejudices 

			switch(this.arrow_id) {

		 		case 'prejudices-left':
		 		case 'prejudices-right':
		 		var keyword = "/prejudices-ajax-";
		 		var url = "/prejudices-";
		 		break;

		 		case 'animations-left':
		 		case 'animations-right':
		 		var keyword = "/animations-ajax-";
		 		var url = "/animations-";
		 		break;

		 		case 'workshops-left':
		 		case 'workshops-right':
		 		var keyword = "/workshops-ajax-";
		 		var url = "/workshops-";
		 		break;
		 	}

		 	var ajaxId = this.ajaxId;
		 	var self = this.self;

			$('#' + ajaxId).html(''); 
										
			// keep the size of the document during loading	

			$('#' + ajaxId).css('height', size1);								   

			$('#' + ajaxId).load(keyword + id_redirect, function() {

				// refreshing the url wothout reloading the page 
			
				history.pushState(null, '', url + id_redirect); 

				// resize document according to the size of the page loaded
				$('#' + ajaxId).css('height', 'auto');

				// vars and css for slider 
				$('#img1').css('transition', '0s').addClass('active');
				var length = $('.slide').length;
				$('#img' + length).addClass('prev');

				var slides = $('.slide');
				slides.first().before(slides.last());

			
				$('button').on('click', function() {

					$('#img1').css('transition', '0.5s ease-in-out');
					slides = $('.slide');
				  	var button = $(this);
				  	var activeSlide = $('.active');

				  	if (button.attr('id') == 'next') {
					    // Move first slide to the end so the user can keep going forward
					    slides.last().after(slides.first());
					    // Move active class to the right
					    activeSlide.addClass('prev').removeClass('active').next('.slide').addClass('active');
					    slides.first().removeClass('prev');
					   
					}

					  // Previous function
				  if (button.attr('id') == 'previous') {

				  	slides.removeClass('prev');
				    // Move the last slide before the first so the user can keep going backwards
				    slides.first().before(slides.last());
				    // Move active class to the left
				    activeSlide.removeClass('active').prev('.slide').addClass('active').prev('.slide').addClass('prev');

				  }

				  $('.arrow').prop('disabled', true).css('color', 'white');

				  setTimeout(function() {

				  	$('.arrow').prop('disabled', false).css('color', 'black');

				  }, 500);

				});

			// callback for comeBack() function 
				$('#animationsBack').click(function() {

					self.comeBack();

			    });

			}); 
		}
	}

	$('.arrow-buttons').click(function(e) {

		e.preventDefault();

		var direction;

		if($(this).hasClass('arrow-left')) { 

			direction = "left";
			var arrow_id = $(this).attr('id');
		}
		if($(this).hasClass('arrow-right')) {

			direction = "right";
			var arrow_id = $(this).attr('id');
		}

		var arrow = new Ajax(direction, arrow_id);
		arrow.showSingles();

	});
	
});


