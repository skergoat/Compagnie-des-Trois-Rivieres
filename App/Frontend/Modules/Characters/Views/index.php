<?php $upTitle  ?>

<div class="section section-show section-show-characters">

	<div class="container" id="welcome-index">

		<!-- top message -->
		
		<div class="section" id="welcome-content">

			<div class="welcome-comic-frame welcome-comic-frame-characters">

				<div class="container-text-welcome-index">

					<p>La <strong>C3R</strong> est une equipe de gens motives, passiones du Moyen Age et un groupe d'amis qui aime se retrouver pour prendre du bon temps.</p><br>

					<p>Voici un florilege des membres de la compagnie - appeles par leur nom de scene cela va de soi ;-) </p>
					    
				</div>

			</div>

		</div>

	</div>

	<div class="show-characters">

		<!-- top picture -->

		<img src="img/character.png" alt="" class="illustre-characters" id="members-picture" style="width:140px;height:240px;top:170px;"/>

		<!-- characters slider -->

		<div class="section" id="section-slider-characters">

			<div class="container-slider-characters">
			
				<div class="container-slider container-slider-responsive">	

					<div class="slider slider-characters">

						<?php $nb = 1; ?>

						<?php foreach($characters as $perso) { ?>

					    <div class="slide slide-characters" id="img<?= $nb++ ?>">

					  		<div class="container-characters">

					  			<div class="image is-128x128 characters-responsive">
								  <img src="<?= $perso->Picture_url() ?>" alt="<?= $perso->Picture_alt() ?>">
								</div>

								<div class="container-text-characters">

						  			<div class="container-characters-child"> 
								  		<div class="container-reponsive-characters">
								  			<h3 class="title is-3 title-characters"><?= $perso->Title() ?></h3>
								  		</div>	
							  		</div>

							  		<div class="p-characters">
							  			<p><?= $perso->Description() ?></p>
									</div>

								</div>

					  		</div>

					  		<div class="container-characters-img"><img src="<?= $perso->Picture_url() ?>" alt="<?= $perso->Picture_alt() ?>" class="characters-img" /></div>

					  </div>

					 <?php } ?>

					  <div class="button-container button-container-characters">
						<button id="previous" class="arrow arrow-character"><i class="fas fa-arrow-left"></i></button>
						<button id="next" class="arrow arrow-character"><i class="fas fa-arrow-right"></i></button>
					   </div>
					 </div>

				</div>

			</div>

		</div>

		<!-- button to go to admin -->

		<?php if($user->isAuthenticated()) { ?>
		<div class="tabs is-toggle">
		  <ul>
		    <li>
		      <a href="/admin/characters" id="modify-page" class="modify-class">
		        <span class="icon is-small"><i class="fas fa-wrench"></i></span>
		        <span>Modifier</span>
		      </a>
		    </li>
		  </ul>
		</div>
		<?php } ?>

	</div>

	<!-- circle with catsle at the bottom -->

	<div class="circle-bottom"></div>

</div>