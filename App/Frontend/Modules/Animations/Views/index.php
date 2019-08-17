
<?php $upTitle; ?>

<section class="section section-show" id="section-show-animations">

	<!-- message top -->

	<div class="container" id="welcome-index">
		
		<div class="section" id="welcome-content" >

			<div class="welcome-comic-frame welcome-comic-frame-characters">

				<div class="container-text-welcome-index">

					<p>La <strong>C3R</strong> propose des animations dont la premiere est leur campement ou l'on peut voir la vie de la compagnie ainsi que son artisanat.</p><br>

					<p>Mais il y aussi les inévitables combats et joutes de chevaliers ainsi que bien d'autres suprises que nous vous laissons découvrir ci-dessous.</p>
					    
				</div>

			</div>

		</div>

	</div>

	<div class="container container-cards">

		<!-- top picture -->

		<img src="img/chevalier.png" alt="knight illustration" class="illustre"/>

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
						    	<a class="pagination-link" aria-label="Goto page 2" href="/animations-paginate-<?= $i ?>"><?= $i ?></a>
						    </li>
						 
					<?php } 
				} ?>
			</ul>
		</div>

		<div class="columns is-multiline">

		<!-- cards -->

		<?php foreach($animations as $anims) { ?>

			<div class="column is-variable is-one-third">

				<a href="/animations-<?= $anims->Ajax_id() ?>" class="card-link">

					<div class="card">
					  <div class="card-image">
					    <figure class="image is-4by3">
					      <img src="<?php if($manager->getUnique('animations', $anims->getId())->Src() == NULL) { echo 'https://bulma.io/images/placeholders/1280x960.png'; } else { echo $manager->getUnique('animations', $anims->getId())->Src() ; } ?>" alt="<?php if($manager->getUnique('animations', $anims->getId())->Alt() == NULL) { echo 'image neutre'; } else { echo $manager->getUnique('animations', $anims->getId())->Alt(); } ?>">
					    </figure>
					  </div>
					  <div class="card-content">
					  	<div class="card-content-frame">
					  		<div class="comics-content">
					  			<div class="go">
					  				<img src="img/go.png" alt=""/>
					  			</div>
					  			<div class="comic-content-frame">
					  				<div class="title-frame">
					  					<h3><?= $anims->Title(); ?></h3>
					  				</div>
					  			</div>
					  			<div class="indication-bottom"><?= $anims->Ajax_id() ?></div>
					  		</div>
					  	</div>
					  </div>
					</div>

				</a>

			</div>

		<?php } ?>

		</div>

	</div>

	<!-- circle with catsle at the bottom -->

	<div class="circle-bottom"></div>

</section>