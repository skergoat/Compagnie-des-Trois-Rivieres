// $('body').append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
  $('body').append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
  $(window).on('load', function(){

    $('html').css('overflow-y', 'hidden');
    setTimeout(removeLoader, 100); //wait for page load PLUS two seconds.
  });
  function removeLoader(){
      $( "#loadingDiv" ).fadeOut(500, function() {

        $('html').css('overflow-y', 'scroll');
        // fadeOut complete. Remove the loading div
        $( "#loadingDiv" ).remove(); //makes page more lightweight 
    });  
  }