<?php

namespace App\Backend\Modules\Manage;

use \CRFram\BackController;
use \CRFram\HTTPRequest;
use \Entity\Manage;
use \FormBuilder\CreateAdminFormBuilder;
use \CRFram\FormHandler;

class ManageController extends BackController
{

	public function executeIndex(HTTPRequest $request) {

		$formHandler = $this->processForm($request, 'create');

		$manage = $this->managers->getManagerOf('Manage')->getList();

		$this->page->addVar('manage', $manage);
		$this->page->addVar('upTitle', 'créer un admin');

	}

	public function executeShow(HTTPRequest $request) {

		 $manager = $this->managers->getManagerOf('Manage');
    
	    $messageTotal = $this->app->config()->get('total');
	    $_SESSION['total'] = $messageTotal;              
	                 
	    $total = $manager->countTotal();				// paginate 

	    $total = $total[0];

	    $nbdePages = ceil($total / $messageTotal);

	     $_SESSION['nbdeAdmin'] = $nbdePages;

	    if($request->getData('paginate') != NULL){

	      $pageActuelle = intval($request->getData('paginate'));

	      if($nbdePages > 1) {

	        $_SESSION['pageAdmin'] = $pageActuelle; 
	      }

	      if($pageActuelle > $nbdePages){

	        $pageActuelle = $nbdePages;
	      }

	    } else {

	      $pageActuelle = 1;
	    }

	    $premiereEntree = ($pageActuelle - 1) * $messageTotal;

	    $manage = $manager->getPaginate($premiereEntree, $messageTotal); // show posts 

	    $this->page->addVar('nbdePages', $nbdePages);
	    $this->page->addVar('pageActuelle', $pageActuelle);
		$this->page->addVar('manage', $manage);
		$this->page->addVar('upTitle', 'modifier un admin');

	}

	public function executeModify(HTTPRequest $request)
	{
	   $formHandler = $this->processForm($request, 'update');

	   $manage = $this->managers->getManagerOf('Manage')->getUnique($request->getData('id'));
	   $this->page->addVar('manage', $manage);
	   $this->page->addVar('upTitle', 'modifier un admin'); 
	}

	public function processForm(HTTPRequest $request, $action)
	{
	    if ($request->method() == 'POST')
	    {
    	  $manage = new Manage([
	        'name' => $request->postData('name'),				// create new object 
	        'password' => $request->postData('password'),
	        'mail' => $request->postData('mail')
	      ]);

	      if ($request->getExists('id'))
	      {
	        $manage->setId($request->getData('id'));
	      } 
	    }
	    else
	    {
	      if ($request->getExists('id'))
	      {
	        $manage = $this->managers->getManagerOf('Manage')->getUnique($request->getData('id'));
	      }
	      else
	      {
	        $manage = new Manage;								// create form 
	      }
	    }

	    $formBuilder = new CreateAdminFormBuilder($manage);
	    $formBuilder->build();

	    $form = $formBuilder->form();

	    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Manage'), $request);

    	if($action == 'create') {

    		$verify = $this->managers->getManagerOf('Manage')->verifInfo('create', NULL);

    	}
    	else {

    		$verify = $this->managers->getManagerOf('Manage')->verifInfo('update', $request->getData('id'));

    	}

		while($donnee = $verify->fetch()) { 					// verify if password is valid 

			if($request->postData('name') == $donnee['name']) {

				$error = 'Nom deja utilisé. Veuillez en choisir un autre';
			}

			if(password_verify($request->postData('password'), $donnee['password'])) { 

				$error = 'Mot de passe deja utilisé. Veuillez en choisir un autre';
			}

			if($request->postData('mail') == $donnee['mail']) {

				$error = 'Mail deja utilisé. Veuillez en choisir un autre';
			}

		} 

		if(isset($error)) {
															// process form 
		   $this->page->addVar('errorMessage', $error);
		}
		else {

			if($formHandler->process())
		    {

		      $this->app->user()->setFlash("Les modifications ont bien été prises en compte !");

		      if($action == 'create') {

		      	$this->app->httpResponse()->redirect('/admin/manage'); 
		      }
		      else if($action == 'update') {

		      	$this->app->httpResponse()->redirect('/admin/manage-modify-' . $manage->getId()); 

		      }

		   }
		}

	    $this->page->addVar('form', $form->createView());
	    $this->page->addVar('manage', $manage);
	}

	 public function executeDelete(HTTPRequest $request)
	 {
	    $manageId = $request->getData('id');
	    
	    $this->managers->getManagerOf('Manage')->delete($manageId );

	    $this->app->user()->setFlash('L\'admin a bien été supprimée !');	// delete and redirect with or 
	    																	// wothout paginate 
	    if($request->getData('page') != NULL && $request->getData('page') > 0) {			

	      $this->app->httpResponse()->redirect('/admin/manage-show-paginate-' . $request->getData('page'));
	    }
	    else {

	      $this->app->httpResponse()->redirect('/admin/manage-show');
	    }

	 }

}