<?php $upTitle ?>

<section>

	<div class="container container-admin">
		
		<div class="container-admin-child">
			
			<h1 class="title is-1">Créer un admin</h1>

			<div class="container-messages-manage">
				<!-- success message -->

				<?php if($user->hasFlash() && !isset($errorMessage)) {  ?>

				<article class="message is-success success-modify <?php if($user->hasFlash() && !isset($errorMessage)) {  ?> hide-message <?php } ?>" id="success-update">
				  <div class="message-body">
				 <?= $user->getFlash(); ?>
				  </div>
				</article>

				<?php } ?>

				<!-- error message -->

				<?= isset($errorMessage) ? '<article class="message is-danger error-modify <?php if(isset($errorMessage)) {  ?> hide-message <?php } ?>" style=";text-align:center;" id="error-update"><div class="message-body">' . $errorMessage . '</div></article>': '' ?>

			</div>

			<section class="section section-admin">

				<form method="post" action="">
					
					<?= $form ?>

					<input type="submit" value="Envoyer" class="button is-link admin-submit" />

				</form>
				
			</section>

		</div>

	</div>
	
</section>

