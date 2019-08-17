// this class manages sliders 

$(function() {

	class Slider {

		constructor(slides, activeSlide) {

			this.slides = slides;				// all pictures 
			this.activeSlide = activeSlide;		// "active" pictures
		} 

		next() {	

		    this.slides.last().after(this.slides.first()); // move first slide after the last so that the user can go forwards
		    											   // move "active" and next slides to the right  
		    this.activeSlide.addClass('prev').removeClass('active').next('.slide').addClass('active'); 
		    this.slides.first().removeClass('prev');	   // remove "prev" so that first slide can go backwards 
		}	

		previous() {

			this.slides.removeClass('prev');	// when change from "next" to "previous", make previous picture go backwards 
	    	this.slides.first().before(this.slides.last());	// move last slide before the first so that user can go forwards 
	    										// move previous and "active" pictures to the left 
	    										// and move next pictures the extreme right     
	    	this.activeSlide.removeClass('active').prev('.slide').addClass('active').prev('.slide').addClass('prev');

		}

		button() {	// disable button during the slide 

			$('.arrow').prop('disabled', true).css('color', 'white');

			setTimeout(function() {

			  	$('.arrow').prop('disabled', false).css('color', 'black');

			}, 500);
		}

		talk() {

			alert('hello');
		}
	}


	$('#img1').css('transition', '0s').addClass('active');	// we put pictures on the wright position  
	var length = $('.slide').length;
	$('#img' + length).addClass('prev');
	
	var slides = $('.slide');								// move the last picture before the first 
	slides.first().before(slides.last());					// to be sure the user is able to go backwards 


															// on click event  
	$('button').on('click', function() {

		$('#img1').css('transition', '0.5s ease-in-out');	// we change transition of img 1 

		slides = $('.slide');								// all pictures
	 	var button = $(this);								// button clicked 
	  	var activeSlide = $('.active');						// pictures which has ".active" class

	  	if (button.attr('id') == 'next') {					// on "next" button we move pictures to the left
		   
		   var slider1 = new Slider(slides, activeSlide);
		   slider1.next();
		   slider1.button();

		}

		if (button.attr('id') == 'previous') {				// on "right" we move pictures to the right

		  	var slider2 = new Slider(slides, activeSlide);
			slider2.previous();
			slider2.button();

		}

	});

});
