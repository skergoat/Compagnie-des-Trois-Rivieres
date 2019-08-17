<?php
namespace App\Backend\Modules\Connexion;

use \CRFram\BackController;
use \CRFram\HTTPRequest;
use App\Backend\Modules\Manage\ManageController;

class ConnexionController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Connexion');
    
    if ($request->postExists('login'))
    {
      $login = $request->postData('login');
      $password = $request->postData('password');

      $manageController = new ManageController($this->app, 'Manage', 'test');
      $verifyLogin = $manageController->managers->getManagerOf('Manage')->countLogin($login);

        if(!empty($login) || !empty($password)) {
       
             if ($verifyLogin)    // if login exists in bdd 
              {
                $verifyPassword = $manageController->managers->getManagerOf('Manage')->getUniqueByLogin($request->postData('login'));

                                  // get unique and verify password 

                  if(password_verify($password, $verifyPassword->Password())) {

                    $this->app->user()->setAuthenticated(true);
                    $this->app->httpResponse()->redirect('.');      // then redirect to admin 

                  }
                  else {

                    $this->page->addVar('errorMessage', 'Mot de passe incorrect');  
                  }

              }
              else
              {
               
                $this->page->addVar('errorMessage', 'Nom incorrect'); 

              }

          }
          else {

                $this->page->addVar('errorMessage', 'Veuillez remplir les champs svp'); 
          }
    
    }
    
    $this->page->addVar('upTitle', ' - connexion');

  }

  public function executeLogout(HTTPRequest $request) {

      session_start();
      $_SESSION = array();                      


      if (ini_get("session.use_cookies")) {
          $params = session_get_cookie_params();
          setcookie(session_name(), '', time() - 42000,
              $params["path"], $params["domain"],
              $params["secure"], $params["httponly"]
          );
      }

      session_destroy();

      $this->app->httpResponse()->redirect('/');

  }


}