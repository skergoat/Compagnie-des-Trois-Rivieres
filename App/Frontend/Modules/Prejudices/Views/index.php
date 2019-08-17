
<?php $upTitle; ?>

<section class="section section-show" id="section-show-prejudices">

	<!-- message top -->

	<div class="container" id="welcome-index">
		
		<div class="section" id="welcome-content" >

			<div class="welcome-comic-frame welcome-comic-frame-characters">

				<div class="container-text-welcome-index">

					<p>Le Moyen Age est une epoque fascinante et c'est en meme temps l'une des periode sur laquelle nous avons le plus de prejuges.</p><br>

					<p>Le role d'une compagnie medieval n'est-il pas d'instruire sur la realite historique du Moyen Age et de repondre aux prejuges ?</p><br>

					<p>Sur cette page, decouvrez les 10 prejuges que nous entendons le plus souvent et apprenez a mieux connaitre une epoque plus riche qu'on croit...</p>
					    
				</div>

			</div>

		</div>

	</div>

	<div class="container container-cards">

		<!-- picture top -->

		<img src="img/prejuges.png" alt="" class="illustre" style="width:200px;height:250px;"/>

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
						    	<a class="pagination-link" aria-label="Goto page 2" href="/prejudices-paginate-<?= $i ?>"><?= $i ?></a>
						    </li>
						 
					<?php } 
				} ?>
			</ul>
		</div>

		<!-- cards -->

		<div class="columns is-multiline">

		<?php foreach($prejudices as $pred) { ?>

			<div class="column is-variable is-one-third">

				<a href="/prejudices-<?= $pred->Ajax_id() ?>" class="card-link">

					<div class="card">
					  <div class="card-image">
					    <figure class="image is-4by3">
					      <img src="<?php if($manager->getUnique('prejudices', $pred->getId())->Src() == NULL) { echo 'https://bulma.io/images/placeholders/1280x960.png'; } else { echo $manager->getUnique('prejudices', $pred->getId())->Src() ; } ?>" alt="<?php if($manager->getUnique('prejudices', $pred->getId())->Alt() == NULL) { echo 'image neutre'; } else { echo $manager->getUnique('prejudices', $pred->getId())->Alt(); } ?>">
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
					  					<h3><?= $pred->Title(); ?></h3>
					  				</div>
					  			</div>
					  			<div class="indication-bottom"><?= $pred->Ajax_id() ?></div>
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