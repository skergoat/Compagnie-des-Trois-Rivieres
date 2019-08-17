<?php $upTitle; ?>

<section class="section section-forgotten">
	
	<div class="container container-forgotten">
		
		<div class="container-recover">

			<!-- error message -->

			<?php if(isset($errorMessage)) { ?>

				<article class="message is-danger recover" id="message-recover-code">
				  <div class="message-body">
				  <?= $errorMessage ?>
				  </div>
				</article>

			<?php } else { ?>

				<article class="hiden-message"></article>

			<?php } ?>

			<h2 class="title is-5">Entrez votre nouveau mot de passe</h2>
			
			<form method="post" action="">
				
				<?= $form ?>

				<input type="submit" class="button is-info" value="Envoyer" id="recover-button-3" />

			</form>

		</div>

	</div>

</section>