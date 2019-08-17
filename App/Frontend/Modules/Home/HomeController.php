<?php
namespace App\Frontend\Modules\Home;

use \CRFram\BackController;
use \CRFram\HTTPRequest;
use \CRFram\FormHandler;
use \CRFram\Mail;

class HomeController extends BackController
{

  public function executeIndex(HTTPRequest $request)
  {
    //gtep rejudices for the map section 
    $listeNews = "Stephane";

    $this->managers->getManagerOf('Recover')->removeCodeAfter();

    $manager = $this->managers->getManagerOf('Prejudices');
    $prejudices = $manager->getAll('LIMIT 6');

     $nombreCaracteres = $this->app->config()->get('nombre_caracteres_2');

    foreach ($prejudices as $pred)
    {
      if (strlen($pred->Description()) > $nombreCaracteres)
      {
        $debut = substr($pred->Description(), 0, $nombreCaracteres) . '...';        
        $pred->setDescription($debut);
        
      }
    }
    
    $this->page->addVar('prejudices', $prejudices);    
    $this->page->addVar('upTitle', ' - home');
    $this->page->addVar('recapcha', '');
    $this->page->addVar('listeNews', $listeNews);
    
  }

  // show 'Fete de Montby' page 
  public function executeOrganisation(HTTPRequest $request)
  {

    $this->managers->getManagerOf('Recover')->removeCodeAfter();
    
    $listeNews = "Organisation";
    
    $this->page->addVar('upTitle', ' - organisation');
    $this->page->addVar('recapcha', '');
    $this->page->addVar('listeNews', $listeNews);
    
  }

  // show contact page 
  public function executeContact(HTTPRequest $request)
  {

    $this->managers->getManagerOf('Recover')->removeCodeAfter();
    
    $listeNews = "Contact";

     if($request->method() == 'POST') {

            // Ma clé privée
        $secret = "6LdtSKQUAAAAABjeXH7JuTEgk6nzTDk1RCracHRS";
        // Paramètre renvoyé par le recaptcha
        $response = $_POST['g-recaptcha-response'];
        // On récupère l'IP de l'utilisateur
        $remoteip = $_SERVER['REMOTE_ADDR'];
        
        $api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" 
            . $secret
            . "&response=" . $response
            . "&remoteip=" . $remoteip ;
        
        $decode = json_decode(file_get_contents($api_url), true);

        if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {

          if(preg_match('#[a-z0-9._-]{1,10}@[a-z0-9._-]{1,10}\.[a-z]{1,3}#isU' , $_POST['email'])) {

             if($decode['success'] == true) {

                $mail = new Mail('compagniedes3rivieres@gmail.com', '<h2>' . $_POST['name'] . ' a écrit : </h2><p style="font-size:15px;font-weight:700;">' . $_POST['message'] . '</p><h3> Son mail : ' . $_POST['email'] . '</h3>', 'demande de renseignement');

                $this->app->user()->setFlash('Mail bien envoyé !'); 
                
              }
              else {

                $this->page->addVar('errorMessage', 'Capcha invalide');

              }
          }    
          else {

            $this->page->addVar('errorMessage', 'veuillez entrer un mail valide, svp');

          }

       }
       else {

          $this->page->addVar('errorMessage', 'veuillez remplir tous les champs, svp');

          // return 'empty' ;

       }

    }
    
    // $this->page->addVar('controller', $this);
   
    $this->page->addVar('upTitle', ' - contact');
    $this->page->addVar('recapcha', '<script src="https://www.google.com/recaptcha/api.js"></script>');
    $this->page->addVar('listeNews', $listeNews);
    
  }

  
} 