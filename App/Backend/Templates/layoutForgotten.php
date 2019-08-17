<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>C3R - <?= $upTitle ?></title>
    <!-- icon -->
    <link rel="icon" href="../img/blason-mini.png" />
    <!-- jquery-ui -->
    <link rel="stylesheet" href="../css/css/jquery-ui.css">
    <link rel="stylesheet" href="../css/css/jquery-ui.theme.css">
    <!-- bulma -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
    <!-- <link rel="stylesheet" href="../css/css/mystyles.css"> -->
    <!-- my css -->
    <link rel="stylesheet" href="../css/css/backend/index.css">
    <link rel="stylesheet" href="../../css/css/backend/responsive.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Pangolin" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Love+Ya+Like+A+Sister" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Boogaloo" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pavanam" rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css?family=Luminari" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <!-- font awesome -->
   <!--  <link rel="stylesheet" href="../css/FontAwesome/css/all.css">
    <link rel="stylesheet" href="../css/FontAwesome/js/all.js"> -->
     <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <!-- tinymce -->
    <script src="../js/tinymce/js/tinymce/tinymce.min.js"></script>
   
  </head>
  <body>

    <!-- navbar top -->

    <nav class="navbar" role="navigation" aria-label="main navigation">

      <div class="navbar-brand">
       
        <a class="navbar-item" href="/">
          <img src="../../img/blason.png" alt="blason"/>
          <div class="titre-logo-top">C3R</div>
        </a>

      </div>

    </nav>

    <section class="section container-menu-backend container-general-recover">

      <div class="menu-backend-child">

        <div id="forgotten-container" > 

          <!-- content -->

          <div class="container-forgotten-content" >

            <?= $content ?>

         </div>

      </div>

    </section>

     <footer class="footer footer-recover">
        <div class="content has-text-centered">
          <p>
            <div class="logo-bottom">
              <div><a href="/"><img src="../img/blason.png" alt="blason" id="logo-img-bottom"/></a></div>
              <div class="titre-logo">C3R</div>
            </div> 
          </p><br>
        </div>
      </footer>

      <script src="../js/jquery.js"></script>
      <script src="../js/backend/form.js"></script>
  </body>
</html>