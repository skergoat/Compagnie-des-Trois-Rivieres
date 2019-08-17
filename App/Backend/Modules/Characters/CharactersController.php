<?php
namespace App\Backend\Modules\Characters;

use \CRFram\BackController;
use \CRFram\HTTPRequest;
use \Entity\Characters;
use \FormBuilder\ModuleFormBuilder;
use \CRFram\FormHandler;

class charactersController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {	


  	$manager = $this->managers->getManagerOf('Characters');

    $messageTotal = $this->app->config()->get('total');   // paginate 
    $_SESSION['total'] = $messageTotal;              

    $total = $manager->countTotal();

    $total = $total[0];

    $nbdePages = ceil($total / $messageTotal);

     $_SESSION['nbdePerso'] = $nbdePages;  // to exit at the right index page

    if($request->getData('paginate') != NULL){

      $pageActuelle = intval($request->getData('paginate'));

      if($nbdePages > 1) {

        $_SESSION['pagePerso'] = $pageActuelle; // to exit at the right index page  
      }

      if($pageActuelle > $nbdePages){

        $pageActuelle = $nbdePages;
      }

    } else {

      $pageActuelle = 1;
    }

    $premiereEntree = ($pageActuelle - 1) * $messageTotal;

    $characters = $manager->getPaginate($premiereEntree, $messageTotal); // show posts 

    $this->page->addVar('nbdePages', $nbdePages);
    $this->page->addVar('pageActuelle', $pageActuelle);
  	$this->page->addVar('characters', $characters);
    $this->page->addVar('upTitle', "personnages"); 
  }

  public function executeCreate(HTTPRequest $request) {

    // exit modify at the right index page 

    if($_SESSION['nbPerso'] == $_SESSION['total']) {

        $_SESSION['nbdePerso'] = $_SESSION['nbdePerso'] + 1;
        $_SESSION['pagePerso'] = $_SESSION['nbdePerso'];
    }
    else {

      $_SESSION['pagePerso'] = $_SESSION['nbdePerso'];
    }

  	$manager = $this->managers->getManagerOf('Characters');  // create and redirect to modify 
  	$manager->add();
  	$maxId = $manager->HighId();
  	$this->app->httpResponse()->redirect('/admin/characters-modify-' . $maxId);

  }

  public function executeModify(HTTPRequest $request) {

  	 if ($request->method() == 'POST')
    {

      $unique = $this->managers->getManagerOf('Characters')->getUnique($request->getData('id'));

      if(isset($_POST['delete-main']) && $_POST['delete-main']) { // if we delete picture, picture file is unlink 

          $file = NULL;

          if(!empty($unique->Picture_url())) {

            unlink($unique->Picture_url());
          }

      }
      else {        // if there is already a main picture  
                    // and no picture added 
                    // we don't update picture table 

        if($_FILES['add-main-picture']['size'] == 0 && $unique->Picture_url() != NULL) {

        	$file = $unique->Picture_url();
        }
        else {      // else we save picture 

        	$file = $this->managePicture($_FILES['add-main-picture'], $request, $unique);

        }

      }

      // create new object  

      $characters = new Characters([
        'title' => $request->postData('title'),
        'description' => $request->postData('description'),
        'picture_url' => $file,
        'picture_alt' => $request->postData('title'),
      ]);

      if ($request->getExists('id'))
      {
        $characters->setId($request->getData('id'));
      }
    }
    else
    {
      if ($request->getExists('id'))
      {
        $characters = $this->managers->getManagerOf('Characters')->getUnique($request->getData('id'));
      }
      else
      {
        $characters = new Characters;
      }
    }

    // save or update infos 

    $formBuilder = new ModuleFormBuilder($characters);
    $formBuilder->build();

    $form = $formBuilder->form();

    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Characters'), $request);

    if ($formHandler->process())
    {
      $this->app->user()->setFlash('Le personnage a bien été modifié !');
      
      $this->app->httpResponse()->redirect('/admin/characters-modify-' . $request->getData('id'));
    }

    $this->page->addVar('form', $form->createView());
    $this->page->addVar('characters', $characters);
    $this->page->addVar('upTitle', "personnages");

  }

  public function managePicture($file, $request, $unique) {

  	if(!empty($unique->Picture_url())) {    // if there is already a picture in bdd 
                                            // we unlink picture file before updating bdd 
  		unlink($unique->Picture_url());
  	}

  	// if ($_FILES['monfichier']['size'] <= 1000000)
    // {
    // Testons si l'extension est autorisée
    $infosfichier = pathinfo($file['name']);
    $extension_upload = $infosfichier['extension'];
    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png', 'JPG', 'JPEG');
    if (in_array($extension_upload, $extensions_autorisees))
    {
        // rename file to avoid duplicated file names 

        $temp = explode(".", $file['name']);
        $newfilename = mt_rand(10, 1000) . '-' . $request->getData('id') . '.' . end($temp);
        $path = "img/uploads/" . basename($newfilename);
        move_uploaded_file($file['tmp_name'], $path);

        return $path; 
        
    }

  }

  public function executeDelete(HTTPRequest $request) {

  	$manager = $this->managers->getManagerOf('Characters');
  	$unique = $manager->getUnique($request->getData('id'));

  	if(!empty($unique->Picture_url())) {   // delete picture files 

  		unlink($unique->Picture_url());
  	}                                       // delete and redirect with or without paginate 

  	$manager->delete($request->getData('id'));
  	if($request->getData('page') != NULL && $request->getData('page') > 0) {

      $this->app->httpResponse()->redirect('/admin/characters-paginate-' . $request->getData('page'));
    }
    else {

      $this->app->httpResponse()->redirect('/admin/characters');
    }

  }
  
}