<?php $upTitle; ?>

<div class="container-content-child">

	<div class="container-table">

		<div><h1 class="title is-1">PERSOS</h1></div>

		<div><form method="post" action="/admin/characters/create"><button class="button is-new" id="new-anim" >Nouvelle Page</button><form></div>

		<div class="pagination" role="navigation" aria-label="pagination">
			<ul class="pagination-list">

				<!-- pagination -->

				<?php

				for($i = 1 ; $i <= $nbdePages ; $i++){

					if($i == $pageActuelle){ ?>

						<li>
					      <a class="pagination-link is-current" aria-label="Page 1" aria-current="page"><?= $i ?></a>
					    </li>

					<?php } else { ?>

						    <li>
						    	<a class="pagination-link" aria-label="Goto page 2" href="/admin/characters-paginate-<?= $i ?>"><?= $i ?></a>
						    </li>
						 
					<?php } 
				} ?>
			</ul>
		</div>

		<?php $nb = 0; ?>

		<!-- 
			$nb is to calculate the number to which page redirect the user 
			after is has finished to modify animation and comes back to index page 
		-->

		<table class="table is-bordered">
			<thead>
			<tr>
			  <th>Title</th>
			  <th>Actions</th>
			</tr>
			</thead>
			<tbody>
				<?php foreach($characters as $perso) { 
					
					 if($nb == $_SESSION['total'] + 1) {

					 	$nb = 0;
					 } 
					 else {

					 	$nb++;
					 }

					 $_SESSION['nbPerso'] = $nb;

				?>
				<tr id="">
				  <th><a href="/admin/characters-modify-<?= $perso->getId(); ?>"><?php if(empty($perso->Title())) { echo '<em style="font-weight:400;">(modifier)</em>'; } else  { echo $perso->Title(); } ?></a></th>
				  <td>
				  	<div class="container-actions">
				      	<a <?php if($nbdePages > 1) { echo 'href ="/admin/characters-delete-' . $perso->getId() . '-' . $pageActuelle . '"'; } else { echo 'href="/admin/characters-delete-' . $perso->getId() . '"'; } ?> id="delete-page-<?= $perso->getId() ?>" class="delete-class supprimer">
				            Supprimer
				        </a>
					</div>
				  </td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

	</div>

</div>