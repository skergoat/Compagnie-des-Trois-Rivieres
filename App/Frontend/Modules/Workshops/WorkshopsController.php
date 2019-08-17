<?php

namespace App\Frontend\Modules\Workshops;

use \CRFram\BackController;
use \CRFram\HTTPRequest;
use \CRFram\FormHandler;

class WorkshopsController extends BackController
{
  
  public function executeIndex(HTTPRequest $request)
  { 
    $this->managers->getManagerOf('Recover')->removeCodeAfter();
    $nombreCaracteres = $this->app->config()->get('nombre_caracteres');

     // paginate 
    $manager = $this->managers->getManagerOf('Workshops');
    
    $messageTotal = $this->app->config()->get('total');    
                 
    $total = $manager->countTotal();

    $total = $total[0];

    $nbdePages = ceil($total / $messageTotal);

    if($request->getData('paginate') != NULL){

      $pageActuelle = intval($request->getData('paginate'));

      $_SESSION['pageFrontWork'] = $pageActuelle; 

      if($pageActuelle > $nbdePages){

        $pageActuelle = $nbdePages;
      }

    } else {

      $pageActuelle = 1;
    }

    $premiereEntree = ($pageActuelle - 1) * $messageTotal;

    // show bdd 
    $workshops = $manager->getPaginate($premiereEntree, $messageTotal, 'WHERE published = 1');  

    foreach ($workshops as $work)
    {
      if (strlen($work->Description()) > $nombreCaracteres)
      {
        $debut = substr($work->Description(), 0, $nombreCaracteres) . '...';
        
        $work->setDescription($debut);
        
      }

    }

    $manager = $this->managers->getManagerOf('Pictures');

    $this->page->addVar('nbdePages', $nbdePages);
    $this->page->addVar('pageActuelle', $pageActuelle);
    $this->page->addVar('manager', $manager);
    $this->page->addVar('workshops', $workshops);
    $this->page->addVar('upTitle', ' - ateliers');
    $this->page->addVar('recapcha', '');
  
  }

  public function executeShow(HTTPRequest $request)
  {
    // get workshops 
    $manager = $this->managers->getManagerOf('Workshops');
    $workshops = $manager->getUniqueByAjax($request->getData('id'));

    // get pictures 
    $pictureManager = $this->managers->getManagerOf('Pictures');
    
    if ($workshops == NULL || $workshops->published() == false && $this->app->user()->isAuthenticated() == false)
    {
      $this->app->httpResponse()->redirect404();
    }
    else {

       $mainPicture = $pictureManager->getUnique('workshops', $workshops->getId());
       $pictureSlider = $pictureManager->getPicturesSlider($workshops->getId(), 'workshops', 'frontend');
    }
    
    $this->page->addVar('workshops', $workshops);
    $this->page->addVar('mainPicture', $mainPicture);
    $this->page->addVar('pictureSlider', $pictureSlider);
    $this->page->addVar('highId', $manager->HighAjax());
    $this->page->addVar('lowId', $manager->LowAjax());
    $this->page->addVar('upTitle', ' - ateliers/voir');
    $this->page->addVar('recapcha', '');

  }


  // load ajax pages 
  public function executeAjaxWorkshops(HTTPRequest $request) {

    $workshops = $this->managers->getManagerOf('Workshops')->getUniqueByAjax($request->getData('id'));

    $user = $this->app->user();

    $manager = $this->managers->getManagerOf('Pictures');
    $mainPicture = $manager->getUnique('workshops', $workshops->getId());

    $pictureSlider = $manager->getPicturesSlider($workshops->getId(), 'workshops', 'frontend');

    require('Views/ajaxWorkshops.php');

  }

  
} 