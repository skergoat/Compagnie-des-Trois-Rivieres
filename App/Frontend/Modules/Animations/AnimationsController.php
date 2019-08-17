<?php

namespace App\Frontend\Modules\Animations;

use \CRFram\BackController;
use \CRFram\HTTPRequest;
use \CRFram\FormHandler;

class AnimationsController extends BackController
{
  
  public function executeIndex(HTTPRequest $request)
  { 
    $this->managers->getManagerOf('Recover')->removeCodeAfter();
    $nombreCaracteres = $this->app->config()->get('nombre_caracteres');

    $manager = $this->managers->getManagerOf('Animations');

    // paginate
    
    $messageTotal = $this->app->config()->get('total');  

    $total = $manager->countTotal();

    $total = $total[0];

    $nbdePages = ceil($total / $messageTotal);

    if($request->getData('paginate') != NULL){

      $pageActuelle = intval($request->getData('paginate'));

        $_SESSION['pageFrontAnim'] = $pageActuelle; 

      if($pageActuelle > $nbdePages){

        $pageActuelle = $nbdePages;
      }

    } else {

      $pageActuelle = 1;
    }

    $premiereEntree = ($pageActuelle - 1) * $messageTotal;

    // get bdd  

    $Animations = $manager->getPaginate($premiereEntree, $messageTotal, 'WHERE published = 1');  

    foreach ($Animations as $anim)
    {
      if (strlen($anim->Description()) > $nombreCaracteres)
      {
        $debut = substr($anim->Description(), 0, $nombreCaracteres) . '...';
        
        $anim->setDescription($debut);
        
      }

    }

    $manager = $this->managers->getManagerOf('Pictures');

    $this->page->addVar('nbdePages', $nbdePages);
    $this->page->addVar('pageActuelle', $pageActuelle);
    $this->page->addVar('manager', $manager);
    $this->page->addVar('animations', $Animations);
    $this->page->addVar('upTitle', ' - animations');
    $this->page->addVar('recapcha', '');
  
  }

  public function executeShow(HTTPRequest $request)
  {

    // get animations 
    $manager = $this->managers->getManagerOf('Animations');
    $animations = $manager->getUniqueByAjax($request->getData('id'));

    // get pictures 
    $pictureManager = $this->managers->getManagerOf('Pictures');

    if($animations == NULL || $animations->published() == false && $this->app->user()->isAuthenticated() == false) {

      $this->app->httpResponse()->redirect404();
    }
    else {

      $mainPicture = $pictureManager->getUnique('animations', $animations->getId());
      $pictureSlider = $pictureManager->getPicturesSlider($animations->getId(), 'animations', 'frontend');
    }
    
    $this->page->addVar('animations', $animations);
    $this->page->addVar('mainPicture', $mainPicture);
    $this->page->addVar('pictureSlider', $pictureSlider);
    $this->page->addVar('highId', $manager->HighAjax());
    $this->page->addVar('lowId', $manager->LowAjax());
    $this->page->addVar('upTitle', ' - animations/voir');
    $this->page->addVar('recapcha', '');

  }


  // load ajax pages 
  public function executeAjax(HTTPRequest $request) {

    $animations = $this->managers->getManagerOf('Animations')->getUniqueByAjax($request->getData('id'));

    $user = $this->app->user();

    $manager = $this->managers->getManagerOf('Pictures');
    $mainPicture = $manager->getUnique('animations', $animations->getId());

    $pictureSlider = $manager->getPicturesSlider($animations->getId(), 'animations', 'frontend');

    require('Views/ajax.php');

  }

  
} 