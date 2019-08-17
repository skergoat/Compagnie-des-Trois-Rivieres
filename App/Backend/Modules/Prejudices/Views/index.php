<?php $upTitle; ?>

<div class="container-content-child">

	<div class="container-table">

		<div><h1 class="title is-1">PREJUGES</h1></div>

		<div><form method="post" action="/admin/prejudices/create"><button class="button is-new" id="new-pred" >Nouvelle Page</button><form></div>

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
						    	<a class="pagination-link" aria-label="Goto page 2" href="/admin/prejudices-paginate-<?= $i ?>"><?= $i ?></a>
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

				<!-- nb is usefull to know to which page (page 1, page 2, etc.) redirect the user after having modifying the page  -->

				<?php 

				foreach($prejudices as $pred) { 
					
					 if($nb == $_SESSION['total'] + 1) {

					 	$nb = 0;
					 } 
					 else {

					 	$nb++;
					 }

					 $_SESSION['nbPred'] = $nb;
				?>
				<tr id="">
				  <th><a href="/admin/prejudices-modify-<?= $pred->getId(); ?>"><?php if(empty($pred->Title())) { echo '<em style="font-weight:400;">(modifier)</em>'; } else  { echo $pred->Title(); } ?></a></th>
				  <td>
				  	<div class="container-actions">
				      	<a <?php if($nbdePages > 1) { echo 'href ="/admin/prejudices-delete-' . $pred->getId() . '-' . $pageActuelle . '"'; } else { echo 'href="/admin/prejudices-delete-' . $pred->getId() . '"'; } ?> id="delete-page-<?= $pred->getId() ?>" class="delete-class supprimer">
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