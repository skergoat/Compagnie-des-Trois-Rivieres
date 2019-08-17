
<?php $upTitle; ?>

<section class="section section-show" id="section-show-workshops">

	<div class="container" id="welcome-index">
		
		<div class="section" id="welcome-content">

			<div class="welcome-comic-frame welcome-comic-frame-characters">

				<!-- message top -->

				<div class="container-text-welcome-index">

					<p>Dans un soucis de reconstitution histiorique mais aussi pedagogique, la <strong>C3R</strong> developpe un artisanant de type medieval.</p><br>

					<p>Avec nous, vous pourrez decouvrir de l'enluminure, des instruments de musique, la confection des vetements, la fabircation de la monnaie et d'autres surprises que nous vous laissons decouvrir sur cette page</p>
					    
				</div>

			</div>

		</div>

	</div>

	<div class="container container-cards">

		<!-- picture top -->

		<img src="img/work.png" alt="" class="illustre" style="height:250px;width:110px;left:45%;"/>

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
						    	<a class="pagination-link" aria-label="Goto page 2" href="/workshops-paginate-<?= $i ?>"><?= $i ?></a>
						    </li>
						 
					<?php } 
				} ?>
			</ul>
		</div>

		<!-- cards -->

		<div class="columns is-multiline">

		<?php foreach($workshops as $work) { ?>

			<div class="column is-variable is-one-third">

				<a href="/workshops-<?= $work->Ajax_id() ?>" class="card-link">

					<div class="card">
					  <div class="card-image">
					    <figure class="image is-4by3">
					      <img src="<?php if($manager->getUnique('workshops', $work->getId())->Src() == NULL) { echo 'https://bulma.io/images/placeholders/1280x960.png'; } else { echo $manager->getUnique('workshops', $work->getId())->Src() ; } ?>" alt="<?php if($manager->getUnique('workshops', $work->getId())->Alt() == NULL) { echo 'image neutre'; } else { echo $manager->getUnique('workshops', $work->getId())->Alt(); } ?>">
					    </figure>
					  </div>
					  <div class="card-content">
					  	<div class="card-content-frame">
					  		<div class="comics-content">
					  			<div class="go">
					  				<img src="img/go.png" alt=""/>
					  			</div>
					  			<div class="comic-content-frame">
					  				<h3><?= $work->Title(); ?></h3>
					  			</div>
					  			<div class="indication-bottom"><?= $work->Ajax_id() ?></div>
					  		</div>
					  	</div>
					  </div>
					</div>

				</a>

			</div>

		<?php } ?>

		</div>

	</div>

	<!-- circle with castle at the bottom -->

	<div class="circle-bottom"></div>

</section>
