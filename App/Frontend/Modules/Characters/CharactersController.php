<?php

namespace App\Frontend\Modules\Characters;

use \CRFram\BackController;
use \CRFram\HTTPRequest;
use \CRFram\FormHandler;

class CharactersController extends BackController
{
  
  // get characters 
  public function executeIndex(HTTPRequest $request)
  {
  	$this->managers->getManagerOf('Recover')->removeCodeAfter();
  	$characters = $this->managers->getManagerOf('Characters')->getAll();
    
    $this->page->addVar('upTitle', ' - personnages');
    $this->page->addVar('characters', $characters);
    $this->page->addVar('recapcha', '');
    
  }

  
} 