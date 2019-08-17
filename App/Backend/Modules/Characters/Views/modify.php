<?php $upTitle; ?>
<section class="section padding-responsive" id="tentative">

	<!-- form to save the whole page -->

	<form method="post" action="" enctype="multipart/form-data">

	<div class="container">

		<!-- publish and suppress buttons -->

		<div class="tabs is-toggle">
		  <ul>
		  	<li>
		      <a href="/characters" id="Watch-page" class="watch-class">
		        <span class="icon is-small"><i class="fas fa-search"></i></span>
		        <span>Voir</span>
		      </a>
		    </li>
		    <li>
		      <a href="/admin/characters-delete-<?= $characters->getId() ?>" id="delete-page" class="delete-class">
		        <span class="icon is-small"><i class="fas fa-times" aria-hidden="true"></i></span>
		        <span>Supprimer</span>
		      </a>
		    </li>
		  </ul>
		</div>

		<div class="message-and-validate">

			<div class="field is-grouped" id="button-save-all">
			  <div class="control">
			    <button class="button is-link" id="save-all">Sauvegarder</button>
			  </div>
			</div>

			<div class="container-messages">
				<!-- success message -->

				<?php if($user->hasFlash() && !isset($errorMessage)) {  ?>

				<article class="message is-success success-modify <?php if($user->hasFlash() && !isset($errorMessage)) {  ?> hide-message <?php } ?>" id="success-animations">
				  <div class="message-body">
				 <?= $user->getFlash(); ?>
				  </div>
				</article>

				<?php } ?>

				<!-- error message -->

				<?= isset($errorMessage) ? '<article class="message is-danger error-modify" style=";text-align:center;" id="error-animations"><div class="message-body">' . $errorMessage . '</div></article>': '' ?>

			</div>

		</div>
		 
		<div class="columns is-multiline is-desktop">

			<!-- content form -->
			
			<div class="column is-full-mobile container-form" id="column-container-form">

				<?= $form ?>

			</div>

			<!-- media sidebar right -->

			<div class="column is-one-third-desktop is-full-mobile" id="menu-media">

				<nav class="panel">

					<!-- main picture -->
					
					<div class="panel-heading">
				    	Image a la Une
				  	</div>

				  	<div class="panel-block" id="container-button-pictures">
				  		<div><h5 class="title is-6">Ajoutez ou supprimez une image : </h5></div>
				  		<div class="panel">
					  		<div class="panel-block">
					  			<button class="button is-success is-outlined is-fullwidth add-file" id="add-main">
					  				Ajouter
					  			</button>
					  			<input type="file" name="add-main-picture" id="upload-main-picture" />
					  		</div>
					  		<div>
					  			<a class="button is-danger is-outlined is-fullwidth delelte-picture" id="remove-picture">
							      Supprimer
							    </a>
							    <input type="radio" name="delete-main" id="delete-main" value="delete-main" class="delete-main-input" />
					  		</div>
				  		</div>
				  	</div>
				  	<div class="card-image">
				  		<figure class="image is-square" id="preview-characters">
				  		  
					      <img src="<?php if($characters->Picture_url() == NULL) { ?>../img/grey.png<?php } else { echo '../' . $characters->Picture_url(); } ?>" alt="<?= $characters->Picture_alt() ?>" id="main-picture-preview">

					    </figure>
				  	</div>
					    
			 	</nav>

			</div>

		</div>

	</div>

</form>

</section>
<div class="info" id=""></div>			<!-- id of the page to load slider for ex. -->
<div class="moduleInfo" id=""></div>	<!-- to load the right media -->
<script type="text/javascript">

  	// alert brefore we quit the page  
	window.onbeforeunload = function(e) {

	e.preventDefault();

		if(test == true) {

	    	e.returnValue = "Voulez-vous vraiment quitter la page ?";
	    }

	};

</script>