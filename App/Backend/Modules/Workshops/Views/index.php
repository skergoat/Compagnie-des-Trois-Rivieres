<?php $upTitle; ?>

<div class="container-content-child">

	<div class="container-table">

		<div><h1 class="title is-1">ATELIERS</h1></div>

		<div><form method="post" action="/admin/workshops/create"><button class="button is-new" id="new-work" >Nouvelle Page</button><form></div>

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
						    	<a class="pagination-link" aria-label="Goto page 2" href="/admin/workshops-paginate-<?= $i ?>"><?= $i ?></a>
						    </li>
						 
					<?php } 
				} ?>
			</ul>
		</div>

		<?php $nb = 0; ?>

		<table class="table is-bordered">
			<thead>
			<tr>
			  <th>Title</th>
			  <th>Actions</th>
			</tr>
			</thead>
			<tbody>

				<!-- nb is usefull to know to which page (page 1, page 2, etc.) redirect the user after having modifying a news -->

				<?php 

				foreach($workshops as $anims) { 
					
					 if($nb == $_SESSION['totalW'] + 1) {

					 	$nb = 0;
					 } 
					 else {

					 	$nb++;
					 }

					$_SESSION['nbW'] = $nb;
				?>
				<tr id="">
				  <th><a href="/admin/workshops-modify-<?= $anims->getId(); ?>"><?php if(empty($anims->Title())) { echo '<em style="font-weight:400;">(modifier)</em>'; } else  { echo $anims->Title(); } ?></a></th>
				  <td>
				  	<div class="container-actions">
				      	<a <?php if($nbdePages > 1) { echo 'href ="/admin/workshops-delete-' . $anims->getId() . '-' . $pageActuelle . '"'; } else { echo 'href="/admin/workshops-delete-' . $anims->getId() . '"'; } ?> id="delete-page-<?= $anims->getId() ?>" class="delete-class supprimer">
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