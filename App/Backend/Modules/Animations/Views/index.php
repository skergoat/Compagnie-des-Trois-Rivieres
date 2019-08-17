<?php $upTitle; ?>

<div class="container-content-child">

	<div class="container-table">

		<div><h1 class="title is-1">ANIMATIONS</h1></div>

		<div><form method="post" action="/admin/create" ><button class="button is-new" id="new-anim" >Nouvelle Page</button><form></div>

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
						    	<a class="pagination-link" aria-label="Goto page 2" href="/admin/paginate-<?= $i ?>"><?= $i ?></a>
						    </li>
						 
					<?php } 
				} ?>
			</ul>
		</div>

		<!-- 
			$nb is to calculate the number to which page redirect the user 
			after is has finished to modify animation and comes back to index page 
		-->

		<?php $nb = 0; ?>

		<table class="table is-bordered">
			<thead>
			<tr>
			  <th>Title</th>
			  <th>Actions</th>
			</tr>
			</thead>
			<tbody>
				<?php 

				foreach($animations as $anims) { 
					
					 if($nb == $_SESSION['total'] + 1) {

					 	$nb = 0;
					 } 
					 else {

					 	$nb++;
					 }

					$_SESSION['nb'] = $nb;
				?>
				<tr id="">
				  <th><a href="/admin/animations-modify-<?= $anims->getId(); ?>"><?php if(empty($anims->Title())) { echo '<em style="font-weight:400;">(modifier)</em>'; } else  { echo $anims->Title(); } ?></a></th>
				  <td>
				  	<div class="container-actions">
				      	<a <?php if($nbdePages > 1) { echo 'href ="/admin/animations-delete-' . $anims->getId() . '-' . $pageActuelle . '"'; } else { echo 'href="/admin/animations-delete-' . $anims->getId() . '"'; } ?> id="delete-page-<?= $anims->getId() ?>" class="delete-class supprimer">
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
