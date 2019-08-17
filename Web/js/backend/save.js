
//  This class manage admin pages that update content and media 


var test = true; // for alert before quit page 


$(function() {

   class Media {

      constructor(value, select, info) {

        this.id = $(select).attr('id');       
        this.value = value;
        this.select = select;
        this.info = info;

      }

      uploadMain() {

        $('#delete-main').prop('checked', this.value);

        if(this.select == 'upload') {

          $('#upload-main-picture').click();
        }  
        
        if(this.select == 'empty') {

          $('#upload-main-picture').val('');
          $('#main-picture-preview').attr('src', '../img/grey.png');

        }

      }

      addSlider() {

          $('#add-' + this.value).click(); 
      }

      publish() {

        if($('.eye-publish').hasClass('fas fa-eye-slash')) {

            $('.eye-publish').removeClass('fas fa-eye-slash');
            $('.eye-publish').addClass('far fa-eye');
        }
        else if($('.eye-publish').hasClass('far fa-eye')) {

            $('.eye-publish').removeClass('far fa-eye');
            $('.eye-publish').addClass('fas fa-eye-slash');
        }

        $('#published-true').prop('checked', this.value);
        $('#published-false').prop('checked', this.select);
        $('#title-publish').text(this.info);

      }

      selectMedia() {

        this.select.load('/admin/' + this.id + '-media-' + this.value + '-' + this.info, function() {

          var compteur = 3;                               
          var height = $('.container-height').height();   
          
         
          /** add picture to new fields **/
        

          $('.add-slider').click(function(e) {

              e.preventDefault();

              var id = $(this).attr('id');
              $('#delete-' + id).prop('checked', false);

              var media = new Media(id, null);
              media.addSlider();

          });


          /** slider picture preview **/
         

          $(".slider-preview").change(function() {

            var previewId = $(this).attr('id');
            var id = '#preview-' + previewId;

            readSlider(this, id);

          });

       
          /** delete single slide **/
          

          $('.delete-sliders').click(function() {

            var id = $(this).attr('id');

              $('#delete-' + id).prop('checked', true);
              $('#add-' + id).val('');
              $('#preview-add-' + id).attr('src', '../img/grey.png'); 

          });

        });

      }

   }


  /***
  *
  * LOAD OR UPLOAD MEDIA OPTIONS 
  *
  ***/

  var select =  $('.container-media-select');                   

  /** when page is loaded **/

  if(!$('.mediaType').hasClass('radio')) {            
                                                               
    $('.mediaType:first').prop('checked', true);
    select.append('<div class="panel-block" style="display:flex;align-items;min-height:300px;border:none;"><p>Veuillez enregistrer une image a la une dans le formulaire en bas de page</p></div>');

  }

  /** load media when page is loaded **/

    
  if($('.mediaType').hasClass('radio')) {

      var value = $('.moduleInfo').attr('id');
      var info = $('.info').attr('id');

      select.html('');                  

      if(value == "picture") {            

          select.append('<div class="panel-block" style="display:flex;align-items;min-height:300px;border:none;"><p>Veuillez enregistrer une image a la une dans le formulaire en bas de page</p></div>');
      }
      else {                              

        var media = new Media(value, select, info);
        media.selectMedia(); 

      }

  }

  /** select media options **/

  $('input[type="radio"]').click(function() {

    var value = $(this).prop('value');                                         
    var info = $('.info').attr('id'); 
    
    select.html('');                   

    if(value == "picture") {            

        select.append('<div class="panel-block" style="display:flex;align-items;min-height:300px;border:none;"><p>Veuillez enregistrer une image a la une dans le formulaire en bas de page</p></div>');
    }
    else {                             

      var media = new Media(value, select, info);
      media.selectMedia(); 

    }

  });

  /** upload main picture **/   

  $('#add-main').click(function(e) {

    e.preventDefault();

    var upload = new Media(false, 'upload');
    upload.uploadMain(); 


  });


  /***
  *
  * PICTURES PREVIEW
  *
  ***/

  /** preview function **/

  function readSlider(input, id) {

    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {

        if(id == null) {

          $('#main-picture-preview').attr('src', e.target.result);

        } else {

          $(id).attr('src', ''+ e.target.result +'');

        }
      
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  /** main picture preview **/

  $("#upload-main-picture").change(function() {
    readSlider(this, null);
  });

  /** Empty main picture preview **/

  $('#remove-picture').click(function() {

      var empty = new Media(true, 'empty');
      empty.uploadMain(); 

  }); 

  /***
  *
  * PUBLISH PAGE
  *
  ***/

  $('.published').click(function() {

    if($(this).hasClass('true')) {

      $(this).removeClass('true');
      $(this).addClass('false');

      var published = new Media(false, true, 'Publier');
      published.publish();

    }
    else if($(this).hasClass('false')) {

      $(this).removeClass('false');
      $(this).addClass('true');

      var published = new Media(true, false, 'Cacher');
      published.publish();

    }

  });

  /***
  *
  * SAVE OR DELETE PAGE
  *
  ***/

  // save 

  $('#save-all').click(function() {

     test = false;  // no unload  
    
  });

  // delete 

  $('.delete-class').click(function(e) {

      e.preventDefault();
      test = false;
      var href = $(this).attr('href');

     if(confirm('Voulez-vous vraiment supprimer la page ?')) {

        window.location.href = href;
    }

    return false;

  });



});