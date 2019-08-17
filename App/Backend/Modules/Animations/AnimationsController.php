<?php

namespace App\Backend\Modules\Animations;

use \CRFram\BackController;
use \CRFram\HTTPRequest;
use \Entity\Animations;
use \FormBuilder\ModuleFormBuilder;
use \CRFram\FormHandler;
use App\Backend\Modules\Pictures\PicturesController;

class AnimationsController extends BackController
{

  // show table of pages for each module 
  
  public function executeIndex(HTTPRequest $request)
  {

    $manager = $this->managers->getManagerOf('Animations');
    
    $messageTotal = $this->app->config()->get('total');     // paginate 
    $_SESSION['total'] = $messageTotal;              
                 
    $total = $manager->countTotal();

    $total = $total[0];

    $nbdePages = ceil($total / $messageTotal);

     $_SESSION['nbdePages'] = $nbdePages;

    if($request->getData('paginate') != NULL){

      $pageActuelle = intval($request->getData('paginate'));

      if($nbdePages > 1) {

        $_SESSION['pageActuelle'] = $pageActuelle; 
      }

      if($pageActuelle > $nbdePages){

        $pageActuelle = $nbdePages;
      }

    } else {

      $pageActuelle = 1;
    }

    $premiereEntree = ($pageActuelle - 1) * $messageTotal;

    $animations = $manager->getPaginate($premiereEntree, $messageTotal, NULL); // show table  

    $this->page->addVar('nbdePages', $nbdePages);
    $this->page->addVar('pageActuelle', $pageActuelle);
    $this->page->addVar('animations', $animations);
    $this->page->addVar('upTitle', "animations");

  }

  // create new page (+ empty main picture)

  public function executeCreate() {

    // if list of pages is at page 2
    // we come back at page 2 after having created a new page 

     if($_SESSION['nb'] == $_SESSION['total']) {

        $_SESSION['nbdePages'] = $_SESSION['nbdePages'] + 1;
        $_SESSION['pageActuelle'] = $_SESSION['nbdePages'];

      }

      else {

        $_SESSION['pageActuelle'] = $_SESSION['nbdePages'];
      }

    // create manipulable id's for ajax
    // this helps to calculate which image to show 
    // on the front page slider  

    $table = $this->managers->getManagerOf('Animations')->countTable();

    if($table == 1) { 

       $high = $this->managers->getManagerOf('Animations')->HighAjax();
       $ajax = $high + 1;


    } else { 

       $ajax = 1; 

    }

    // new page 

    $newAnimation = new Animations([

        'ajax_id' => $ajax,
        'title' => NULL,
        'description' => NULL,
    ]);

    $manager = $this->managers->getManagerOf('Animations');
    
    $manager->add($newAnimation);
    $maxId = $manager->HighId();

    unset($_SESSION['flash']);

    // new pictures 

    $picturesController = new PicturesController($this->app, 'Pictures', 'test');
    $picturesController->createPictureWithPage('animations', $maxId);
    $picturesController->createSliderWithPage('animations', $maxId);

    $this->app->httpResponse()->redirect('/admin/animations-modify-' . $maxId);


  }

  //  update page content (text forms) 

  public function executeModify(HTTPRequest $request) {

    // entity updated   

    $animations = $this->managers->getManagerOf('Animations')->getUnique($request->getData('id'));

    // entity of pictures joined 

    $manager = $this->managers->getManagerOf('Pictures');
    $unique = $manager->getUnique('animations', $request->getData('id'));

    // nb of slides (if $_POST['media'] == 'slider')

    $countSlides = $manager->countSlides('animations', $request->getData('id'));

    // if form is sent 

    if ($request->method() == 'POST')
    {

      // we save page content (title, content)
      // but we put conditions to save the medias 

      // condition to update video  

      if(isset($_POST['video_url']) && $_POST['video_url'] != NULL) {

        if(!preg_match('#(?:<iframe[^>]*)(?:(?:\/>)|(?:>.*?<\/iframe>))#', $_POST['video_url'])) {

            $errors = true;
            $errorMessage = 'Seuls les iframe sont acceptés.';

            if($animations->Video_url() != NULL) {

              $video = $animations->Video_url();
            }
            else {

              $video = NULL;
            }

        }
        else {

          $video = $_POST['video_url'];
        }

      }
      else if(isset($_POST['video_url']) && $_POST['video_url'] == NULL && $animations->Video_url() != NULL) {

          $video = $animations->Video_url();
      }
      else {

          $video = NULL;
      }

      $animations = new Animations([
          
          'ajax_id' => $animations->Ajax_Id(),
          'title' => $request->postData('title'),
          'description' => $request->postData('description'),
          'media' => $_POST['media'],
          'video_url' => $video,
          
        ]);

      $animations->setId($request->getData('id'));

      $animations->setPublished($_POST['publish']); 


      // count nb of pictures sent in slider 

      for($i = 1; $i <= 10 ; $i++) {

        if(isset($_FILES['add-slider-' . $i])) {

          if($_FILES['add-slider-' . $i]['size'] != 0) {

            $nb[] = $_FILES['add-slider-' . $i]['size'];
            $result = count($nb);

          }
        }

        // count nb of pictures deleted in slider 

        if(isset($_POST['empty-slider-' . $i])) {

          if($_POST['empty-slider-' . $i] != NULL) {

            $empty[] = $_POST['empty-slider-' . $i];
            $resultEmpty = count($empty);

          }
        }

      }

      // if media = 'picture' and no picture 

      if($_POST['media'] == 'picture' && $_FILES['add-main-picture']['size'] == 0 && $unique->Src() == NULL)
      {

        $errors = true;
        $errorMessage = "N'oubliez pas d'ajouter l'image a la une !";

      }

      // if media = video ad no video 

      else if($_POST['media'] == 'video' && $_POST['video_url'] == NULL && $animations->Video_url() == NULL) {


           $errors = true;
           $errorMessage = "N'oubliez pas d'ajouter la vidéo !";
       

      }

      //if video is not an iframe then send error message  

      else if($_POST['media'] == 'video' && $_POST['video_url'] != NULL) {

        if(!preg_match('#(?:<iframe[^>]*)(?:(?:\/>)|(?:>.*?<\/iframe>))#', $_POST['video_url'])) {

            $errors = true;
            $errorMessage = 'Seuls les iframe sont acceptés.';
        }
        else {

           $errors = false;

        }

      }

      // if nb of slides is < 3 

      else if(
              $_POST['media'] == 'slider' && !isset($result) && !isset($resultEmpty) && $countSlides[0] == 0 ||
              $_POST['media'] == 'slider' && isset($result) && $result < 3 && $countSlides[0] < 3 ||
              $_POST['media'] == 'slider' && isset($result) && $result == 0 && $countSlides[0] < 3 ||
              $_POST['media'] == 'slider' && $countSlides[0] <= 3 && isset($resultEmpty) && !isset($result) ||
              $_POST['media'] == 'slider' && $countSlides[0] >= 3 && isset($resultEmpty) && $resultEmpty > ($countSlides[0] - 3) && !isset($result) ||
              $_POST['media'] == 'slider' && isset($resultEmpty) && $countSlides[0] == $resultEmpty
              
            )

      {

        $errors = true;
        $errorMessage = 'Entrez au moins 3 images dans le slider. Sinon ça va buger ;-)';

      }
      else {

          // send errors 

         $errors = false;

      }


      // if errors, they are sent to the page 

      if(isset($errors) && $errors == true) {

          $this->page->addVar('errorMessage', $errorMessage);

      }

      // else form is sent an page is modified 

      else {

        $picturesController = new PicturesController($this->app, 'Pictures', 'test'); 
        $picturesController->updateSlider('animations',  $animations->getId(), $_FILES, $_POST); 

        if(isset($_POST['delete-main'])) {

          $picturesController->updateMain('animations',  $animations->getId(), $_FILES['add-main-picture'], $_POST['delete-main']); 

        }
        else {

          $picturesController->updateMain('animations',  $animations->getId(), $_FILES['add-main-picture'], NULL);

        } 

      }

      $this->managers->getManagerOf('Animations')->update($animations);

    }

    // display form in page 

    $formBuilder = new ModuleFormBuilder($animations);       
    $formBuilder->build();                                 

    $form = $formBuilder->form();                            

    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Animations'), $request);

    if($formHandler->process())
    {
        $this->app->user()->setFlash('Les modifications ont été enregistrées');
    }

    // show page with pictures joined

    $picturesController = new PicturesController($this->app, 'Pictures', 'test');
    $mainPicture = $picturesController->getMain('animations', $animations->getId());
    
    $this->page->addVar('main', $mainPicture);
    $this->page->addVar('upTitle', "animations");
    $this->page->addVar('animations', $animations);
    $this->page->addVar('form', $form->createView());
 
  }


  // Delete page (+ pictures) 

  public function executeDelete(HTTPRequest $request)
  {
    // delete pictures associated with animation 
    $picturesController = new PicturesController($this->app, 'Pictures', 'test');
    $picturesController->deletePictureWithPage('animations', $request->getData('id'));
    $picturesController->deleteSliderWithPage('animations', $request->getData('id'));

    $manager = $this->managers->getManagerOf('Animations');

    $unique = $manager->getUnique($request->getData('id'));

    if(!empty($unique)) {

      $ajax = $unique->Ajax_Id();     // if picture deleted is a row 
      $high = $manager->highAjax();   // in the middle of a table in bdd 
                                      // then we recalculate ajax_id 
      $modify = $manager->getAll(NULL);

      foreach($modify as $test) {

          if($test->ajax_id() > $ajax) {

            $new_ajax = $test->ajax_id();
          
            $manager->updateAjax($new_ajax, $test->getId());
          
          }
          
      }

    }

    $manager->delete($request->getData('id'));

                                                  // redirect with paginate 
    if($request->getData('page') != NULL && $request->getData('page') > 0) {

      $this->app->httpResponse()->redirect('/admin/paginate-' . $request->getData('page'));
    }
    else {

      $this->app->httpResponse()->redirect('/admin/');
    }

  }
  

  // allow us to load media types (ajax / input[type="files"])

  public function executeMedia(HTTPRequest $request) {

      $mediaType = $request->getData('mediatype');
      $slider = $this->managers->getManagerOf('Pictures')->getPicturesSlider($request->getData('id'), 'animations', 'backend');
      $animations = $this->managers->getManagerOf('Animations')->getUnique($request->getData('id'));

      require('Views/media.php');
  }

  

}