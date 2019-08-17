<?php $upTitle ?>

<section>

	<div class="container container-admin">

		<div class="tabs is-toggle button-suppress">
		  <ul>
		    <li>
		      <a href="/admin/manage-delete-<?= $manage->getId() ?>" id="delete-admin" class="delete-class">
		        <span class="icon is-small"><i class="fas fa-times" aria-hidden="true"></i></span>
		        <span>Supprimer</span>
		      </a>
		    </li>
		  </ul>
		</div>
		
		<div class="container-admin-child">

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

				<h2 class="title is-3 justify">Modifier un admin</h2>

				<form method="post" action="">
					
					<?= $form ?>

					<input type="submit" value="Envoyer" class="button is-link admin-submit" />

				</form>
				
			</section>

		</div>

	</div>
	
</section>


