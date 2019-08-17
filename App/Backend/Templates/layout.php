<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>C3R - <?= $upTitle ?></title>
    <!-- icon -->
    <link rel="icon" href="../img/blason-mini.png" />
    <!-- bulma -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">

    <!-- <link rel="stylesheet" href="../css/css/mystyles.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css"> -->
    <!-- my css -->
    <link rel="stylesheet" href="../css/css/backend/index.min.css">
    <link rel="stylesheet" href="../../css/css/backend/responsive.min.css">
     <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Pangolin" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Love+Ya+Like+A+Sister" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Boogaloo" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pavanam" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <!-- font awesome -->
 <!--    <link rel="stylesheet" href="../css/FontAwesome/css/all.css">
    <link rel="stylesheet" href="../css/FontAwesome/js/all.js"> -->
    <!-- <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script> -->
    <!-- tinymce -->
    <script src="../js/tinymce/js/tinymce/tinymce.min.js"></script>
    <script>
      tinymce.init({ 

          selector:'textarea', 
          language: 'fr_FR',
          theme : "silver",
          content_css: ['//fonts.googleapis.com/css?family=Pangolin'],
          font_formats: 'Pangolin',
          removed_menuitems: "undo,redo",
          menu: {
            insert: {title: 'Insert', items: 'image link media | specialcaracters | insertdatetime'},
            format: {title: 'Format', items: 'underline strikethrough superscript subscript blockquote'},
          },
          plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
          ],
          menubar: 'edit format table insert tools',
          toolbar1: 'print | insertfile undo redo | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent',
          toolbar2: 'forecolor backcolor',
          image_advtab: true,

      });
    </script>

  </head>
  <body>

    <!-- navbar top -->

    <nav class="navbar" aria-label="main navigation">

      <div class="navbar-brand">
       
        <a class="navbar-item" href="/">
          <img src="../../img/blason.png" alt="blason"/>
          <div class="titre-logo-top">C3R</div>
        </a>

        <div class="navbar-responsive">
           <div class="navbar-responsive-child">
              <a href="/admin/logout" class="navbar-item">
                Déconnexion
              </a>
           </div>
        </div>

      </div>

      <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
          <a href="/admin/logout" class="navbar-item">
            Déconnexion
          </a>
        </div>
      </div>

    </nav>

    <section class="section container-menu-backend">

      <div class="menu-backend-child">

        <!-- sidebar left -->

        <aside class="menu menu-shown">
          <p class="menu-label label-hidden">
            Site Web
          </p>
          <ul class="menu-list">
            <li><a <?php if(isset($_SESSION['nbdePages']) && isset($_SESSION['pageActuelle']) && $_SESSION['nbdePages'] > 1) { echo 'href ="/admin/paginate-' . $_SESSION['pageActuelle'] . '"'; } else { echo 'href="/admin/"'; } ?> id="admin-animations" class="main-menu <?php if($upTitle == "animations") { echo 'active'; } ?>" ><i class="fas fa-dragon"></i><span class="menu-span">Animations</span></a></li>
            <li><a <?php if(isset($_SESSION['nbdeW']) && isset($_SESSION['pageW']) && $_SESSION['nbdeW'] > 1) { echo 'href ="/admin/workshops-paginate-' . $_SESSION['pageW'] . '"'; } else { echo 'href="/admin/workshops"'; } ?> id="admin-workshops"  class="main-menu <?php if($upTitle == "ateliers") { echo 'active'; } ?>" ><i class="fas fa-hammer"></i><span class="menu-span">Ateliers</span></a></li>
            <li><a <?php if(isset($_SESSION['nbdePerso']) && isset($_SESSION['pagePerso']) && $_SESSION['nbdePerso'] > 1) { echo 'href ="/admin/characters-paginate-' . $_SESSION['pagePerso'] . '"'; } else { echo 'href="/admin/characters"'; } ?> id="admin-characters" class="main-menu <?php if($upTitle == "personnages") { echo 'active'; } ?>" ><i class="fas fa-crown"></i><span class="menu-span">Personnages</span></a></li>
            <li><a <?php if(isset($_SESSION['nbdePred']) && isset($_SESSION['pagePred']) && $_SESSION['nbdePred'] > 1) { echo 'href ="/admin/prejudices-paginate-' . $_SESSION['pagePred'] . '"'; } else { echo 'href="/admin/prejudices"'; } ?> id="admin-prejudices" class="main-menu <?php if($upTitle == "prejuges") { echo 'active'; } ?>"><i class="fas fa-dungeon"></i><span class="menu-span">Préjugés</span></a></li>
          </ul>
          <p class="menu-label label-hidden">
            Administration
          </p>
          <ul class="menu-list">
            <li><a href="/admin/manage" <?php if($upTitle == "créer un admin") { echo "class='active'"; } ?>><i class="fas fa-user-cog"></i><span class="menu-span">Créer un admin</span></a></li>
            <li><a href="/admin/manage-show" <?php if($upTitle == "modifier un admin") { echo "class='active'"; } ?>><i class="fas fa-unlock"></i><span class="menu-span">Modifier un admin</span></a></li>
          </ul>
          <p class="menu-label label-hidden">
            Actions
          </p>
          <ul class="menu-list" id="open-close-aside">
            <li><a><i class="fas fa-arrow-circle-left"></i><span class="menu-span">Réduire le menu</span></a></li>
          </ul>
        </aside>

        <div id="backend-container"> 

           <div class="container-menu-hidden">

               <aside class="menu menu-hidden">
                <p class="menu-label">
                  Site Web
                </p>
                <ul class="menu-list">
                  <li><a href="/admin/">Animations</a></li>
                  <li><a href="/admin/workshops">Ateliers</a></li>
                  <li><a href="/admin/characters">Personnages</a></li>
                  <li><a href="/admin/prejudices">Préjugés</a></li>
                </ul>
                <p class="menu-label">
                  Administration
                </p>
                <ul class="menu-list">
                  <li><a href="/admin/manage">Gerer les admins</a></li>
                </ul>
              </aside>

          </div>

          <!-- content -->

          <div class="container-backend-content">

            <?= $content ?>

             <footer class="footer">
              <div class="content has-text-centered">
                <p>
                  <div class="logo-bottom">
                    <div><a href="/"><img src="../img/blason.png" alt="blason" id="logo-img-bottom"/></a></div>
                    <div class="titre-logo">C3R</div>
                  </div> 
                </p><br>
              </div>
            </footer>

         </div>

      </div>

    </section>

    <script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
    <script>
      
      $('#question-frame').click(function(e) {

        e.preventDefault();
        
        alert('hello');

      });

    </script>
    <!-- <script src="../js/jquery.js"></script> -->
    <script src="../js/jquery-ui.js"></script>
    <script src="../js/backend/aside.js"></script>
    <script src="../js/backend/save.js"></script>
    <script src="../js/backend/form.js"></script>



  </body>
</html>