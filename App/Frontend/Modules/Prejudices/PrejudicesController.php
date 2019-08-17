<?php

namespace App\Frontend\Modules\Prejudices;

use \CRFram\BackController;
use \CRFram\HTTPRequest;
use \CRFram\FormHandler;

 Class PrejudicesController extends BackController
{
   public function executeIndex(HTTPRequest $request)
  {
    
   $this->managers->getManagerOf('Recover')->removeCodeAfter();
    $nombreCaracteres = $this->app->config()->get('nombre_caracteres');

    $manager = $this->managers->getManagerOf('Prejudices');
    
    // paginate 
    $messageTotal = $this->app->config()->get('total');     
                 
    $total = $manager->countTotal();

    $total = $total[0];

    $nbdePages = ceil($total / $messageTotal);

    if($request->getData('paginate') != NULL){

      $pageActuelle = intval($request->getData('paginate'));

      $_SESSION['pageFrontPrej'] = $pageActuelle; 

      if($pageActuelle > $nbdePages){

        $pageActuelle = $nbdePages;
      }

    } else {

      $pageActuelle = 1;
    }

    $premiereEntree = ($pageActuelle - 1) * $messageTotal;

    // show bdd  
    $prejudices = $manager->getPaginate($premiereEntree, $messageTotal, 'WHERE published = 1'); 

    foreach ($prejudices as $pred)
    {
      if (strlen($pred->Description()) > $nombreCaracteres)
      {
        $debut = substr($pred->Description(), 0, $nombreCaracteres) . '...';

        $pred->setDescription($debut);
        
      }

    }

    $manager = $this->managers->getManagerOf('Pictures');

    $this->page->addVar('nbdePages', $nbdePages);
    $this->page->addVar('pageActuelle', $pageActuelle);
    $this->page->addVar('manager', $manager);
    $this->page->addVar('prejudices', $prejudices);
    $this->page->addVar('upTitle', ' - prejuges');
    $this->page->addVar('recapcha', '');
  
  }

  public function executeShow(HTTPRequest $request)
  {

    $manager = $this->managers->getManagerOf('Prejudices');
    $prejudices = $manager->getUniqueByAjax($request->getData('id'));

    $pictureManager = $this->managers->getManagerOf('Pictures');
    
    if ($prejudices == NULL || $prejudices->published() == false && $this->app->user()->isAuthenticated() == false)
    {
      $this->app->httpResponse()->redirect404();
    }
    else {

      $mainPicture = $pictureManager->getUnique('prejudices', $prejudices->getId());
      $pictureSlider = $pictureManager->getPicturesSlider($prejudices->getId(), 'prejudices', 'frontend');
    }
    
    $this->page->addVar('prejudices', $prejudices);
    $this->page->addVar('mainPicture', $mainPicture);
    $this->page->addVar('pictureSlider', $pictureSlider);
    $this->page->addVar('highId', $manager->HighAjax());
    $this->page->addVar('lowId', $manager->LowAjax());
    $this->page->addVar('upTitle', ' - prejuges/voir');
    $this->page->addVar('recapcha', '');

  }


  // load ajax pages 
  public function executeAjaxPrejudices(HTTPRequest $request) {

    $prejudices = $this->managers->getManagerOf('Prejudices')->getUniqueByAjax($request->getData('id'));

    $user = $this->app->user();

    $manager = $this->managers->getManagerOf('Pictures');
    $mainPicture = $manager->getUnique('prejudices', $prejudices->getId());

    $pictureSlider = $manager->getPicturesSlider($prejudices->getId(), 'prejudices', 'frontend');

    require('Views/ajaxPrejudices.php');

  }

} 