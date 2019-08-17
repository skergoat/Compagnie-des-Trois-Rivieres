// this script create header parallax effect 

$(window).scroll(function() {

  var scrollTop = $(this).scrollTop();

  $('#VideoWorker-0').css('top', -(scrollTop * 0.6) + 'px');

});