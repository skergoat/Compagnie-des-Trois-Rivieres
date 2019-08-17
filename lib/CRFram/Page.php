<?php
namespace CRFram;

class Page extends ApplicationComponent
{
  protected $contentFile;
  protected $vars = [];

  public function addVar($var, $value)
  {
    if (!is_string($var) || is_numeric($var) || empty($var))
    {
      throw new \InvalidArgumentException('Le nom de la variable doit être une chaine de caractères non nulle');
    }

    $this->vars[$var] = $value;
  }

  public function getGeneratedPage()
  {
    if (!file_exists($this->contentFile))
    {
      throw new \RuntimeException('La vue spécifiée n\'existe pas');
    }

    // to load pages with ajax
    if( $this->contentFile == "/home/maje8745/public_html/lib/CRFram/../../App/Frontend/Modules/Animations/Views/ajax.php" || 
        $this->contentFile == "/home/maje8745/public_html/lib/CRFram/../../App/Frontend/Modules/Workshops/Views/ajaxWorkshops.php" ||
        $this->contentFile == "/home/maje8745/public_html/lib/CRFram/../../App/Frontend/Modules/Prejudices/Views/ajaxPrejudices.php" ||
        $this->contentFile == "/home/maje8745/public_html/lib/CRFram/../../App/Backend/Modules/Animations/Views/media.php" ||
        $this->contentFile == "/home/maje8745/public_html/lib/CRFram/../../App/Backend/Modules/Workshops/Views/media.php" ||
        $this->contentFile == "/home/maje8745/public_html/lib/CRFram/../../App/Backend/Modules/Prejudices/Views/media.php") {

       ob_start();
        " "; 
      $content = ob_get_clean();

      ob_start();
        " ";
      return ob_get_clean();

    }
    else {

      $user = $this->app->user();
       // print_r($this->contentFile);
      extract($this->vars);

      ob_start();
      require $this->contentFile;

      $content = ob_get_clean();

      if($this->contentFile == "/home/maje8745/public_html/lib/CRFram/../../App/Backend/Modules/Connexion/Views/index.php") {

        ob_start();
        require __DIR__.'/../../App/'.$this->app->name().'/Templates/layoutConnexion.php';
        return ob_get_clean();
        
      }
      else if($this->contentFile == "/home/maje8745/public_html/lib/CRFram/../../App/Frontend/Modules/Manage/Views/index.php" ||
              $this->contentFile == "/home/maje8745/public_html/lib/CRFram/../../App/Frontend/Modules/Manage/Views/checkMail.php" ||
              $this->contentFile == "/home/maje8745/public_html/lib/CRFram/../../App/Frontend/Modules/Manage/Views/checkCode.php" 
        ) {

         ob_start();
        require __DIR__.'/../../App/Backend/Templates/layoutForgotten.php';
        return ob_get_clean();

      }
      else if($this->contentFile == "/home/maje8745/public_html/lib/CRFram/../../Errors/404.html") {

        ob_start();
        require __DIR__.'/../../Errors/404.html';
        return ob_get_clean();
      }
      else {

        ob_start();
        require __DIR__.'/../../App/'.$this->app->name().'/Templates/layout.php';
        return ob_get_clean();

      }
     
    }

  }

  public function setContentFile($contentFile)
  {
    if (!is_string($contentFile) || empty($contentFile))
    {
      throw new \InvalidArgumentException('La vue spécifiée est invalide');
    }

    $this->contentFile = $contentFile;
  }

}