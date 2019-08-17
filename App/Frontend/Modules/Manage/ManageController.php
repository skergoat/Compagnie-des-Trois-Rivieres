<?php

namespace App\Frontend\Modules\Manage;

use \CRFram\BackController;
use \CRFram\HTTPRequest;
use \CRFram\FormHandler;
use \Entity\Manage;
use \CRFram\Mail;
use \FormBuilder\RecoverFormBuilder;

class ManageController extends BackController
{
	// if mail is in bdd then send recover code 
	public function executeIndex(HTTPRequest $request) {

		if(!$this->app->user()->isAuthenticated()) {

			if($request->method() == 'POST') {

				if(preg_match('#[a-z0-9._-]{1,10}@[a-z0-9._-]{1,10}\.[a-z]{1,3}#isU' , $request->postData('mail'))) {

					$manager = $this->managers->getManagerOf('Manage');
					$verify = $manager->countMail($request->postData('mail'));
					
					if($verify) {

						$unique = $manager->getUniqueByMail($request->postData('mail'));

						$code = (rand()*8);
						$url = (rand()*8);

						$recover = $this->managers->getManagerOf('Recover');
						$recover->save($code);

						$mail = new Mail($request->postData('mail'), '<h3>Entrez ce code pour changer votre mot de passe : </h3><p style="font-weight:bold;font-size:15px;">' . $code . '</p>', 'recover password');
						$this->managers->getManagerOf('Recover')->removeCodeAfter();
						$this->app->HTTPResponse()->redirect('/checkmail-' . $url . '-' . $unique->getId());

					}
					else {

						$this->page->addVar('errorMessage', 'mail inconnu');
					}

				}
				else {

					$this->page->addVar('errorMessage', 'veuillez rentrer un mail valide, svp');
				}
			
			}

			$this->page->addVar('upTitle', 'recover password');

		}
		else {

			$this->app->HTTPResponse()->redirect('/admin/');
		}
		
		$this->page->addVar('upTitle', 'recover password');

	}

	// if recover code is ok then redirect to update password page 
	public function executeCheckMail(HTTPRequest $request) {

		if(!$this->app->user()->isAuthenticated()) {

			if($request->method() == 'POST') {

				if(!empty($request->postData('code')) && is_numeric($request->postData('code'))) {

					$recover = $this->managers->getManagerOf('Recover');
					$verify = $recover->verifyCode($request->postData('code'));

					if($verify) {

						$url = (rand()*8);

						$recover->removeCode($request->postData('code'));
						$this->app->HTTPResponse()->redirect('/checkcode-' . $url . '-' . $request->getData('id'));
						
					}
					else {

						$this->page->addVar('errorMessage', 'code inconnu');

					}
				}
				else {

					$this->page->addVar('errorMessage', 'veuillez entrer un code numeric svp'); 

				}

				$this->page->addVar('upTitle', 'recover password');

			}

		}
		else {

			$this->app->HTTPResponse()->redirect('/admin/');
		}

		$this->page->addVar('upTitle', 'recover password');

	}

	// update password 
	public function executeCheckCode(HTTPRequest $request) {

		if(!$this->app->user()->isAuthenticated()) {

			$unique = $this->managers->getManagerOf('Manage')->getUnique($request->getData('id'));

			// create new obecjt to update password 
			if ($request->method() == 'POST')
		    {
	    	   $manage = new Manage([
		      	'name' => $unique->Name(),
		        'password' => $request->postData('password'),
		        'mail' => $unique->Mail()
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
		        $manage = new Manage;
		      }
		    }

		    $formBuilder = new RecoverFormBuilder($manage);
		    $formBuilder->build();

		    $form = $formBuilder->form();

		    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Manage'), $request);


	    	$verify = $this->managers->getManagerOf('Manage')->verifInfo('update', $request->getData('id'));

	    	// check if passwor already exists 
			while($donnee = $verify->fetch()) { 

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

			// preocess form or show error message 
			if(isset($error)) {

			   $this->page->addVar('errorMessage', $error);
			}
			else {

				if($formHandler->process())
			    {
				    $this->app->httpResponse()->redirect('/admin/');  
			   }
			}

				$this->page->addVar('upTitle', 'recover password');
				$this->page->addVar('form', $form->createView());

		}
		else {

			$this->app->HTTPResponse()->redirect('/admin/');
		}
	}

}