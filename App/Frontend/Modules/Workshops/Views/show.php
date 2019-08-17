<?php $upTitle  ?>

<div class="container-item">

	<div class="section icon-arrow">
			
		<div class="container container-arrows">

			<div class="arrows arrows-responsive">

				<!-- arrow button hiden -->
				
				<button class="animations-responsive arrow-left" id="workshops-left-responsive"><img src="img/arrow-left-responsive.png" alt="fleche gauche"/></button>
				<button class="animations-responsive arrow-right" id="workshops-right-responsive"><img src="img/arrow-right-responsive.png" alt="fleche droite"/></button>

			</div>
			
			<div class="arrows">

				<!-- arrow button visible -->
				
				<button class="arrow-buttons arrow-left" id="workshops-left"><img src="img/arrow-left.png" alt="fleche gauche"/></button>
				<button class="arrow-buttons arrow-right" id="workshops-right"><img src="img/arrow-right.png" alt="fleche droite"/></button>

			</div>	
	
		</div>

	</div>

	<div class="container" id="welcome">
		
		<div class="section" id="welcome-content-show" >

			<div class="welcome-comic-frame frame-show">

				<div class="show-ajax" id="show-ajax-animations">

					<!-- picture -->

					<section class="info-ajax" id="<?= $workshops->Ajax_id() ?>">

						<h2 class="title is-1"><?= $workshops->Title() ?></h2>

						<!-- button to go the admin -->

						<?php if($user->isAuthenticated()) { ?>
						<div class="tabs is-toggle">
						  <ul>
						    <li>
						      <a href="/admin/workshops-modify-<?= $workshops->getId() ?>" id="modify-page" class="modify-class">
						        <span class="icon is-small"><i class="fas fa-wrench"></i></span>
						        <span>Modifier</span>
						      </a>
						    </li>
						  </ul>
						</div>
						<?php } ?>

						<?php if($workshops->media() == 'picture') { ?>

							<div class="frame-picture-top">

								<div class="frame-picture-middle">

									<div class="picture-show media-show">

										<img src="<?= $mainPicture->Src() ?>" alt="<?= $mainPicture->alt() ?>"/>

									</div>

								</div>

							</div>

						<!-- video -->

						<?php } else if($workshops->media() == 'video') { ?>

							<div class="frame-picture-top frame-video-responsive">

								<div class="frame-picture-middle">

									<div class="picture-show video-show">

										<?= $workshops->video_url() ?>

									</div>
									
								</div>

							</div>

						<!-- slider -->

						<?php } 

						else if($workshops->Media() == 'slider') { ?>

						<div class="container-slider frame-picture-top">	

							<div class="frame-picture-middle">

								<div class="section media-show" id="section-slider">
						
									<div class="slider">

									 <?php $nb = 1; ?>

									 <?php foreach($pictureSlider as $slider) { ?>

									  <div class="slide slideshow" id="img<?= $nb++ ?>" style=""><img src="<?= $slider->Src() ?>" alt="<?= $slider->Alt() ?>" style="" /></div>

									  <?php } ?>

									  <div class="button-container">
										<button id="previous" class="arrow"><i class="fas fa-arrow-left"></i></button>
										<button id="next" class="arrow"><i class="fas fa-arrow-right"></i></button>
									   </div>

									</div>

								</div>

							</div>

						</div>

						<?php } ?>

						<!-- page content -->

						<div id="ajax-container">

							<div class="section description">

								<div class="content" id="content-text">

									<?= $workshops->Description() ?>
							
								</div>
								
								<a <?php if(isset($_SESSION['pageFrontWork']) && $_SESSION['pageFrontWork'] > 1) { echo 'href="/workshops-paginate-' . $_SESSION['pageFrontWork'] . '"'; } else { echo 'href="/workshops"';  } ?> class="button is-back" id="animationsBack">Retour aux Artisanats</a>

							</div>

						</div>

					</section>

				</div>

			</div>

		</div>

	</div>

	<!-- little castle at the bottom -->

	<div class="container-hidden-info">
		<span class="hidden-info" id="high-id"><?= $highId ?></span>
		<span class="hidden-info" id="low-id"><?= $lowId ?></span>
	</div>

</div>
