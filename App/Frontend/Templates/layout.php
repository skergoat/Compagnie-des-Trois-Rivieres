<!DOCTYPE html>
<html lang="fr">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="google-site-verification" content="ucw8GFWNs2_RZv_V1SkxORojfbuM4UGI9UiRpSQro-M" />

    <meta name="keywords" content="c3r, C3R, Compagnie des trois Rivières, Compagnie des 3 Rivières, compagnie des trois rivieres, spectacle médiéval, fête médiévale, compagnie médiévale, reconstitution médiévale, compagnie médiévale de Franche-Comté, compagnie médiévale Franche-Comté, Fête de Montby, Fête médiévale de Montby, assaut du chateau de Montby, Montby 2018, Amis du Château de Montby, jeu à la barrière, jeu du Cimier, campement médiéval, préjugés sur le Moyen-Age, poterie médiévale, artisanat médiéval" />

    <title>compagnie des trois rivières</title>
    <meta name="description" content="La Compagnie des Trois Rivières, reconstitution médiévale et spectacles médiévaux" />
    <link rel="icon" type="image/png" href="img/blason-mini.png" />

    <!-- Facebook -->
    <meta property="og:title" content="Compagnie des 3 Rivières" />
    <meta property="og:type" content="website" />
    <meta property="fb:app_id" content="369643736994626" />

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@des_trois">
    <meta name="twitter:creator" content="@des_trois">

    <!-- Facebook and Twitter -->
    <meta property="og:url" content="http://compagniedestroisrivieres.com" />
    <meta property="og:image" content="http://compagniedestroisrivieres.com/img/animations-1.jpg" />
    <meta property="og:description" content="Reconstitution et spectacles médiévaux" />
    <meta property="og:site_name" content="Compagnie des 3 Rivières" />

    <!-- Fonts -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Pangolin" rel="stylesheet"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Love+Ya+Like+A+Sister" rel="stylesheet"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Boogaloo" rel="stylesheet"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet"> -->

    <!-- font awesome -->
   <!--  <link rel="stylesheet" href="css/FontAwesome/css/all.css">
    <link rel="stylesheet" href="css/FontAwesome/js/all.js"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css"> -->
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>


     <!-- bulma css -->
    <link rel="stylesheet" href="css/css/mystyles.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
 -->
    <!-- jquery modal -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

    <!-- css -->
    <link rel="stylesheet" href="css/css/frontend/index.min.css">
    <link rel="stylesheet" href="css/css/frontend/responsive.min.css">

    <style>

      #header-picture-responsive {

        display:none;
      }

      @media all and (max-width:770px) {

      #header-picture-responsive {

        display:block;
      }

    }
    </style>

    <?= $recapcha ?>

  </head>
  <body id="home">
  
  <!-- navbar admin -->
  <?php if($user->isAuthenticated()) { ?>

    <nav class="navbar" aria-label="main navigation">
      
      <div id="navbarBasicExample">
          <div class="navbar-start">
            <a href="/admin/" class="navbar-item" id="open-close-aside">
              Admin
          </a>
        </div>
      </div>

      <div class="navbar-responsive">
         <div class="navbar-responsive-child navbar-start">
            <a href="/admin/logout" class="navbar-item">
              Déconnexion
            </a>
         </div>
      </div>

    </nav>

    <nav class="navbar-hidden"></nav>
 
<?php } ?>

    <!-- modal menu -->
    <div id="open-close-menu">

      <div class="topbar">
        <div class="topbar-child">
          <div></div> <!-- pour rendre le justify-content efficent -->
          <div class="burger">
            <div class="burger-container">
              <span class="burger-slice"></span>
              <span class="burger-slice"></span>
              <span class="burger-slice"></span>
            </div>
          </div>
        </div>
        <div class="home-link"><a href="/"><i class="fab fa-fort-awesome"></i><span>Accueil</span></a></div>
      </div>

      <div class="menu-items-container">

        <ul class="menu-items">
            <li><a href="/animations">Animations</a></li>
            <li><a href="/workshops">Artisanat</a></li>
            <li><a href="/prejudices">Préjugés</a></li>
            <li><a href="/organisation">Fête de Montby</a></li>
            <li><a href="/characters">Membres</a></li>
            <li><a href="/contact">Contact</a></li>
        </ul>

      </div>

    </div>

    <!-- header height if main pages -->

    <header <?php if($upTitle == ' - animations/voir' ||
                    $upTitle == ' - ateliers/voir' ||
                    $upTitle == ' - prejuges/voir' ||
                    $upTitle == ' - contact' 

    ) { echo 'style="min-height:60vh;"'; } ?> >

      <!-- top bar with title and burger -->

      <div class="topbar">
        <div class="topbar-child">
          <a href="/">
            <div class="logo">
              <img src="img/blason.png" alt="blason" id="logo-img" />
              <div class="titre-logo">Compagnie des 3 Rivières</div>
            </div>
         </a>
          <div class="burger" >
            <div class="burger-container">
              <span class="burger-slice"></span>
              <span class="burger-slice"></span>
              <span class="burger-slice"></span>
            </div>
          </div>
        </div>
      </div>

      <!-- if homepage then show full width video -->

        <?php if($upTitle == ' - home') { ?>

        <div class="filtre-video"></div>

        <div class="videoWrapper"></div>

        <div id="photo-responsive"></div>

         <div class="container-arrow-bottom">
            <div class="container-arrow-child">
              <img src="img/scroll-2.png" alt="arrow bottom" class="arrow-bottom"/>
            </div>
        </div>

        <?php } else { ?>

          <!-- or show full width parallax picture -->

          <div class="header-filter">

            <div class="container-title-header"> 

              <h1 class="title is-1 title-header">

                <!-- main pages titles -->
                
                <?php if($upTitle == ' - animations') { echo 'Les Animations'; } else if($upTitle == ' - personnages') { echo 'Les Membres'; } else if($upTitle == ' - ateliers') { echo 'L\'Artisanat '; } else if($upTitle == ' - prejuges') { echo 'Les Préjugés'; } else if($upTitle == ' - organisation') { echo 'Fête de Montby'; } else if($upTitle == ' - contact' ) { echo 'Contact'; } ?>

              </h1> 

            </div>

          </div>

           <div class="container-header-picture">

            <!-- main pages pictures -->

             <img src="<?php if($upTitle == ' - animations' || $upTitle == ' - animations/voir') { echo 'img/animations-1.jpg'; } else if($upTitle == ' - personnages') { echo 'img/perso.jpg'; } else if($upTitle == ' - ateliers' || $upTitle == ' - ateliers/voir') { echo 'img/ateliers.jpg'; } else if($upTitle == ' - prejuges' ||  $upTitle == ' - prejuges/voir') { echo 'img/prejuges.jpg'; } else if($upTitle == ' - organisation') { echo 'img/organisations.jpg'; } else if($upTitle == ' - contact' ) { echo 'img/contact.jpg'; } ?>" id="VideoWorker-0" class="parallax-header" alt="en-tete"/> 

           </div>

     <?php } ?>

    </header>

    <!-- content included in the page -->

    <div id="general-container">

    <?= $content ?>

    </div>

    <!-- if homepage then show prejudices -->

    <?php 

   if($upTitle == ' - home') { 

      $nb = 1;

      foreach($prejudices as $pred) { ?>

      <div id="prejudice-<?= $nb++ ?>" class="modal">
        <h1 class="title is-3"><?= $pred->Title(); ?></h1>
        <div>
          <p><?= $pred->Description(); ?> <a href="/prejudices"> Lire la suite</a></p>
        </div>
      </div>

    <?php } } ?>

    <?php if($upTitle == ' - home' || 
             $upTitle == ' - animations' ||
             $upTitle == ' - ateliers' ||
             $upTitle == ' - prejuges' ||
             $upTitle == ' - organisation' ||
             $upTitle == ' - personnages'
    ) { ?>

    <!-- castle container at the bottom of the page -->

    <div class="section welcome-content-layout"></div>


     <!-- if main pages then show direction arrows -->

    <section class="section" id="section-6">

      <img src="img/chateau.png" alt="" class="castle-layout"/>

      <div class="section-6-container" >

        <h3 class="title is-3">Vous arrivez a la fin de la page</h3>

        <h4 class="subtitle is-4">Vous avez le choix de :</h4>

        <div class="direction"> <!-- drection arrows animation -->

          <div class="direction direction-hidden">

            <a href="<?php if($upTitle == ' - animations') { echo '/workshops'; } else if($upTitle == ' - ateliers') { echo '/prejudices'; } else if($upTitle == ' - organisation') { echo '/characters'; } else if($upTitle == ' - prejuges') { echo '/organisation'; } else if($upTitle == ' - home') { echo '/animations'; } else if($upTitle == ' - personnages') { echo '/contact'; } ?>">
            <div id="top" class="link-arrow"></div></a>

            <a href="#home">
            <div id="middle" class="link-arrow"></div></a>

            <a href="/contact">
            <div id="bottom" class="link-arrow"></div></a>

          </div>

          <div class="direction direction-hidden-1">
            <img src="img/direction-3.png" id="dir-4" alt="fleche"/>
          </div>

          <div class="direction direction-hidden-1">
            <img src="img/direction-2.png" id="dir-3" alt="fleche"/>
          </div>

          <div class="direction direction-hidden-1">
            <img src="img/direction-1.png" id="dir-2" alt="fleche"/>
          </div>

          <img src="img/direction.png" id="dir-1" alt="fleche"/>

        </div>

      </div>

    </section>

  <?php } ?>

    <!-- footer -->

    <footer class="footer" style="">
      <div class="content-footer">
        <div id="footer-first">
           <div>Nous retrouver sur </div>
           <div><a href="https://www.facebook.com/compagniedestroisrivieres/"><img src="img/facebook.png" alt="icone facebook"/></a></div>
        </div>
        <div id="footer-second">
            <div class="logo-bottom">
              <div><a href="#"><img src="img/blason.png" alt="blason" id="logo-img-bottom" /></a></div>
              <div class="titre-logo-bottom">C3R</div>
            </div>
            <div id="footer-admin"> - <a href="/admin/">Admin</a></div>
        </div>
        <div id="footer-third">
          Website and videos by <br><a href="https://www.skergoat.com" target="_blank">Stéphane Kergoat</a> 
        </div>
      </div>
      <div class="se-pre-con"></div>
    </footer>

    <!-- <script src="js/jquery.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <?php if($upTitle != ' - contact' && !isset($_POST['name'])){ ?>

    <script src="js/frontend/loader.js"></script>
    <!-- <script src="js/backend/form.js"></script> -->
    <?php } ?>
    <script src="js/frontend/video.js"></script>
    <script src="js/frontend/menu.js"></script>
    <script src="js/frontend/Ajax.js"></script>
    <script src="js/frontend/slider.js"></script>
    <script src="js/frontend/helmet.js"></script>
    <script src="js/frontend/pictures.js"></script>
    <script src="js/frontend/parallax.js"></script>

    <!-- <script src="js/frontend/sendMail.js"></script> -->

  </body>
</html>