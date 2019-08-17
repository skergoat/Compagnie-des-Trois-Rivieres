// this script manages little helmet position on homepage

$(function() {

	$myElem = $('#start');
	 
	$(document).ready(function(){

	   $(window).bind("scroll", function() {

	       if($(this).scrollTop() >= $myElem.offset().top) { // if scroll down

	             $('#tracker').css('position', 'fixed').css('top', '28.7rem');
			} 
	 		else if($(this).scrollTop() <= $myElem.offset().top){	// if scroll up 

	          $('#tracker').css('position', 'absolute').css('top', '10rem');

			}
	 
		});
	   
	});

});