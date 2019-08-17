<?php $upTitle  ?>

<div class="container-item">

	<div class="section icon-arrow">
			
		<div class="container container-arrows">

			<!-- arrows button -->

			<div class="arrows arrows-responsive">
				
				<button class="animations-responsive arrow-left" id="animations-left-responsive"><img src="img/arrow-left-responsive.png" alt="fleche gauche"/></button>
				<button class="animations-responsive arrow-right" id="animations-right-responsive"><img src="img/arrow-right-responsive.png" alt="fleche droite"/></button>

			</div>
			
			<div class="arrows">
				
				<button class="arrow-buttons arrow-left" id="animations-left"><img src="img/arrow-left.png" alt="fleche gauche"/></button>
				<button class="arrow-buttons arrow-right" id="animations-right"><img src="img/arrow-right.png" alt="fleche droite"/></button>

			</div>	
	
		</div>

	</div>

	<div class="container" id="welcome">
		
		<div class="section" id="welcome-content-show" >

			<div class="welcome-comic-frame frame-show">

				<div class="show-ajax" id="show-ajax-animations">

					<div class="info-ajax" id="<?= $animations->Ajax_id() ?>">

						<h2 class="title is-1"><?= $animations->Title() ?></h2>

						<!-- button to go to the admin -->

						<?php if($user->isAuthenticated()) { ?>
						<div class="tabs is-toggle">
						  <ul>
						    <li>
						      <a href="/admin/animations-modify-<?= $animations->getId() ?>" id="modify-page" class="modify-class">
						        <span class="icon is-small"><i class="fas fa-wrench"></i></span>
						        <span>Modifier</span>
						      </a>
						    </li>
						  </ul>
						</div>
						<?php } ?>

						<!-- media -->

						<?php if($animations->media() == 'picture') { ?>

							<div class="frame-picture-top">

								<div class="frame-picture-middle">

									<div class="picture-show media-show">

										<img src="<?= $mainPicture->Src() ?>" alt="<?= $mainPicture->alt() ?>"/>

									</div>

								</div>

							</div>

						<?php } else if($animations->media() == 'video') { ?>

							<div class="frame-picture-top">

								<div class="frame-picture-middle">

									<div class="picture-show video-show">

										<div id="muteYouTubeVideoPlayer"></div>

										<?= $animations->video_url() ?>

									</div>
									
								</div>

							</div>

						<?php } 

						else if($animations->Media() == 'slider') { ?>

							<div class="container-slider frame-picture-top">	

								<div class="frame-picture-middle">

									<section class="section media-show" id="section-slider">
							
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

									</section>

								</div>

							</div>

						<?php } ?>

						<!-- back to index -->

						<div id="ajax-container">

							<div class="section description">

								<div class="content" id="content-text">

									<?= $animations->Description() ?>
							
								</div>
								
								<a <?php if(isset($_SESSION['pageFrontAnim']) && $_SESSION['pageFrontAnim'] > 1) { echo 'href="/animations-paginate-' . $_SESSION['pageFrontAnim'] . '"'; } else { echo 'href="/animations"';  } ?> class="button is-back" id="animationsBack">Retour aux Animations</a>

							</div>

						</div>

					</div>

				</div>
				
			</div>

		</div>

	</div>

	<div class="container-hidden-info">
		<span class="hidden-info" id="high-id"><?= $highId ?></span>
		<span class="hidden-info" id="low-id"><?= $lowId ?></span>
	</div>

</div>

