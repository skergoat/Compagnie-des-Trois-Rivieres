<?php $upTitle; ?>
<section class="section padding-responsive" id="tentative">

	<!-- form to save the whole page -->

	<form method="post" action="" enctype="multipart/form-data">

	<div class="container">

		<!-- publish and suppress buttons -->

		<div class="tabs is-toggle">
		  <ul>
		    <li>
		      <a href="#" class="published <?php if($animations->Published() == true) { ?> true <?php } else { ?> false <?php } ?>" id="button-publish">
		        <span class="icon is-small"><?php if($animations->Published() == true) { ?><i class="eye-publish fas fa-eye-slash"></i><?php } else { ?><i class="eye-publish far fa-eye" aria-hidden="true"></i><?php } ?></span>
		        <span id="title-publish"><?php if($animations->Published() == true) { ?> Cacher <?php } else { ?> Publier <?php } ?></span>

		        <?php if($animations->Published() == true) { ?>

		        <input type="radio" class="hidden-published" name="publish" id="published-true" value="true" checked />
		        <input type="radio" class="hidden-published" name="publish" id="published-false" value="false" />

		    	<?php } else if($animations->Published() == false) { ?>

		    	<input type="radio" class="hidden-published" name="publish" id="published-true" value="true" />
		        <input type="radio" class="hidden-published" name="publish" id="published-false" value="false" checked />

		    	<?php } ?>
		      </a>
		    </li>
		    <li>
		      <a href="/animations-<?= $animations->Ajax_id() ?>" id="Watch-page" class="watch-class">
		        <span class="icon is-small"><i class="fas fa-search"></i></span>
		        <span>Voir</span>
		      </a>
		    </li>
		    <li>
		      <a href="/admin/animations-delete-<?= $animations->getId() ?>" id="delete-page" class="delete-class">
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

				<?= isset($errorMessage) ? '<article class="message is-danger error-modify <?php if(isset($errorMessage)) {  ?> hide-message <?php } ?>" style=";text-align:center;" id="error-animations"><div class="message-body">' . $errorMessage . '</div></article>': '' ?>

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

				  <p class="panel-heading">
				    Medias
				  </p>

				  	<!-- media options -->
				  
					<div class="panel-block">

						<fieldset> Quel media intégrer dans la page ? <br/><br/>
							
							<input type="radio" name="media" value="picture" id="picture" class="mediaType <?php if($animations->Media() == 'picture') { echo 'radio'; } ?>" <?php if($animations->Media() == 'picture') { echo 'checked'; } ?> /> l'image à la une <a href="https://youtu.be/HnjxlG2PsA8" target="_blank"><i class="fas fa-exclamation-triangle"></i></a><br/>
							<input type="radio" name="media" value="video" id="video" class="mediaType <?php if($animations->Media() == 'video') { echo 'radio'; } ?>" <?php if($animations->Media() == 'video') { echo 'checked'; } ?> /> une video <br/> 
							<input type="radio" name="media" value="slider" id="slider" class="mediaType <?php if($animations->Media() == 'slider') { echo 'radio'; } ?>" <?php if($animations->Media() == 'slider') { echo 'checked'; } ?>/> un slider <br/>
							
						</fieldset>	

					</div>

					<!-- media to load in ajax -->

					<div class="container-media-select" id="animations"></div> 

				</nav>

				<nav class="panel">

					<!-- main picture -->
					
					<div class="panel-heading">
				    	Image a la Une
				  	</div>

				  	<div class="panel-block" id="container-button-pictures">
				  		<div style=""><h5 class="title is-6">Ajoutez ou supprimez une image : </h5></div>
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
				  		<figure class="image is-16by9" >
				  		  
					      <img src="<?php if($main->Src() == NULL) { ?>../img/grey.png<?php } else { echo '../' . $main->Src(); } ?>" alt="Placeholder image" id="main-picture-preview">

					    </figure>
				  	</div>
					    
			 	</nav>

			</div>

		</div>

	</div>

</form>

</section>
<div class="info" id="<?= $animations->getId() ?>"></div>			<!-- id of the page to load slider for ex. -->
<div class="moduleInfo" id="<?= $animations->Media() ?>"></div>	<!-- to load the right media -->
<script type="text/javascript">

  	// alert brefore we quit the page  
	window.onbeforeunload = function(e) {

	e.preventDefault();

		if(test == true) {

	    	e.returnValue = "Voulez-vous vraiment quitter la page ?";

	    }

	 
	};

</script>