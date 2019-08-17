<?php $upTitle ?>

<section>

	<div class="container container-admin">
		
		<div class="container-admin-child">
			
			<h1 class="title is-1">Modifier un admin</h1>

			<div class="container-messages">
				<!-- success message -->

				<?php if($user->hasFlash() && !isset($errorMessage)) {  ?>

				<article class="message is-success success-modify <?php if($user->hasFlash() && !isset($errorMessage)) {  ?> hide-message <?php } ?>" id="show-error">
				  <div class="message-body">
				 <?= $user->getFlash(); ?>
				  </div>
				</article>

				<?php } ?>

				<!-- error message -->

				<?= isset($errorMessage) ? '<article class="message is-danger error-modify <?php if(isset($errorMessage)) {  ?> hide-message <?php } ?>" style=";text-align:center;" id="show-success"><div class="message-body">' . $errorMessage . '</div></article>': '' ?>

			</div>

				<div class="pagination" role="navigation" aria-label="pagination">
					<ul class="pagination-list">

						<!-- paginate -->

						<?php

						for($i = 1 ; $i <= $nbdePages ; $i++){

							if($i == $pageActuelle){ ?>

								<li>
							      <a class="pagination-link is-current" aria-label="Page 1" aria-current="page"><?= $i ?></a>
							    </li>

							<?php } else { ?>

								    <li>
								    	<a class="pagination-link" aria-label="Goto page 2" href="/admin/manage-show-paginate-<?= $i ?>"><?= $i ?></a>
								    </li>
								 
							<?php } 
						} ?>
					</ul>
				</div>

				<?php $nb = 0; ?>

				<section class="section section-admin">

					<table class="table is-bordered">
						<thead>
						<tr>
						  <th>Titre</th>
						  <th>Actions</th>
						</tr>
						</thead>

						<!-- nb helps to calculate to which page (page 1, page 2, etc.) redirect the user after having modify the admin -->

						<?php 

						foreach($manage as $admin) { 
							
							 if($nb == 7) {

							 	$nb = 0;
							 } 
							 else {

							 	$nb++;
							 }

						?>
						<tbody>
							<tr id="<?= $admin->getId() ?>">
							  <th><a href="/admin/manage-modify-<?= $admin->getId() ?>"><?= $admin->Name(); ?></a></th>
							  <td>
							  	<div class="container-actions">
							      	<a <?php if($nbdePages > 1) { echo 'href ="/admin/manage-delete-' . $admin->getId() . '-' . $pageActuelle . '"'; } else { echo 'href="/admin/manage-delete-' . $admin->getId() . '"'; } ?> id="delete-page-<?= $admin->getId() ?>" class="delete-class supprimer">
							            Supprimer
							        </a>
								</div>
							  </td>
							</tr>
						</tbody>
						<?php } ?>
					</table>
					
				</section>

		</div>

	</div>
	
</section>