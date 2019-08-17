<section class="info-ajax" id="<?= $prejudices->Ajax_id() ?>">

	<h2 class="title is-1"><?= $prejudices->Title() ?></h2>

	<!-- button to go to admin -->

	<?php if($user->isAuthenticated()) { ?>
	<div class="tabs is-toggle">
	  <ul>
	    <li>
	      <a href="/admin/prejudices-modify-<?= $prejudices->getId() ?>" id="modify-page" class="modify-class">
	        <span class="icon is-small"><i class="fas fa-wrench"></i></span>
	        <span>Modifier</span>
	      </a>
	    </li>
	  </ul>
	</div>
	<?php } ?>

		<!-- main picture -->

		<?php if($prejudices->media() == 'picture') { ?>

			<div class="frame-picture-top">

				<div class="frame-picture-middle">

					<div class="picture-show media-show">

						<img src="<?= $mainPicture->Src() ?>" alt="<?= $mainPicture->alt() ?>" style="width:100%;"/>

					</div>

				</div>

			</div>

		<?php } else if($prejudices->media() == 'video') { ?>

			<!-- video -->

			<div class="frame-picture-top">

				<div class="frame-picture-middle">

					<div class="picture-show video-show">

						<?= $prejudices->video_url() ?>

					</div>
					
				</div>

			</div>

		<?php } 

		else if($prejudices->Media() == 'slider') { ?>

			<!-- slider -->

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

	<div id="ajax-container">

		<section class="section description">

			<!-- page content  -->

			<div class="content" id="content-text">

				<?= $prejudices->Description() ?>
		
			</div>

			<a href="/prejudices" class="button is-back" id="animationsBack">Retour aux Préjugés</a>

		</section>

	</div>

</section>