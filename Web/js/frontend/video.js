 // this script manages header photo and video display on homepage

 $(function() {

  var documentWidth = $(window).width();

  // when load page 

  if(documentWidth < 770) {
  
    $('#photo-responsive').append('<div class="container-header-picture" id="header-picture-responsive"><img src="img/animations-1.jpg" id="VideoWorker-0" class="parallax-header" alt="en-tete"/></div>');

  }
  else {

    $('.videoWrapper').append('<video loop muted id="VideoWorker-0" class="hidden-xs" autoplay="autoplay"><source src="video/header.mp4" type="video/mp4">Your browser does not support HTML5 video.</video>').addClass('done').addClass('redone');

  }

  // when resize 

  $(window).resize(function(e) {

    var docWidth = $(window).width();

    e.preventDefault();

    if(!$('.videoWrapper').hasClass('done')) {

        $('.videoWrapper').html('<video loop muted id="VideoWorker-0" class="hidden-xs" autoplay="autoplay"><source src="video/header.mp4" type="video/mp4">Your browser does not support HTML5 video.</video>').addClass('done');
    }

    if($('.videoWrapper').hasClass('done')) {

      if(docWidth < 770) {

        $('#photo-responsive').html('<div class="container-header-picture" id="header-picture-responsive"><img src="img/animations-1.jpg" id="VideoWorker-0" class="parallax-header" alt="en-tete"/></div>');
        $('.videoWrapper').html('').removeClass('redone');

      }
      else if(docWidth > 770 && !$('.videoWrapper').hasClass('redone')) {

        $('.videoWrapper').html('<video loop muted id="VideoWorker-0" class="hidden-xs" autoplay="autoplay"><source src="video/header.mp4" type="video/mp4">Your browser does not support HTML5 video.</video>').addClass('redone');

      }

    }

  });

})