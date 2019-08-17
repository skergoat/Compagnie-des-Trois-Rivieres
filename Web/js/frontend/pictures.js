// this class manages button pictures

$(function() {

  class PicturesButton {

      constructor(name1, name2, action1, action2) {

          this.class1 = name1;
          this.class2 = name2;
          this.action1 = action1;
          this.action2 = action2;
      }

      showButton() {

          $(this.class2).css('opacity', this.action2);
          $(this.class1).css('opacity', this.action1);
      }

  }

     	/**
     	*
     	*	HOMEPAGE MAP 
     	*
     	**/

     	/** shields link **/

       $('.click-shield').mouseover(function() {

       		var id = $(this).attr('id');

          var picture = new PicturesButton('#map-1', '#map-' + id, '0', '1');
          picture.showButton();

       });


        $('.click-shield').mouseout(function() {

        	var id = $(this).attr('id');

          var picture = new PicturesButton('#map-1', '#map-' + id, '1', '0');
          picture.showButton();

       });

        /** map responsive **/

        $('#maphover').mouseover(function() {

          var picture = new PicturesButton('#maphover-1', '#maphover-2', '0', '1');
          picture.showButton();

       });


        $('#maphover').mouseout(function() {

          var picture = new PicturesButton('#maphover-1', '#maphover-2', '1', '0');
          picture.showButton();

       });

   /** 
   *
   *  HOMEPAGE MODAL WINDOW
   *
   **/

    // open 
		$('a.open-modal').click(function(event) {
			
		  $(this).modal({
		    fadeDuration: 250
		  });
		  
		  $('.section-4-child-2').css('z-index', '1');
		  $('html').css('overflow-y', 'hidden');

		  return false;

		});

    // close
		$('#prejudice-1, #prejudice-2, #prejudice-3, #prejudice-4, #prejudice-5').on($.modal.AFTER_CLOSE, function(event, modal) {

			  $('.section-4-child-2').css('z-index', '999999');
		  	$('html').css('overflow-y', 'visible');

		});

   /** 
   *
   *	HOMEPAGE CHARACTERS SECTION
   *
   **/

    $('#following').mouseover(function() {

          var picture = new PicturesButton('#suite-1', '#suite-2', '0', '1');
          picture.showButton();
      });

       $('#following').mouseout(function() {

          var picture = new PicturesButton('#suite-1', '#suite-2', '1', '0');
          picture.showButton();
      });


   /**
   *
   *	HOMEPAGE LAST SECTION
   *
   **/

   /** come back to the top **/

	$('a[href^="#home"]').click(function(){
      var the_id = $(this).attr("href");
      if (the_id === '#') {
        return;
      }
      $('html, body').animate({
        scrollTop:$(the_id).offset().top
      }, 2000);
      return false;
    });


	/** direction arrows **/

	  $('.link-arrow').mouseover(function() {

          var id = $(this).attr('id');

          switch(id) {

            case 'top':
             var picture = new PicturesButton('#dir-1', '#dir-2', '0', '1');
             picture.showButton();
            break;

            case 'middle':
            var picture = new PicturesButton('#dir-1', '#dir-3', '0', '1');
            picture.showButton();
            break;

            case 'bottom':
            var picture = new PicturesButton('#dir-1', '#dir-4', '0', '1');
            picture.showButton();
            break; 

          }
       
      });

       $('.link-arrow').mouseout(function() {

            var id = $(this).attr('id');

            switch(id) {

              case 'top':
              var picture = new PicturesButton('#dir-1', '#dir-2', '1', '0');
              picture.showButton();
              break;

              case 'middle':
              var picture = new PicturesButton('#dir-1', '#dir-3', '1', '0');
              picture.showButton();
              break; 

              case 'bottom':
              var picture = new PicturesButton('#dir-1', '#dir-4', '1', '0');
              picture.showButton();
              break; 

            }
        
      });


       /**
       *
       *  ARROW SHOW PAGE
       *
       **/

       $('.arrow-left, .arrow-right').mouseover(function() {

            var id = $(this).attr('id');

            var picture = new PicturesButton('#' + id, '#' + id + '-responsive', '0', '1');
            picture.showButton();

      });

       $('.arrow-left, .arrow-right').mouseout(function() {

            var id = $(this).attr('id');

            var picture = new PicturesButton('#' + id, '#' + id + '-responsive', '1', '0');
            picture.showButton();

      });

});