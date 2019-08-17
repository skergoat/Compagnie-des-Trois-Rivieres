<?php
namespace App\Backend\Modules\Prejudices;

use \CRFram\BackController;
use \CRFram\HTTPRequest;
use \Entity\Prejudices;
use \FormBuilder\ModuleFormBuilder;
use \CRFram\FormHandler;
use App\Backend\Modules\Pictures\PicturesController;

class prejudicesController extends BackController
{

  // show table of pages for each module 
  
  public function executeIndex(HTTPRequest $request)
  {

    $manager = $this->managers->getManagerOf('Prejudices');
        
    $messageTotal = $this->app->config()->get('total');   // paginate 
    $_SESSION['total'] = $messageTotal;              
                 
    $total = $manager->countTotal();

    $total = $total[0];

    $nbdePages = ceil($total / $messageTotal);

     $_SESSION['nbdePred'] = $nbdePages;

    if($request->getData('paginate') != NULL){

      $pageActuelle = intval($request->getData('paginate'));

      if($nbdePages > 1) {

        $_SESSION['pagePred'] = $pageActuelle; 
      }

      if($pageActuelle > $nbdePages){

        $pageActuelle = $nbdePages;
      }

    } else {

      $pageActuelle = 1;
    }

    $premiereEntree = ($pageActuelle - 1) * $messageTotal;

    $prejudices = $manager->getPaginate($premiereEntree, $messageTotal, NULL); // show posts 

    $this->page->addVar('nbdePages', $nbdePages);
    $this->page->addVar('pageActuelle', $pageActuelle);
    $this->page->addVar('prejudices', $prejudices);
    $this->page->addVar('upTitle', "prejuges");
    
  }

  // create new page (+ empty main picture)

  public function executeCreate() {


     if($_SESSION['nbPred'] == $_SESSION['total']) {

        $_SESSION['nbdePred'] = $_SESSION['nbdePred'] + 1;
        $_SESSION['pagePred'] = $_SESSION['nbdePred'];

      }

      else {

        $_SESSION['pagePred'] = $_SESSION['nbdePred'];
      }


    // create manipulable id's for ajax 

    $table = $this->managers->getManagerOf('Prejudices')->countTable() ;

    if($table == 1) { 

       $high = $this->managers->getManagerOf('Prejudices')->HighAjax();
       $ajax = $high + 1;

    } else { 

       $ajax = 1; 

    }

    // new page 

    $newAnimation = new Prejudices([

        'ajax_id' => $ajax,
        'title' => NULL,
        'description' => NULL,
    ]);

    $manager = $this->managers->getManagerOf('Prejudices');

    unset($_SESSION['flash']);
    
    $manager->add($newAnimation);
    $maxId = $manager->HighId();

    // new pictures 

    $picturesController = new PicturesController($this->app, 'Pictures', 'test');
    $picturesController->createPictureWithPage('prejudices', $maxId);
    $picturesController->createSliderWithPage('prejudices', $maxId);

    $this->app->httpResponse()->redirect('/admin/prejudices-modify-' . $maxId);

  }

  //  update page content (text forms) 

  public function executeModify(HTTPRequest $request) {

    // entity updated   

    $prejudices = $this->managers->getManagerOf('Prejudices')->getUnique($request->getData('id'));

    // entity of pictures joined 

    $manager = $this->managers->getManagerOf('Pictures');
    $unique = $manager->getUnique('prejudices', $request->getData('id'));

    // nb of slides (if $_POST['media'] == 'slider')

    $countSlides = $manager->countSlides('prejudices', $request->getData('id'));

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
      else if(isset($_POST['video_url']) && $_POST['video_url'] == NULL && $prejudices->Video_url() != NULL) {

          $video = $prejudices->Video_url();
      }
      else {

          $video = NULL;
      }

      // $animations->setVideo_url($video);

      $prejudices = new Prejudices([
          
          'ajax_id' => $prejudices->Ajax_Id(),
          'title' => $request->postData('title'),
          'description' => $request->postData('description'),
          'media' => $_POST['media'],
          'video_url' => $video,
          
        ]);

      $prejudices->setId($request->getData('id'));

      $prejudices->setPublished($_POST['publish']); 


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

      // if media = video and no video 

      else if($_POST['media'] == 'video' && $_POST['video_url'] == NULL && $prejudices->Video_url() == NULL) {


           $errors = true;
           $errorMessage = "N'oubliez pas d'ajouter la vidéo !";
       

      }

      // if video is not an iframe 

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

        // condition to update video  

        if(isset($_POST['video_url']) && $_POST['video_url'] != NULL) {

          $video = $_POST['video_url'];

        }
        else if(isset($_POST['video_url']) && $_POST['video_url'] == NULL && $prejudices->Video_url() != NULL) {

            $video = $prejudices->Video_url();
        }
        else {

            $video = NULL;
            
        }

        // add id in bdd to new entity. It will be usefull in ManagerPDO 

        $prejudices->setVideo_url($video);

        // add 'publish' var to new entity 

        // if media (slider and / or picture) then upload

        $picturesController = new PicturesController($this->app, 'Pictures', 'test'); 
        $picturesController->updateSlider('prejudices',  $prejudices->getId(), $_FILES, $_POST); 

        if(isset($_POST['delete-main'])) {

          $picturesController->updateMain('prejudices',  $prejudices->getId(), $_FILES['add-main-picture'], $_POST['delete-main']); 

        }
        else {

          $picturesController->updateMain('prejudices',  $prejudices->getId(), $_FILES['add-main-picture'], NULL);

        } 

      }

    }

    // display form in page 

    $formBuilder = new ModuleFormBuilder($prejudices);       
    $formBuilder->build();                                 

    $form = $formBuilder->form();                            

    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Prejudices'), $request);

    if($formHandler->process())
    {
      $this->app->user()->setFlash('les modifications ont été enregistrées');
    }

    // show page with pictures joined

    $picturesController = new PicturesController($this->app, 'Pictures', 'test');
    $mainPicture = $picturesController->getMain('prejudices', $prejudices->getId());
    
    $this->page->addVar('main', $mainPicture);
    $this->page->addVar('upTitle', "prejuges");
    $this->page->addVar('prejudices', $prejudices);
    $this->page->addVar('form', $form->createView());
 
  }


  // Delete page (+ pictures) 

  public function executeDelete(HTTPRequest $request)
  {
    
    $picturesController = new PicturesController($this->app, 'Pictures', 'test');
    $picturesController->deletePictureWithPage('prejudices', $request->getData('id'));
    $picturesController->deleteSliderWithPage('prejudices', $request->getData('id'));

    $manager = $this->managers->getManagerOf('Prejudices');

    $unique = $manager->getUnique($request->getData('id'));

    if((!empty($unique))) {

      $ajax = $unique->Ajax_Id();
      $high = $manager->highAjax();

      $modify = $manager->getAll(NULL);

      foreach($modify as $test) {

          if($test->ajax_id() > $ajax) {

            $new_ajax = $test->ajax_id();
          
            $manager->updateAjax($new_ajax, $test->getId());
          
          }
          
      }

    }

    $manager->delete($request->getData('id'));

    if($request->getData('page') != NULL && $request->getData('page') > 0) {

      $this->app->httpResponse()->redirect('/admin/prejudices-paginate-' . $request->getData('page'));
    }
    else {

      $this->app->httpResponse()->redirect('/admin/prejudices');
    }
  }
  

  // allow us to load media types (ajax / input[type="files"])

  public function executeMedia(HTTPRequest $request) {

      $mediaType = $request->getData('mediatype');
      $slider = $this->managers->getManagerOf('Pictures')->getPicturesSlider($request->getData('id'), 'prejudices', 'backend');
      $prejudices = $this->managers->getManagerOf('Prejudices')->getUnique($request->getData('id'));

      require('Views/media.php');
  }

  

}